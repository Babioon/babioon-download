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
 * View class for a list of Downloads.
 *
 * @package     BABIOON_DOWNLOAD
 */
class BabioonDownloadViewDownloads extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
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
        $doc = JFactory::getDocument();
        $doc->addStyleDeclaration('.icon-48-babioon {background-image: url(../media/babioon/images/icon-48-babioon.png);}');
	    
		$user = JFactory::getUser();
		$canDo = BabioonDownloadHelpers::getActions();
		JToolBarHelper::title(JText::_('COM_BABIOONDOWNLOAD_DOWNLOADS'), 'babioon.png');
		JToolBarHelper::addNew('download.add');
		JToolBarHelper::editList('download.edit');

		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolBarHelper::divider();
				JToolBarHelper::publish('download.publish', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::unpublish('download.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1)
			{
				JToolBarHelper::divider();
				if ($this->state->get('filter.state') != 2)
				{
					JToolBarHelper::archiveList('download.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolBarHelper::unarchiveList('download.publish');
				}
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::checkin('download.checkin');
		}

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'download.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::trash('download.trash');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_babioondownload');
		}
	}
}
