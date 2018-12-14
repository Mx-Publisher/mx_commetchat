<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: common.php,v 1.6 2018/12/12 20:07:27 orynider Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/

//
// Security check
//
if( !defined('IN_PORTAL') )
{
	die("Hacking attempt");
}

// ===================================================
// Include Files
// ===================================================
include_once($module_root_path . 'includes/constants.' . $phpEx );

//
// Common definitions...
//

$cfg_chatname = $board_config['sitename'] . ' -&gt; '; // . $lang['CommetChat'];


// ================================================================================
//			[ COMMET CHAT CONFIG ]
// ================================================================================

//
// Get COMMET CHAT Settings from config table
//
if ($db->sql_field_exists('config_name', COMMETCHAT_CONFIG_TABLE))
{
	$commetchat_config = array();

	$sql = "SELECT * FROM ".COMMETCHAT_CONFIG_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		mx_message_die(GENERAL_ERROR, "Couldn't query COMMET CHAT config table", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		while( $row = $db->sql_fetchrow($result) )
		{
			$commetchat_config[$row['config_name']] = $row['config_value'];
		}
	}
}

?>