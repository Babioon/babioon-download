<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/

// No direct access
defined('_JEXEC') or die;

/**
 * BabioonDownloadHelpers
 *
 * @package		BABIOON_DOWNLOAD
 */
class BabioonDownloadHelpers
{

	/**
	 * @var    string  The prefix to use with controller messages.
	 */
	protected static $text_prefix = 'BABIOONDOWNLOAD_';
    
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	
	 *
	 * @return	JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
		$assetName = 'com_babioonkoorga';
		
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
}