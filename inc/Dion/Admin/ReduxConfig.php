<?php
/**
 * Created by PhpStorm.
 * User: borayalcin
 * Date: 10/06/14
 * Time: 08:33
 */

namespace Dion\Admin;
use \ReduxFramework;
use \Redux_Helpers;


class ReduxConfig
{
    public $args = array();
    public $sections = array();
    public $theme;
    public $ReduxFramework;

    public function __construct()
    {

        if (!class_exists('ReduxFramework')) {
            echo 'noredux';
            return;
        }

        // This is needed. Bah WordPress bugs.  ;)
        if (true == Redux_Helpers::isTheme(__FILE__)) {
            $this->initSettings();
        } else {
            add_action('plugins_loaded', array($this, 'initSettings'), 10);
        }

    }

    public function initSettings()
    {

        // Just for demo purposes. Not needed per say.
        $this->theme = wp_get_theme();

        // Set the default arguments
        $this->setArguments();

        // Set a few help tabs so you can see how it's done
        $this->setHelpTabs();

        // Create the sections and fields
        $this->setSections();

        if (!isset($this->args['opt_name'])) { // No errors please
            return;
        }

        // If Redux is running as a plugin, this will remove the demo notice and links
        //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

        // Function to test the compiler hook and demo CSS output.
        // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
        //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

        // Change the arguments after they've been declared, but before the panel is created
        //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

        // Change the default value of a field after it's been set, but before it's been useds
        //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

        // Dynamically add a section. Can be also used to modify sections/fields
        //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

        $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
    }

