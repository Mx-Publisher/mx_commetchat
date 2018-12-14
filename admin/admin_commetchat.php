<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: admin_commetchat.php,v 1.6 2018/12/12 20:07:27 orynider Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/

/***************************************************************************
 *	$Id: admin_commetchat.php,v 1.6 2018/12/12 04:04:34 orynider Exp $
 ***************************************************************************

/***************************************************************************
 * History:
 *
 *	2018/12/13 (FlorinCB)
 *	- MX30: Script created.
 *
 ***************************************************************************/

// ======================================================
//			[ ADMINCP COMMON INITIALIZATION ]
// ======================================================

//
// Add our entry to the Administration Control Panel...
//
if( !empty($setmodules) )
{
	$module['CommetChat']['Settings'] = 'modules/mx_commetchat/admin/' . @basename(__FILE__);
	return;
}

//
// Setup basic portal stuff...
//
define('IN_PORTAL', true);
$mx_root_path = '../../../';
$module_root_path = "../";


$phpEx = substr(strrchr(__FILE__, '.'), 1);
//
// Load default header
//
define('IN_ADMIN', 1); 
require($mx_root_path . 'admin/pagestart.' . $phpEx);

//
// Include common module stuff...
//
require($module_root_path . 'includes/common.'.$phpEx);

//
// Send page header...
//
include_once($mx_root_path . 'admin/page_header_admin.'.$phpEx);


// ======================================================
//			[ MAIN PROCESS ]
// ======================================================

//
// Read the module settings...
//
$sql = "SELECT * FROM ".COMMETCHAT_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	mx_message_die(GENERAL_ERROR, "Couldn't query CommetChat config table", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$config_name = $row['config_name'];
	$config_value = $row['config_value'];
	$default_config[$config_name] = $config_value;

	$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];
	if( isset($_POST['submit']) )
	{
		$sql = "UPDATE ".COMMETCHAT_CONFIG_TABLE.
			" SET config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'" .
			" WHERE config_name = '$config_name'";
		if( !$db->sql_query($sql) )
		{
			mx_message_die(GENERAL_ERROR, "Failed to update CommetChat configuration for $config_name", "", __LINE__, __FILE__, $sql);
		}
	}
}

//
// If the form was submitted, display the update successful message...
//
if( isset($_POST['submit']) )
{
	$message = $lang['CommetChat_Settings_updated'] .
		'<br /><br />' .
		sprintf($lang['CommetChat_Settings_return'], '<a href="' . mx_append_sid("admin_CommetChat.$phpEx") . '">', '</a>') .
		'<br /><br />' .
		sprintf($lang['Click_return_admin_index'], '<a href="' . mx_append_sid($mx_root_path . "admin/index.$phpEx?pane=right") . '">', '</a>');
	mx_message_die(GENERAL_MESSAGE, $message);
}

//
// Prepare and send the settings form...
//


$template->set_filenames(array(
	"body" => "admin/commetchat_config_body.html")
);

$template->assign_vars(array(
	'S_ACTION'					=> mx_append_sid("admin_commetchat.$phpEx"),
	'L_COMMETCHAT_SETTINGS'		=> $lang['CommetChat_Settings'],
	'L_COMMETCHAT_SETTINGS_EXPLAIN' => $lang['CommetChat_Settings_explain'],

	'L_COMMETCHAT_APP_ID'	=> $lang['CommetChat_APP_ID'],
	'L_COMMETCHAT_APP_ID_EXPLAIN'	=> $lang['CommetChat_APP_ID_explain'],
	'COMMETCHAT_APP_ID'		=> $new['app_id'],

	'L_SUBMIT'					=> $lang['Submit'],
	'L_RESET'						=> $lang['Reset'])
);

$template->pparse("body");

include_once($mx_root_path . 'admin/page_footer_admin.' . $phpEx);

?>