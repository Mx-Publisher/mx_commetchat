<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: commetchat_test1.php,v 1.6 2018/12/12 20:07:27 orynider Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/

/***************************************************************************
 *	$Id: commetchat_test1.php,v 1.1 2018/12/12 04:04:34 orynider Exp $
 ***************************************************************************
 * History:
 *
 *	2003/07/18 (FlorinCB)
 *	- MXP30: Use templates for HTML output.
 *
 ***************************************************************************/

// --------------------------------------------------------------------------------
// Security check
//

if( !defined('IN_PORTAL') )
{
	die("Hacking attempt");
}

// --------------------------------------------------------------------------------
// Initialization
//

//
// Common Includes and Read Module Settings
//
if( !file_exists($module_root_path . 'includes/common.'.$phpEx) )
{
	mx_message_die(GENERAL_ERROR, "Could not find mx_commetchat includes folder.", "", __LINE__, __FILE__);
}

include_once($module_root_path . 'includes/common.'.$phpEx);

//
// Read block Configuration
//
$title = $mx_block->block_info['block_title'];
$block_size    = ( isset($block_size) && !empty($block_size) ? $block_size : '100%' );

$template->set_filenames(array(
	'commetchat_front' => 'commetchat_test1.html')
);
$template->assign_vars(array(
	'S_USERNICK'				=> $mx_user->data['username'],
	'S_USER_ID'				=> $mx_user->data['user_id'],
	'APP_ID'					=> $commetchat_config['app_id'],
	'L_LOGOUT'				=> $lang['Logout'],
	'L_LOGIN'					=> $lang['Login'],
	'S_DATE'					=> $phpBB2->create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']))
);
$template->pparse('commetchat_front');

?>