    /**
     *
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

        /*
          // Demo of how to use the dynamic CSS and write your own static CSS file
          $filename = dirname(__FILE__) . '/style' . '.css';
          global $wp_filesystem;
          if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
          WP_Filesystem();
          }

          if( $wp_filesystem ) {
            $wp_filesystem->put_contents(
                $filename,
                $css,
                FS_CHMOD_FILE // predefined mode settings for WP files
            );
          }
         */
    }

    /**
     *
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     *
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section($sections)
    {
        //$sections = array();
        $sections[] = array(
            'title'  => __('Section via hook', 'dion'),
            'desc'   => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'dion'),
            'icon'   => 'el-icon-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     *
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments($args)
    {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     *
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults($defaults)
    {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo()
    {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }

    public function setSections()
    {

        /**
         * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
         * */
        // Background Patterns Reader
        $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
        $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
        $sample_patterns      = array();

        if (is_dir($sample_patterns_path)) :

            if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                $sample_patterns = array();

                while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                    if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                        $name              = explode('.', $sample_patterns_file);
                        $name              = str_replace('.' . end($name), '', $sample_patterns_file);
                        $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                    }
                }
            endif;
        endif;

        ob_start();

        $ct          = wp_get_theme();
        $this->theme = $ct;
        $item_name   = $this->theme->get('Name');
        $tags        = $this->theme->Tags;
        $screenshot  = $this->theme->get_screenshot();
        $class       = $screenshot ? 'has-screenshot' : '';

        $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'dion'), $this->theme->display('Name'));

        ?>
        <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                    <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                       title="<?php echo esc_attr($customize_title); ?>">
                        <img src="<?php echo esc_url($screenshot); ?>"
                             alt="<?php esc_attr_e('Current theme preview'); ?>"/>
                    </a>
                <?php endif; ?>
                <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>"
                     alt="<?php esc_attr_e('Current theme preview'); ?>"/>
            <?php endif; ?>

            <h4><?php echo $this->theme->display('Name'); ?></h4>

            <div>
                <ul class="theme-info">
                    <li><?php printf(__('By %s', 'dion'), $this->theme->display('Author')); ?></li>
                    <li><?php printf(__('Version %s', 'dion'), $this->theme->display('Version')); ?></li>
                    <li><?php echo '<strong>' . __('Tags', 'dion') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                </ul>
                <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'dion'), $this->theme->parent()->display('Name'));
                }
                ?>

            </div>
        </div>

        <?php
        $item_info = ob_get_contents();

        ob_end_clean();

        $sampleHTML = '';
        if (file_exists(dirname(__FILE__) . '/info-html.html')) {
            /** @global WP_Filesystem_Direct $wp_filesystem */
            global $wp_filesystem;
            if (empty($wp_filesystem)) {
                require_once(ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
        }

        // ACTUAL DECLARATION OF SECTIONS
                
        $this->sections[] = Sections\GeneralSettings::get();
        //$this->sections[] = Sections\HomeSettings::get();
        $this->sections[] = Sections\SocialMedia::get();
        $this->sections[] = Sections\ThemeSettings::get();
        //$this->sections[] = Sections\Blog::get();
        //$this->sections[] = Sections\Category::get();
        //$this->sections[] = Sections\TrainingVideos::get();
        


        $theme_info = '<div class="redux-framework-section-desc">';
        $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'dion') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
        $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'dion') . $this->theme->get('Author') . '</p>';
        $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'dion') . $this->theme->get('Version') . '</p>';
        $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
        $tabs = $this->theme->get('Tags');
        if (!empty($tabs)) {
            $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'dion') . implode(', ', $tabs) . '</p>';
        }
        $theme_info .= '</div>';

        if (file_exists(dirname(__FILE__) . '/../README.md')) {
            $this->sections['theme_docs'] = array(
                'icon'   => 'el-icon-list-alt',
                'title'  => __('Documentation', 'dion'),
                'fields' => array(
                    array(
                        'id'       => '17',
                        'type'     => 'raw',
                        'markdown' => true,
                        'content'  => file_get_contents(dirname(__FILE__) . '/../README.md')
                    ),
                ),
            );
        }

        $this->sections[] = array(
            'icon'            => 'el-icon-list-alt',
            'title'           => __('Customizer Only', 'dion'),
            'desc'            => __('<p class="description">This Section should be visible only in Customizer</p>', 'dion'),
            'customizer_only' => true,
            'fields'          => array(
                array(
                    'id'              => 'opt-customizer-only',
                    'type'            => 'select',
                    'title'           => __('Customizer Only Option', 'dion'),
                    'subtitle'        => __('The subtitle is NOT visible in customizer', 'dion'),
                    'desc'            => __('The field desc is NOT visible in customizer.', 'dion'),
                    'customizer_only' => true,

                    //Must provide key => value pairs for select options
                    'options'         => array(
                        '1' => 'Opt 1',
                        '2' => 'Opt 2',
                        '3' => 'Opt 3'
                    ),
                    'default'         => '2'
                ),
            )
        );

        $this->sections[] = array(
            'title'  => __('İçeri / Dışarı Aktar', 'dion'),
            'desc'   => __('Tema ayarlarınızı buradan kaydedebilirsiniz. Bunun için dışarı aktarma bölümünü kullanabilirsiniz. Aynı şekilde içeri aktarmayı da kullanabilirsiniz. ', 'dion'),
            'icon'   => 'el-icon-refresh',
            'fields' => array(
                array(
                    'id'         => 'opt-import-export',
                    'type'       => 'import_export',
                    'title'      => 'Import Export',
                    'subtitle'   => 'Save and restore your Redux options',
                    'full_width' => false,
                ),
            ),
        );

        $this->sections[] = array(
            'type' => 'divide',
        );


        if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
            $tabs['docs'] = array(
                'icon'    => 'el-icon-book',
                'title'   => __('Documentation', 'dion'),
                'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
            );
        }
    }

    public function setHelpTabs()
    {

        // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
        $this->args['help_tabs'][] = array(
            'id'      => 'redux-help-tab-1',
            'title'   => __('Theme Information 1', 'dion'),
            'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'dion')
        );

        $this->args['help_tabs'][] = array(
            'id'      => 'redux-help-tab-2',
            'title'   => __('Theme Information 2', 'dion'),
            'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'dion')
        );

        // Set the help sidebar
        $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'dion');
    }

    /**
     *
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    public function setArguments()
    {

        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'           => 'dionOpt', // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'       => $theme->get('Name'), // Name that appears at the top of your panel
            'display_version'    => $theme->get('Version'), // Version that appears at the top of your panel
            'menu_type'          => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'     => true, // Show the sections below the admin menu item or not
            'menu_title'         => __('Tema Ayarları', 'dion'),
            'page_title'         => __('Tema Ayarları', 'dion'),

            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key'     => '', // Must be defined to add google fonts to the typography module

            'async_typography'   => false, // Use a asynchronous font on the front end or font string
            'admin_bar'          => true, // Show the panel pages on the admin bar
            'global_variable'    => '', // Set a different name for your global variable other than the opt_name
            'dev_mode'           => false, // Show the time the page took to load, etc
            'customizer'         => true, // Enable basic customizer support
            //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
            //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

            // OPTIONAL -> Give you extra features
            'page_priority'      => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'        => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'   => 'manage_options', // Permissions needed to access the options panel.
            'menu_icon'          => '', // Specify a custom URL to an icon
            'last_tab'           => '', // Force your panel to always open to a specific tab (by id)
            'page_icon'          => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
            'page_slug'          => '_options', // Page slug used to denote the panel
            'save_defaults'      => true, // On load save the defaults to DB before user clicks save or not
            'default_show'       => false, // If true, shows the default value next to each field that is not the default value.
            'default_mark'       => '', // What to print by the field's title if the value shown is default. Suggested: *
            'show_import_export' => true, // Shows the Import/Export panel when not used as a field.

            // CAREFUL -> These options are for advanced use only
            'transient_time'     => 60 * MINUTE_IN_SECONDS,
            'output'             => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'         => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
            // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'           => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'system_info'        => false, // REMOVE

            // HINTS
            'hints'              => array(
                'icon'          => 'icon-question-sign',
                'icon_position' => 'right',
                'icon_color'    => 'lightgray',
                'icon_size'     => 'normal',
                'tip_style'     => array(
                    'color'   => 'light',
                    'shadow'  => true,
                    'rounded' => false,
                    'style'   => '',
                ),
                'tip_position'  => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ),
                'tip_effect'    => array(
                    'show' => array(
                        'effect'   => 'slide',
                        'duration' => '500',
                        'event'    => 'mouseover',
                    ),
                    'hide' => array(
                        'effect'   => 'slide',
                        'duration' => '500',
                        'event'    => 'click mouseleave',
                    ),
                ),
            )
        );

        // Panel Intro text -> before the form
        /*if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
            if (!empty($this->args['global_variable'])) {
                $v = $this->args['global_variable'];
            } else {
                $v = str_replace('-', '_', $this->args['opt_name']);
            }
            $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'dion'), $v);
        } else {
            $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'dion');
        }

        // Add content after the form.
        //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'dion'); 
        */
    }


} 