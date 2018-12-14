<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: db_install.php,v 1.6 2018/12/12 20:07:27 orynider Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/

global $userdata, $phpEx;

//
// Security Check...
//
if( !defined('IN_PORTAL') )
{
	die("Hacking attempt(1)");
}
if ( !defined( 'IN_ADMIN' ) )
{
	$mx_root_path = './../../';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include( $mx_root_path . 'common.' . $phpEx );
	// Start session management
	$mx_user->init($user_ip, PAGE_INDEX);

	if ( !$userdata['session_logged_in'] )
	{
		die( "Hacking attempt(1)" );
	}

	if ( $userdata['user_level'] != ADMIN )
	{
		die( "Hacking attempt(2)" );
	}
	// End session management
}

//
// Check if install is really needed...
//
$module_root_path = dirname(__FILE__) . '/';
include_once($module_root_path . 'includes/common.'.$phpEx);

if( !defined('COMMETCHAT_CONFIG_TABLE') )
{
	mx_message_die(GENERAL_ERROR, "Couldn't load file includes/common.$phpEx", "", __LINE__, __FILE__);
}

$mx_module_version = '1.0.0';
$mx_module_copy = 'MXP <i> - COMMETCHAT</i> module by <a href="http://mxpcms.sf.net" target="_blank">FlorinCB</a>';

// If fresh install
if (!$db->sql_field_exists('config_name', COMMETCHAT_CONFIG_TABLE))
{
	$message = "<b>This is a fresh install!</b><br/><br/>";

	//
	// SQL statements to build required module tables...
	//

	$sql = array();
	
	$sql[] = "DROP TABLE IF EXISTS ".COMMETCHAT_CONFIG_TABLE;
	
	//
	// Added in mx_COMMETCHAT v.1.1.0
	//
	$sql[] = "CREATE TABLE ".COMMETCHAT_CONFIG_TABLE." (
  			config_name VARCHAR(255) NOT NULL default '',
			config_value varchar(255) NOT NULL default '',
			PRIMARY KEY  (config_name)
			) ";

	//
	// Inserts: Default mx_COMMETCHAT Configuration
	//
	$sql[] = "INSERT INTO ".COMMETCHAT_CONFIG_TABLE." VALUES ('app_id', '0000000000000000000000')";

	$sql[] = "UPDATE " . $mx_table_prefix . "module" . "
				    SET module_version  = '" . $mx_module_version . "',
				      module_copy  = '" . $mx_module_copy . "'
				    WHERE module_id = '" . $mx_module_id . "'";

	$message .= mx_do_install_upgrade( $sql );
}
else
{
	// If already installed
	$message = "<b>Module is already installed... consider upgrading ;)</b><br/><br/>";
}

echo "<br /><br />";
echo "<table  width=\"90%\" align=\"center\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">";
echo "<tr><th class=\"thHead\" align=\"center\">Module Installation/Upgrading/Uninstallation Information - Module specific DB tables</th></tr>";
echo "<tr><td class=\"row1\"  align=\"left\"><span class=\"gen\">" . $message . "</span></td></tr>";
echo "</table><br />";

?>