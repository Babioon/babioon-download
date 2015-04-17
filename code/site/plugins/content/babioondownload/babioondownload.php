<?php
/**
 * babioon download
 * @author Robert Deutz
 * @copyright Robert Deutz Business Solution
 * @package BABIOON_DOWNLOAD
 **/
 
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class plgContentBabioonDownload extends JPlugin
{
	/**
	 * delete the on/off tag within the content
	 * 
	 * @param article object $row
	 */
	private function deleteTags(&$row)
	{
		if ($this->params->get('deleteOnOffTags', true))
		{
			$row->text = str_replace(array('{babioondownloadoff}','{babioondownloadon}'), array('',''), $row->text);
		}
	}
	
	/**
	 * the onContentPrepare event
	 * 
	 * @param string $context
	 * @param article $row
	 * @param object $params
	 * @param integer $page
	 */
	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		$parseContent = $this->params->get('parseContent', true);
		
		if($parseContent)
		{
			// default behaviour is parse the content, so we look for a {babioondownloadoff}
			if (strpos($row->text,'{babioondownloadoff}') !== false)
			{
				$this->deleteTags($row);
				return true;
			}
		}
		else 
		{
			// it is configured not to parse the content, so we look for a {babioondownloadon} to overwrite the behaviour
			if (strpos($row->text,'{babioondownloadon}') === false)
			{
				return true;
			}
			$this->deleteTags($row);
		}
		
		// ok we have to do the work
		$tag=$this->params->get('tag','babioondownload');
		// looking if we have a tag within the context
		if ( strpos( $row->text, '{'.$tag.'}' ) === false ) 
		{
			return true;
		}

		// currious there is something we can replace
		// regular expression for the bot
		$regex = "#{".$tag."}(.*?){/".$tag."}#s";
		
		$matches=array();
	 	// find all instances of plugin and put in $matches
		preg_match_all( $regex, $row->text, $matches );

		// Number of matches
	 	$count = count( $matches[0] );
	 	// plugin only processes if there are any instances of the plugin in the text
	 	if ( $count ) 
	 	{
	 		$db =& JFactory::getDBO();
	 		
	 		
	 		
	 		
	 		
	 	}
	 	
		
	}
	

	function botrddownload(&$row) 
	{
	
		$downloaddir = $config->get ( 'downloaddir','downloads' );
	
		if($downloaddir{0} != '/')
		{
			// relative dir, make it absolute
			$downloaddir=JPATH_ROOT.DS.$downloaddir;
		}
	
		if (!is_dir($downloaddir))
		{
			$row->text = preg_replace( $regex, 'DIRECTORY NOT VALID:'. $downloaddir, $row->text );
			return true;
		}
		
		$matches=array();
	 	// find all instances of plugin and put in $matches
		preg_match_all( $regex, $row->text, $matches );
	
		// Number of plugins
	 	$count = count( $matches[0] );
	
	 	// plugin only processes if there are any instances of the plugin in the text
	 	if ( $count ) 
	 	{
			$db =& JFactory::getDBO();
			
			for($i=0;$i<$count;$i++)
			{
				$m = $matches[0][$i];
				$m = str_replace ('{rddl}','',$m);
				$m = str_replace ('{/rddl}','',$m);
				$filename = trim($matches[1][$i]);
				$pubfound = false;
				$query = "SELECT * FROM #__rd_download WHERE filename='$filename'";
				$db->setQuery ( $query );
				$rows = $db->loadObjectList ();
				$rc = count ( $rows );
				if ( is_array ( $rows ) && $rc != 0 )
				{
					for($j=0;$j<$rc;$j++)
					{
						$r=$rows[$j];
						if($r->published == 1)
						{
							//$row=$r;
							$pubfound=true;
							break;							
						}
					}
				}
				$filefound = in_array($filename,scandir ( $downloaddir ));
				if ($pubfound && $filefound) 
				{
					$replace = '<a href="index.php?option=com_rd_download&view=download&task=dl&id='.$r->id.'">'.$r->text.'</a>';
				}
				else
				{
					if ($filefound)
					{
						if ($rc == 0)
						{
							// new file insert in table
							$db->setQuery 	( "INSERT INTO `#__rd_download` ( `id` ,`text` ,`filename` ,`klicks` , `published` ) VALUES ".
												"( NULL , '$filename', '$filename', '0', '1' )" 
											);
							if($db->Query())
							{
								// get last id
								$db->setQuery('SELECT LAST_INSERT_ID( )');
								$id = $db->loadResult();
								$replace = '<a href="index.php?option=com_rd_download&view=download&task=dl&id='.$id.'">'.$filename.'</a>';
							}
							else 
							{	
								// error
								$replace = JText::_('RDDOWNLOAD_FATALCOULDNOTIMPORTINTABLE');
							}
						} 
						else 
						{	
							$replace = '';
							if ($verbose == 1)
							{
								$replace = JText::sprintf('RDDOWNLOAD_FILEUNPUBLISHED',$filename);
							}
						}
					}
					else 
					{
						// file not found
						$replace = '';
						if ($verbose == 1)
						{
							$replace = JText::sprintf('RDDOWNLOAD_FILENOTFOUND',$filename, $downloaddir);
						}
					}
				}
				$row->text 	= str_replace($matches[0][$i], $replace, $row->text );			
			}
	 	}
		return true;
	}
}