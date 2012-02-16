<?php
/**
 * @version		3.0.1 $Id: default_design.php 20 2011-08-15 21:03:56Z mgebhardt $
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

?>

<table width="100%" border="0">
	<tr>
<?php if ($this->imprint->params->get('show_icons')=="1"): ?>
		<td style="width: 20px" align="left">
			<img src="<?php echo JURI::root(); ?>media/com_imprint/images/template.png" border="" alt="" />
		</td>
	<?php endif; ?>
		<td>
			<strong><?php echo JText::_( 'COM_IMPRINT_DESIGN' ); ?></strong>
		</td>
	</tr>
	<tr>
	<?php if ($this->imprint->params->get('show_icons')=="1"): ?>
		<td style="width: 20px" align="left">
		</td>
	<?php endif; ?>
		<td align="left">
		<?php echo JText::_( 'COM_IMPRINT_TEMPLATENAME' ) . ': ' . $this->imprint->templatename . '<br />' ?>
		<?php echo JText::_( 'COM_IMPRINT_TEMPLATEHERSTELLER' ) . ': ' . $this->imprint->templatehersteller;
			if ($this->imprint->templateemail)
				echo " (".JHTML::_('email.cloak', $this->imprint->templateemail).")"; ?>
			<br />
		<?php if ($this->imprint->templatewebsite)
			echo JText::_( 'COM_IMPRINT_TEMPLATEWEBSITE' ) .
				': <a href="http://' . $this->imprint->templatewebsite . '" target="_blank">' .
				$this->imprint->templatewebsite.'</a>'; ?>
		</td>
	</tr>
</table>
<br />