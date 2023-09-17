<?php

/**
 * Plugin Name: My Elementor Widget
 * Plugin URI: https://example.com
 * Description: A custom elementor widget
 * Version: 1.0.0
 * Author: Syed
 * Author URI: https://johndoe.me
 * Text Domain: my-elementor-widget
 */

if (!defined('ABSPATH')) exit();

/**
 * Elementor Extension main CLass
 * @since 1.0.0
 */
final class MY_Elementor_Widget
{

    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    // Minimum PHP Version
    const MINIMUM_PHP_VERSION = '7.0';

    // Instance
    private static $_instance = null;

    /**
     * SIngletone Instance Method
     * @since 1.0.0
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Construct Method
     * @since 1.0.0
     */
    public function __construct()
    {
        // Call Constants Method
        $this->define_constants();
        add_action('wp_enqueue_scripts', [$this, 'scripts_styles']);
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Define Plugin Constants
     * @since 1.0.0
     */
    public function define_constants()
    {
        define('MYEW_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));
        define('MYEW_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
    }

    /**
     * Load Scripts & Styles
     * @since 1.0.0
     */
    public function scripts_styles()
    {
        wp_register_style('myew-style', MYEW_PLUGIN_URL . 'assets/dist/css/public.min.css', [], rand(), 'all');
        wp_register_script('myew-script', MYEW_PLUGIN_URL . 'assets/dist/js/public.min.js', ['jquery'], rand(), true);

        wp_enqueue_style('myew-style');
        wp_enqueue_script('myew-script');
    }

    /**
     * Load Text Domain
     * @since 1.0.0
     */
    public function i18n()
    {
        load_plugin_textdomain('my-elementor-widget', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Initialize the plugin
     * @since 1.0.0
     */
    public function init()
    {

        add_action('elementor/init', [$this, 'init_category']);
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
    }

    /**
     * Init Widgets
     * @since 1.0.0
     */
    public function init_widgets()
    {
        require_once MYEW_PLUGIN_PATH . '/widgets/preview-card.php';
    }

    /**
     * Init Category Section
     * @since 1.0.0
     */
    public function init_category()
    {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'myew-for-elementor',
            [
                'title' => 'My Elementor Widgets'
            ],
            1
        );
    }
}

MY_Elementor_Widget::instance();
