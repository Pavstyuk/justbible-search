<?php
/*
Plugin Name: Just Bible Search
URI: https://pavstyuk.ru
Description: The plugin integrates the search for words in the Bible in the Synodal translation on the WordPress site. 
Version: 0.1.7
Requires at least: 6.0
Requires PHP: 8.0
Author: Mikhail Pavstyuk
Author URI: https://pavstyuk.ru/
License: GPLv2 or later
Text Domain: justbible-search
Domain Path: /languages
*/

if (!function_exists('add_action')) {
    die('Nothing to do. Bye.');
}

define('JBS_VER', '0.1.7');
define('JBS_DIR', plugin_dir_path(__FILE__));

add_action("admin_menu", "jbs_plugin_pages");

register_activation_hook(__FILE__, "jbs_activation");
register_deactivation_hook(__FILE__, "jbs_deactivation");

function jbs_activation() {}
function jbs_deactivation() {}


add_filter('plugin_action_links', 'jbs_plugin_action_links', 10, 2);

function jbs_plugin_action_links($actions, $plugin_file)
{

    if (false === strpos($plugin_file, basename(__FILE__))) {
        return $actions;
    }

    $settings_link = '<a href="admin.php?page=just-bible-search">' . __('Instructions', 'justbible-search') . '</a>';
    array_unshift($actions, $settings_link);

    return $actions;
}



function jbs_plugin_pages()
{
    add_menu_page(__("Just Bible Search", 'justbible-search'), __("Just Bible Search", 'justbible-search'), 'manage_options', 'just-bible-search', 'jbs_main_page');
}

function jbs_main_page()
{
    require_once JBS_DIR . "content-page.php";
}

add_shortcode('just_bible_search', 'jbc_just_bible_search_function');

function jbc_just_bible_search_function($atts)
{
    $atts = shortcode_atts([
        'title' => "",
        'button'  => __("Search", 'justbible-search'),
        'placeholder' => __("Search request...", 'justbible-search'),
        'translation' => 'nasb,rbo,rst',
    ], $atts);

    $title = trim(htmlspecialchars($atts["title"]));
    $button = trim(htmlspecialchars($atts["button"]));
    $placeholder = trim(htmlspecialchars($atts["placeholder"]));
    $translations = trim(htmlspecialchars($atts["translation"]));
    if (str_contains($translations, ",")) {
        $trans_arr = explode(",", $translations);
    } else {
        $trans_arr = str_word_count($translations, 1);
    }

    require_once "content-shortcode.php";

    return $html;
}
