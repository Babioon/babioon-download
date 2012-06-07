<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include dependancies
jimport('joomla.application.component.controller');

require JPATH_COMPONENT.'/helpers/helpers.php';

// Execute the task.
$controller	= JController::getInstance('BabioonDownload');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();

/** EOF **/