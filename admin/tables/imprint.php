<?php
/**
 * @version		3.0.1
 * @package		Joomla
 * @subpackage	Imprint
 * @copyright	(C) 2011 - 2012 Imprint Team
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

// import Joomla table library
jimport('joomla.database.table');

/**
 * Imprint table class.
 * 
 * @package		Joomla
 * @subpackage	Imprint
 * @since		3.0
 */
class ImprintTableImprint extends JTable
{
	
	/**
	 * Constructor.
	 * 
	 * @author	mgebhardt
	 * @param		object			Database connector object
	 * @since		3.0
	 */
	function __construct(&$db)
	{
		parent::__construct( '#__imprint_imprints', 'id', $db );
	}
	
	/**
	 * Overloaded bind function
	 * 
	 * @author	mgebhardt
	 * @param       array           named array
	 * @return      null|string     null is operation was satisfactory, otherwise returns an error
	 * @since 		3.0
	 */
	public function bind($array, $ignore = '') 
	{
		if (isset($array['params']) && is_array($array['params'])) 
		{
			// Convert the params field to a string.
			$parameter = new JRegistry();
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}
		
		if (isset($array['remarks']) && is_array($array['remarks']))
		{
			// Convert the remarks field to a string.
			$array['remarks'] = implode(';', $array['remarks']);
		}
		return parent::bind($array, $ignore);
	}
	
	/**
	 * Overloaded load function
	 * 
	 * @author	mgebhardt
	 * @param		int		$pk primary key
	 * @param		boolean	$reset reset data
	 * @return		boolean
	 * @since		3.0
	 */
	public function load($pk = null, $reset = true) 
	{
		if (parent::load($pk, $reset)) 
		{
			// Convert the params field to a registry.
			$params = new JRegistry();
			$params->loadString($this->params);
			$this->params = $params;
			
			//@TODO: Recreate remarks array here; check why it's converted to an object
			//$this->remarks = explode(';', $this->remarks);

			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 * 
	 * @author	mgebhardt
	 * @return		string
	 * @since		3.0
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_imprint.imprint.'.(int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 * 
	 * @author	mgebhardt
	 * @return		string
	 * @since		3.0
	 */
	protected function _getAssetTitle()
	{
		return $this->name;
	}

	/**
	 * Get the parent asset id for the record
	 * 
	 * @author	mgebhardt
	 * @return		int
	 * @since		3.0
	 */
	protected function _getAssetParentId($table = null, $id = null)
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName('com_imprint');
		return $asset->id;
	}
	
}
