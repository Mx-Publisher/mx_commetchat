<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: commetchat_drop,v 1.6 2018/12/12 20:07:27 orynider Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/


/***************************************************************************
 *	$Id: commetchat_drop.php,v 1.1 2018/12/12 04:04:34 orynider Exp $
 ***************************************************************************
 * History:
 *
 *	2003/07/18 (FlorinCB)
 *	- MXP30: Use templates for HTML output.
 *
 ***************************************************************************/
//
// Read block Configuration
//

$title = $mx_block->block_info['block_title'];
$block_size = ( isset($block_size) && !empty($block_size) ? $block_size : '100%' );

if( is_object($mx_block))
{
	$is_block = TRUE;
}

include_once($module_root_path .'includes/common.'.$phpEx);


// Check User Session
if( !$userdata['session_logged_in'] )
{
	echo $lang['Please_Login_to_chat'];
	exit();
}

$nick = $mx_user->data['username'];

$template->set_filenames(array(
	'commetchat_drop' => 'commetchat_drop.html')
);
$template->assign_vars(array(
	'S_USERNICK'				=> $nick,
	'APP_ID'					=> $commetchat_config['app_id'],
	'L_LOGOUT'				=> $lang['Logout'],
	'L_LOGIN'					=> $lang['Login'],
	'S_DATE'					=> $phpBB2->create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']))
);
$template->pparse('commetchat_drop');


//Some code from INCLUDEJS in Template Class
$commetchat_js_path =  'templates/all/';
$commetchat_asset_file = 'commetchat_drop.js';

$commetchat_footer_line = '<script type="text/javascript" src="' . PORTAL_URL . $module_root_path . $commetchat_js_path . $commetchat_asset_file . '"></script><br />';

$mx_page->add_footer_text($commetchat_footer_line, false);

?>