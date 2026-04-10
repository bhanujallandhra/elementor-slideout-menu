<?php
/**
 * Plugin Name: Elementor Slideout Menu Widget
 * Description: A customizable slideout menu widget for Elementor with WordPress menu integration
 * Plugin URI: https://atwebforge.com
 * Version: 1.2
 * Author: Bhanu J
 * Author URI: https://atwebforge.com
 * Text Domain: slideout-menu-widget
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Elementor tested up to: 3.20.0
 * Elementor Pro tested up to: 3.20.0
 */

use ElementorSlideoutMenu\Widgets\Elementor_Slideout_Menu_Widget;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Main Slideout Menu Widget Class
 */
final class Elementor_Slideout_Menu_Plugin {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);

        // Activation hook
        register_activation_hook(__FILE__, [$this, 'plugin_activate']);

        // Deactivation hook
        register_deactivation_hook(__FILE__, [$this, 'plugin_deactivate']);
    }

    /**
     * Plugin activation
     */
    public function plugin_activate() {
        // Check if Elementor is installed
        if (!did_action('elementor/loaded')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(
                __('Elementor Slideout Menu Widget requires Elementor to be installed and activated.', 'slideout-menu-widget'),
                __('Plugin Activation Error', 'slideout-menu-widget'),
                ['back_link' => true]
            );
        }

        // Set a transient to show activation notice
        set_transient('slideout_menu_activated', true, 5);

        // Store plugin version
        update_option('slideout_menu_version', self::VERSION);

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation
     */
    public function plugin_deactivate() {
        // Clean up transients
        delete_transient('slideout_menu_activated');

        // Flush rewrite rules
        flush_rewrite_rules();

        // Note: We don't delete options here to preserve settings
        // Options are only deleted on uninstall
    }

    /**
     * Initialize the plugin
     */
    public function init() {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Register Widget
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Load plugin text domain
        add_action('init', [$this, 'i18n']);

    }

    /**
     * Load Textdomain
     */
    public function i18n() {
        load_plugin_textdomain('slideout-menu-widget', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Admin notice - Missing Elementor
     */
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'slideout-menu-widget'),
            '<strong>' . esc_html__('Elementor Slideout Menu Widget', 'slideout-menu-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'slideout-menu-widget') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice - Minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'slideout-menu-widget'),
            '<strong>' . esc_html__('Elementor Slideout Menu Widget', 'slideout-menu-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'slideout-menu-widget') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice - Minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'slideout-menu-widget'),
            '<strong>' . esc_html__('Elementor Slideout Menu Widget', 'slideout-menu-widget') . '</strong>',
            '<strong>' . esc_html__('PHP', 'slideout-menu-widget') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Register Widgets
     */
    public function register_widgets($widgets_manager) {
        // Include widget file
        require_once(__DIR__ . '/widgets/slideout-menu.php');

        $widgets_manager->register(new Elementor_Slideout_Menu_Widget());
    }
}

Elementor_Slideout_Menu_Plugin::instance();