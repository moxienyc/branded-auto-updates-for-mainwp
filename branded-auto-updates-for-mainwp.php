<?php
/**
 * The main plugin file
 *
 * MainWP extention that give you the ability to automatically upgrade different
 * groups of sites on a daily or weekly basis, and send a branded email notification
 * to multiple recipients afterward.
 *
 * @since 0.1.0
 *
 * @package Branded_Auto_Updates_For_MainWP
 */

/*
Plugin Name: Branded Auto Updates for MainWP
Description: Automatically upgrade different groups of sites on a daily or weekly basis, and send a branded email notification to multiple recipients afterward.
Version: 0.2.0
Author: Moxie
Author URI: http://getmoxied.net
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: baufm
Domain Path: /languages
*/

/*
Copyright 2015  Dominique Mariano ( dominique.acpal.mariano@gmail.com )

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! function_exists( 'add_action' ) && ! function_exists( 'add_filter' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

define( 'BAUFM', plugin_basename( __FILE__ ) );
define( 'BAUFM_PREFIX', 'baufm_' );
define( 'BAUFM_PLUGIN_VERSION', '0.2.0' );
define( 'BAUFM_WP_VERSION', '4.2.3' );
define( 'BAUFM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BAUFM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Autoload Composer modules. This will have to be replaced later.
require_once( 'vendor/autoload.php' );

require_once( 'includes/vars.php' );
require_once( 'includes/class.baufm-main.php' );
require_once( 'includes/class.baufm-updater.php' );
require_once( 'includes/notifications.php' );
require_once( 'admin/admin.php' );

register_activation_hook( __FILE__, array( 'BAUFM_Main', 'maybe_deactivate' ) );
register_activation_hook( __FILE__, array( 'BAUFM_Main', 'maybe_update' ) );
register_activation_hook( __FILE__, array( 'BAUFM_Main', 'flush_rules' ) );
register_deactivation_hook( __FILE__, array( 'BAUFM_Main', 'flush_rules' ) );
add_action( 'init', array( 'BAUFM_Main', 'init' ) );
