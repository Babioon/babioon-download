<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');


/**
 * View to edit a download.

 */
class BabioonDownloadViewDownload extends JView
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
		
		$canDo = BabioonDownloadHelpers::getActions();
		JToolBarHelper::title($isNew ? JText::_('COM_BABIOONDOWNLOAD_DOWNLOAD_NEW') : JText::_('COM_BABIOONDOWNLOAD_DOWNLOAD_EDIT'), 'babioon.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || count($user->getAuthorisedCategories('com_babioondownload', 'core.create')) > 0)) {
			JToolBarHelper::apply('download.apply');
			JToolBarHelper::save('download.save');

			if ($canDo->get('core.create')) {
				JToolBarHelper::save2new('download.save2new');
			}
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('download.save2copy');
		}

		if (empty($this->item->id))  {
			JToolBarHelper::cancel('download.cancel');
		}
		else {
			JToolBarHelper::cancel('download.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
