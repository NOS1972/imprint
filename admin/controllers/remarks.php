<?php
/**
 * @version		3.1 $Id$
 * @package		Joomla
 * @subpackage	Imprint
 * @copyright	(C) 2011 - 2012 Impressum Reloaded Team
 * @license		GNU/GPL, see LICENSE.txt
 * Imprint is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * Imprint is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Imprint; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Remarks controller class.
 * 
 * @package		Joomla
 * @subpackage	Imprint
 * @since		3.1
 */
class ImprintControllerRemarks extends JControllerAdmin
{
	
	//FIXME: delete does not work! Check controllers and models
	
	/**
	 * Constructor.
	 * 
	 * @author	mgebhardt
	 * @param	array	An optional associative array of configuration settings.
	 * @since	3.1
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}
	
	/**
	 * Proxy for getModel.
	 *  
	 * @author	mgebhardt
	 * @since	3.1
	 */
	public function getModel($name = 'Remark', $prefix = 'ImprintModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}