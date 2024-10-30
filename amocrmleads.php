<?php
/*
Plugin Name: The integration of the AMO.CRM
Plugin URI: https://jh5.ru/amoleads
Description: Интеграция с AMO.CRM Лиды. Плагин позволяет выводит в удобной виде сделки с системы AMO.CRM
Version: 1.0.1
Author: Pavel Michkov
Author URI: https://jh5.ru/
License: GPLv2 or later
Text Domain: jh5
 */

/*  Copyright 2020  Pavel Michkov  (email: sale@jh5.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) || exit;
define( 'AMO_VERSION', '1.0.1' );
define( 'AMO__MINIMUM_WP_VERSION', '5.0' );
define( 'AMO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AMO_DELETE_LIMIT', 100000 );


if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once( AMO__PLUGIN_DIR . 'class.amo.php' );


add_action( 'init', array( 'Amo', 'init' ) );

add_action( 'admin_menu', 'amo_menu' );


register_activation_hook( __FILE__, 'amo_install' );
register_deactivation_hook( __FILE__, 'amo_uninstall' );

require_once( AMO__PLUGIN_DIR . 'amo-admin.php' );


function amo_menu() {
	add_menu_page( 'AMO.CRM Leads', 'AMO.CRM', 'manage_options', 'amocrm/amo-admin.php', 'settings_page', 'dashicons-edit' );
	if ( function_exists( 'add_menu_page' ) ) {
		add_submenu_page( 'amocrm/amo-admin.php', 'Настройки', 'Настройки', 'manage_options', 'amocrm/amo-admin.php', 'settings_page' );
		add_submenu_page( 'amocrm/amo-admin.php', 'Заявки', 'Заявки', 'manage_options', 'amocrm/amo-admin-leads.php', 'leads_page' );
	}
}

function settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'У вас нет прав доступа на эту страницу.' ) );
	}
	require_once( 'main.php' );
}

function leads_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'У вас нет прав доступа на эту страницу.' ) );
	}
	require_once( 'lead.php' );
}


function amo_install() {
	global $wpdb;
	$table_name = $wpdb->prefix . "amo";
	if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
		$sql = "CREATE TABLE " . $table_name . " (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  created_at timestamp  COLLATE utf8_general_ci,
  updated_at timestamp  COLLATE utf8_general_ci,
  title varchar(255) NOT NULL COLLATE utf8_general_ci,
  description text NOT NULL COLLATE utf8_general_ci,
  UNIQUE KEY id (id)
 );";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		$wpdb->insert( $table_name,
			array(
				'title'       => 'Amo.CRM Leads',
				'description' => 'Amo.CRM Leads - Система управления лидами'
			) );
	}
	add_option( 'amo_leads_count', 0,'','yes' );
	add_option( 'amo_leads_settings', serialize(['url'=>'https://amocrm.ru/api/v2/','user_login'=>'','user_hash'=>'']),'','yes' );
}

function amo_uninstall() {
	global $wpdb;
	$table_name = $wpdb->prefix . "amo";
	$sql        = "DROP TABLE $table_name";
	$wpdb->query( $sql );
	delete_option('amo_leads_count');
	delete_option('amo_leads_settings');
}

