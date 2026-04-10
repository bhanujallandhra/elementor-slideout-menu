<?php
/**
 * Uninstall Elementor Slideout Menu Widget
 *
 * This file runs when the plugin is deleted via WordPress admin.
 * It cleans up all plugin data from the database.
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Delete plugin options
 */
delete_option('slideout_menu_version');

/**
 * Delete transients
 */
delete_transient('slideout_menu_activated');

/**
 * For multisite installations
 */
if (is_multisite()) {
    global $wpdb;

    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    $original_blog_id = get_current_blog_id();

    foreach ($blog_ids as $blog_id) {
        switch_to_blog($blog_id);

        // Delete options for each site
        delete_option('slideout_menu_version');
        delete_transient('slideout_menu_activated');
    }

    switch_to_blog($original_blog_id);
}

/**
 * Clear any cached data
 */
wp_cache_flush();