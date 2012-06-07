<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

/**
 * BabioonDownload Download controller class.
 *
 * @package BABIOON_DOWNLOAD
 */
class BabioonDownloadControllerDownloads extends JControllerAdmin
{
	/**
	 * @var    string  The prefix to use with controller messages.
	 */
	protected $text_prefix = 'BABIOONDOWNLOAD_';

	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'Download', $prefix = 'BabioonDownloadModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}	