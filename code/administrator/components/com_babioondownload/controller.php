<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * BabioonDownload master display controller.
 */
class BabioonDownloadController extends JController
{
	function __construct($config=array())
	{
		parent::__construct($config);
		$this->default_view = 'downloads';
	}
}
