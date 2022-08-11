<?php
namespace CodingHouse\WPPlugins\GoogleCSE;

require_once __DIR__ . '/../PluginModel.php';

class Plugin extends \CodingHouse\WPPlugins\PluginModel
{
    protected static $pluginName = 'wp_googlecse_plugin';

    public function __construct()
    {
        self::$options = [
            'wpgooglecse_cx',
            'wpgooglecse_cx_multilanguage',
            'wpgooglecse_apikey',
            'wpgooglecse_container_html_class',
            'wpgooglecse_form_html_id',
            'wpgooglecse_form_html_class',
            'wpgooglecse_form_action',
            'wpgooglecse_searchonly_title',
            'wpgooglecse_searchonly_text',
            'wpgooglecse_exactsearch'
        ];
    }

    public static function enqueue(): void
    {
        parent::enqueue();

        wp_enqueue_style('wpgcse_css', plugins_url('assets/css/cse.css', __FILE__));
        wp_enqueue_script('wpgcse_js', plugins_url('assets/js/cse.js', __FILE__));

        return;
    }

    public static function register(): void
    {
        parent::register();

        load_plugin_textdomain('wp-google-cse', false, WP_PLUGIN_DIR . '/languages');

        add_shortcode('wp-google-cse', function($attributes, $content = null) {
            $customActionUri = '';
            if ($content) {
                $customActionUri = htmlspecialchars($content);
            } else {
                $customActionUri = get_option('wpgooglecse_form_action') ?: wp_make_link_relative(get_page_link());
            }

            return '<form method="get" action="' . $customActionUri . '" class="wp-googlecse-form-quicksearch">' . "\n" .
            '<label for="wp-googlecse-quicksearch-text" class="sr-only">' . esc_html__('Search website', 'wp-google-cse') . '</label>' . "\n" .
            '<div class="grid wp-googlecse-form-quicksearch-container">' . "\n" .
            '<input id="wp-googlecse-quicksearch-text" type="search" name="q" placeholder="' . esc_html__('Search website', 'wp-google-cse') . '" value="" />' . "\n" .
            '<button type="submit" name="search"><span class="sr-only">' . esc_html__('Search', 'wp-google-cse') . '</span>' . "\n" .
            '</div>' . "\n" .
            '</form>' . "\n";
        });

        add_action('wp_enqueue_scripts', ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'enqueue']);
        add_filter('plugin_action_links_' . plugin_basename('wp-google-cse/wp-google-cse.php'), ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'settings_links']);

        add_action('admin_menu', ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'add_admin_pages']);

        add_action('admin_init', ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'registerFields']);

        return;
    }

    public static function settings_links(array $links = []): array
    {
        $links[] = '<a href="admin.php?page=' . self::$pluginName . '">Settings</a>';

        return $links;
    }

    public static function registerFields(): void
    {
        $callback = null;

        add_settings_section('wpgooglecse_section', 'Engine Parameters', function() {}, self::$pluginName);

        register_setting('wpgooglecse_option_group', 'wpgooglecse_cx', $callback);
        add_settings_field(
            'wpgooglecse_cx',
            'Search Engine ID *',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_cx" type="text" name="wpgooglecse_cx" placeholder="Search Engine ID" value="' . esc_attr(get_option('wpgooglecse_cx')) . '" size="50" />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">The Engine ID from Google Search Console</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_cx', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_cx_multilanguage', $callback);
        add_settings_field(
            'wpgooglecse_cx_multilanguage',
            'Search Engine IDs for multiple languages',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<textarea id="wpgooglecse_cx_multilanguage" name="wpgooglecse_cx_multilanguage" placeholder="Search Engine IDs lang|CX" rows="10" cols="50">' . esc_attr(get_option('wpgooglecse_cx_multilanguage')) . '</textarea>' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">If you have multiple Engine IDs, one for each language, write one for each line. Example: en|xy123456z</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_cx_multilanguage', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_apikey', $callback);
        add_settings_field(
            'wpgooglecse_apikey',
            'API Key *',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_apikey" type="text" name="wpgooglecse_apikey" placeholder="API Key" value="' . esc_attr(get_option('wpgooglecse_apikey')) . '" size="50" />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">API Key from Google Cloud Console</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_apikey', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_searchonly_title', $callback);
        add_settings_field(
            'wpgooglecse_searchonly_title',
            'Search only in the title',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_searchonly_title" type="checkbox" name="wpgooglecse_searchonly_title" value="t"';
                if (get_option('wpgooglecse_searchonly_title')) {
                    echo ' checked="checked"';
                }
                echo ' />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">Search with intitle: before the query</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_searchonly_title', 'class' => 'regular-checkbox']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_searchonly_text', $callback);
        add_settings_field(
            'wpgooglecse_searchonly_text',
            'Search only in the text',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_searchonly_text" type="checkbox" name="wpgooglecse_searchonly_text" value="t"';
                if (get_option('wpgooglecse_searchonly_text')) {
                    echo ' checked="checked"';
                }
                echo '/>' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">Search with intext: before the query</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_searchonly_text', 'class' => 'regular-checkbox']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_exactsearch', $callback);
        add_settings_field(
            'wpgooglecse_exactsearch',
            'Exact search',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_exactsearch" type="checkbox" name="wpgooglecse_exactsearch" value="t"';
                if (get_option('wpgooglecse_exactsearch')) {
                    echo ' checked="checked"';
                }
                echo ' />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">The query will be enclosed in double quotes (eg. "the game")</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_exactsearch', 'class' => 'regular-checkbox']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_container_html_class', $callback);
        add_settings_field(
            'wpgooglecse_container_html_class',
            'Container HTML Class',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_container_html_class" type="text" name="wpgooglecse_container_html_class" placeholder="(optional) css class for the container to use in the theme" value="' . esc_attr(get_option('wpgooglecse_container_html_class')) . '" size="50" />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">In case you want to customize your container, this will be its additional CSS class</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_container_html_class', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_form_html_id', $callback);
        add_settings_field(
            'wpgooglecse_form_html_id',
            'Form HTML ID',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_form_html_id" type="text" name="wpgooglecse_form_html_id" placeholder="(optional) id attribute for the search form" value="' . esc_attr(get_option('wpgooglecse_form_html_id')) . '" size="50" />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">You might want to use the search form ID attribute for additional checks or with your javascripts</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_form_html_id', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_form_html_class', $callback);
        add_settings_field(
            'wpgooglecse_form_html_class',
            'Form HTML ID',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_form_html_class" type="text" name="wpgooglecse_form_html_class" placeholder="(optional) class attribute for the search form" value="' . esc_attr(get_option('wpgooglecse_form_html_class')) . '" size="50" />' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">Search for CSS class in case you need to style it manually</p>';
                echo '</div>' . "\n";
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_form_html_class', 'class' => 'regular-text']
        );

        register_setting('wpgooglecse_option_group', 'wpgooglecse_form_action', $callback);
        add_settings_field(
            'wpgooglecse_form_action',
            'Form Custom Action URI',
            function() {
                echo '<div class="wpgooglecse-adminsettings-field">' . "\n";
                echo '<input id="wpgooglecse_form_action" type="text" name="wpgooglecse_form_action" placeholder="(optional) specify a form action URI" value="' . esc_attr(get_option('wpgooglecse_form_action')) . '" size="50" />' . "\n";
                echo '</div>' . "\n";
                echo '<p class="wpgooglecse-adminsettings-field-help">URI to use in the action attribute of the form. By default it uses the relative path to get_page_link()</p>';
            },
            'wp_googlecse_plugin', 'wpgooglecse_section', ['label_for' => 'wpgooglecse_form_action', 'class' => 'regular-text']
        );

        return;
    }

    public static function add_admin_pages(): void
    {
        add_menu_page('WP Google CSE', 'WP Google Custom Search Engine', 'manage_options', 'wp_googlecse_plugin', array('\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'template'), 'dashicons-search', 110);

        return;
    }

    public static function template(): bool
    {
        return (require_once plugin_dir_path(__FILE__) . 'assets/templates/admin.php');
    }
}
