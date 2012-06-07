<?php
/**
 * RD DOWNLOAD
 * @author Robert Deutz (email contact@rdbs.net / site www.rdbs.de)
 * @author Pascal Lohmann
 * @version $Id: view.html.php 2 2010-08-17 16:20:52Z admin $
 * @package RD_DOWNLOAD
 * @copyright Copyright (C) 2008 Robert Deutz Business Solution
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 **/

defined('_JEXEC') or die('Restricted access'); 
 
jimport( 'joomla.application.component.view');
/**
 * View class
 * 
 * @package RD_DOWNLOAD
 */
class RdDownloadViewDownload extends JView
{
	function display($tpl = null)
	{
		$model	  = &$this->getModel();
  		$rows     = $model->getDownloadList();
		$this->assignRef('rows'  , $rows);
		parent::display($tpl);
	}	
}

