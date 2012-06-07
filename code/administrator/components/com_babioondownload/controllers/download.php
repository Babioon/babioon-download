<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

require_once JPATH_COMPONENT.'/helpers/helpers.php';

/**
 * BabioonDownload download controller class.
 *
 * @package BABIOON_DOWNLOAD
 */
class BabioonDownloadControllerDownload extends JControllerForm
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 */
	protected $text_prefix = 'BABIOONDOWNLOAD_';	
}	