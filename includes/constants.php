<?php
/**
*
* @package MX-Publisher Module - mx_commetchat
* @version $Id: constants.php,v 1.6 2008/06/03 20:07:27 jonohlsson Exp $
* @copyright (c) 2002-2006 [FlorinCB] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
* @link http://mxpcms.sf.net/
*
*/

if( !defined('IN_PORTAL') || (!isset($mx_block) && !defined( 'IN_ADMIN' )) )
{
	die("Hacking attempt");
}

// ---------------------------------------------------------------------START
// This file defines specific constants for the module
// -------------------------------------------------------------------------
define('COMMETCHAT_CONFIG_TABLE', $mx_table_prefix.'commetchat_config');

$phpbb_module_version = "1.0";
$phpbb_module_author = "MXP Develoment Team";

$root_path = __FILE__;
if (strpos($root_path, '.') !== false)
{
	// modules\mx_dev_startkit
	$filename_ext = substr(strrchr($root_path, '.'), 1);
	$filename = basename($root_path, '.' . $filename_ext);
	$current_dir = dirname(realpath($root_path));
	$root_path = dirname($root_path);
	$module_name = explode('mx_', $root_path);
	$module_name = explode('\\', $module_name[1]);
	$module_name = $module_name[0];
	$module_dir = 'mx_'.$module_name;			
}
else
{
	$filename_ext = substr(strrchr(__FILE__, '.'), 1);
	$filename = "startkit_constants";
	$current_dir = $root_path;
	$root_path = dirname($root_path);
	$module_name = explode('mx_', $root_path);
	$module_name = explode('\\', $module_name[1]);
	$module_name = $module_name[0];
	$module_dir = 'mx_'.$module_name;	
}

//Check if is_block IN_PORTAL page
if (isset($mx_page) && is_object($mx_page))
{
	// For compatibility with core 2.8.x
	$mx_user->set_module_default_style('_core'); 
	// -------------------------------------------------------------------------
	// Extend User Style with module lang and images
	// Usage:  $mx_user->extend(LANG, IMAGES)
	// Switches:
	// - LANG: MX_LANG_MAIN (default), MX_LANG_ADMIN, MX_LANG_ALL, MX_LANG_NONE
	// - IMAGES: MX_IMAGES (default), MX_IMAGES_NONE
	// -------------------------------------------------------------------------
	
	// -------------------------------------------------------------------------
	// Extend page with additional header or footer data
	// Examples:
	//	$mx_page->add_css_file(); // Include style dependent *.css file, eg module_path/template_path/template/theme.css
	//	$mx_page->add_js_file( 'includes/js.js' ); // Relative to module_root
	//	$mx_page->add_header_text( 'header text' );
	//	$mx_page->add_footer_text( 'includes/test.txt', true ); // Relative to module_root
	//  Note: Included text from file (last example), will evaluate $theme and $mx_block->info variables.
	// -------------------------------------------------------------------------
	if (!defined('IN_ADMIN'))
	{
		$mx_user->extend(MX_LANG_MAIN, MX_IMAGES_NONE);
	}
	else
	{
		$mx_user->extend(MX_LANG_ALL, MX_IMAGES_NONE, $module_root_path, true);
	}
	$mx_page->add_copyright('MXP CommetChat Module');
}
elseif (isset($mx_user))
{
	// For compatibility with core 2.8.x
	$mx_user->set_module_default_style('_core'); 
	// -------------------------------------------------------------------------
	// Extend User Style with module lang and images
	// Usage:  $mx_user->extend(LANG, IMAGES)
	// Switches:
	// - LANG: MX_LANG_MAIN (default), MX_LANG_ADMIN, MX_LANG_ALL, MX_LANG_NONE
	// - IMAGES: MX_IMAGES (default), MX_IMAGES_NONE
	// -------------------------------------------------------------------------
	$mx_user->extend(MX_LANG_ALL, MX_IMAGES_NONE, $module_root_path, true);
}
else
{
	if ( !file_exists( $module_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx ) )
	{
		include( $module_root_path . 'language/lang_english/lang_admin.' . $phpEx );
	}
	else
	{
		include( $module_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx );
	}
}
// ----------

?>