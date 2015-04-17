<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$cssStyle="fieldset.adminform textarea.width-100 {width:100%;}";
$doc=JFactory::getDocument();
$doc->addStyleDeclaration($cssStyle);


?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'download.cancel' || document.formvalidator.isValid(document.id('download-form'))) {
			Joomla.submitform(task, document.getElementById('download-form'));
		}
	}
</script>




<form action="<?php echo JRoute::_('index.php?option=com_babioondownload&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="download-form" class="form-validate">
	<div class="width-100 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_BABIOONDOWNLOAD_DOWNLOAD_NEW') : JText::sprintf('COM_BABIOONDOWNLOAD_DOWNLOAD_DETAILS', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>

				<li><?php echo $this->form->getLabel('text'); ?>
				<?php echo $this->form->getInput('text'); ?></li>
				
				<li><?php echo $this->form->getLabel('filename'); ?>
				<?php echo $this->form->getInput('filename'); ?></li>

				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>
				
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
			<div class="clr"> </div>

		</fieldset>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
