<?php
/**
 * @version		3.0.1
 * @package		Joomla
 * @subpackage	Imprint
 * @copyright	(C) 2011 - 2012 Imprint Team
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Imprints model class.
 * 
 * @package		Joomal
 * @subpackage	Imprint
 * @since		3.0
 */
class ImprintModelImprints extends JModelList
{
	
	/**
	 * Constructor.
	 * 
	 * @author	mgebhardt
	 * @param	array	An optional associative array of configuration settings.
	 * @since	3.0
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'name',
				'id',
				'default',
			);
		}

		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 * 
	 * @author	mgebhardt
	 * @return	void
	 * @since	3.0
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// List state information.
		parent::populateState('name', 'asc');
	}


	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string	$id	A prefix for the store id.
	 * 
	 * @author	mgebhardt
	 * @return	string	A store id.
	 * @since	3.0
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');

		return parent::getStoreId($id);
	}
	
	/**
	 * Method to build an SQL query to load the list data.
	 * 
	 * @author	mgebhardt
	 * @return	string  An SQL query
	 */
	protected function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('`id`, `name`, `default`');
		$query->from('#__imprint_imprints');
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('name LIKE '.$search);
			}
		}
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		return $query;
	}
}