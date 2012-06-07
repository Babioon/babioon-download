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
		if (task == 'advert.cancel' || document.formvalidator.isValid(document.id('advert-form'))) {
			Joomla.submitform(task, document.getElementById('advert-form'));
		}
	}
</script>




<form action="<?php echo JRoute::_('index.php?option=com_babioonemc&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="advert-form" class="form-validate">
	<div class="width-100 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_BABIOON_EMC_MANAGER_ADVERT_NEW') : JText::sprintf('COM_BABIOON_EMC_MANAGER_ADVERT_DETAILS', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('type'); ?>
				<?php echo $this->form->getInput('type'); ?></li>
				
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
			<div class="clr"> </div>

			<?php echo $this->form->getLabel('htmlversion'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('htmlversion'); ?>
			<br /><br />
			<?php echo $this->form->getLabel('textversion'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('textversion'); ?>

		</fieldset>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
