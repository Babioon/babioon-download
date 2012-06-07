<?php
/**
 * babioon koorga
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_KOORGA
 **/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
JLoader::register('BabioonKoorgaHelpers', JPATH_COMPONENT.'/helpers/helperss.php');

/**
 * View to edit a newsletter.

 */
class BabioonKoorgaViewAddress extends JView
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
        
		$doc = JFactory::getDocument();
        $doc->addStyleDeclaration('.icon-48-babioon {background-image: url(../media/babioon/images/icon-48-babioon.png);}');
		
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
		
		$canDo		= BabioonKoorgaHelpers::getActions();

		JToolBarHelper::title($isNew ? JText::_('COM_BABIOONKOORGA_ADDRESS_NEW') : JText::_('COM_BABIOONKOORGA_ADDRESS_EDIT'), 'babioon.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || count($user->getAuthorisedCategories('com_babioonkoorga', 'core.create')) > 0)) {
			JToolBarHelper::apply('address.apply');
			JToolBarHelper::save('address.save');

			if ($canDo->get('core.create')) {
				JToolBarHelper::save2new('address.save2new');
			}
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('address.save2copy');
		}

		if (empty($this->item->id))  {
			JToolBarHelper::cancel('address.cancel');
		}
		else {
			JToolBarHelper::cancel('address.cancel', 'JTOOLBAR_CLOSE');
		}
		/*
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_BANNERS_BANNERS_EDIT');
		*/
	}
}
