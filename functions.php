<?php
/**
 * DJ Landing Page Theme Functions
 * WordPress theme functions for DJ Erez Gold landing page
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function dj_landing_setup() {
    // Add theme support for various WordPress features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for wide alignment
    add_theme_support('align-wide');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'dj_landing_setup');

/**
 * Enqueue scripts and styles
 */
function dj_landing_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style(
        'dj-landing-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Google Fonts
    wp_enqueue_style(
        'dj-landing-fonts',
        'https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800&family=Assistant:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );
    
    // Enqueue Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // Enqueue theme JavaScript
    wp_enqueue_script(
        'dj-landing-script',
        get_template_directory_uri() . '/script.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Localize script for AJAX
    wp_localize_script('dj-landing-script', 'djAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('dj_ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'dj_landing_scripts');

/**
 * Add custom CSS for RTL support
 */
function dj_landing_rtl_support() {
    if (is_rtl()) {
        wp_enqueue_style(
            'dj-landing-rtl',
            get_template_directory_uri() . '/rtl.css',
            array('dj-landing-style'),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'dj_landing_rtl_support');

/**
 * Register navigation menus
 */
function dj_landing_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dj-landing'),
        'social'  => __('Social Media Menu', 'dj-landing'),
    ));
}
add_action('init', 'dj_landing_menus');

/**
 * Register widget areas
 */
function dj_landing_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'dj-landing'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in the footer.', 'dj-landing'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'dj_landing_widgets_init');

/**
 * Custom post type for DJ events (optional)
 */
function dj_landing_events_post_type() {
    $labels = array(
        'name'                  => _x('Events', 'Post type general name', 'dj-landing'),
        'singular_name'         => _x('Event', 'Post type singular name', 'dj-landing'),
        'menu_name'             => _x('DJ Events', 'Admin Menu text', 'dj-landing'),
        'add_new_item'          => __('Add New Event', 'dj-landing'),
        'edit_item'             => __('Edit Event', 'dj-landing'),
        'view_item'             => __('View Event', 'dj-landing'),
        'all_items'             => __('All Events', 'dj-landing'),
        'search_items'          => __('Search Events', 'dj-landing'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'events'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('dj_events', $args);
}
add_action('init', 'dj_landing_events_post_type');

/**
 * Add custom meta boxes for events
 */
function dj_landing_add_event_meta_boxes() {
    add_meta_box(
        'event-details',
        __('Event Details', 'dj-landing'),
        'dj_landing_event_details_callback',
        'dj_events',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'dj_landing_add_event_meta_boxes');

/**
 * Event details meta box callback
 */
function dj_landing_event_details_callback($post) {
    wp_nonce_field('dj_landing_save_event_details', 'dj_landing_event_nonce');
    
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    $event_type = get_post_meta($post->ID, '_event_type', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="event_date">' . __('Event Date', 'dj-landing') . '</label></th>';
    echo '<td><input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="event_time">' . __('Event Time', 'dj-landing') . '</label></th>';
    echo '<td><input type="time" id="event_time" name="event_time" value="' . esc_attr($event_time) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="event_location">' . __('Location', 'dj-landing') . '</label></th>';
    echo '<td><input type="text" id="event_location" name="event_location" value="' . esc_attr($event_location) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="event_type">' . __('Event Type', 'dj-landing') . '</label></th>';
    echo '<td>';
    echo '<select id="event_type" name="event_type">';
    echo '<option value="wedding"' . selected($event_type, 'wedding', false) . '>' . __('Wedding', 'dj-landing') . '</option>';
    echo '<option value="bar_bat_mitzvah"' . selected($event_type, 'bar_bat_mitzvah', false) . '>' . __('Bar/Bat Mitzvah', 'dj-landing') . '</option>';
    echo '<option value="birthday"' . selected($event_type, 'birthday', false) . '>' . __('Birthday', 'dj-landing') . '</option>';
    echo '<option value="corporate"' . selected($event_type, 'corporate', false) . '>' . __('Corporate Event', 'dj-landing') . '</option>';
    echo '<option value="other"' . selected($event_type, 'other', false) . '>' . __('Other', 'dj-landing') . '</option>';
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Save event details meta box data
 */
function dj_landing_save_event_details($post_id) {
    if (!isset($_POST['dj_landing_event_nonce']) || !wp_verify_nonce($_POST['dj_landing_event_nonce'], 'dj_landing_save_event_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }

    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }

    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }

    if (isset($_POST['event_type'])) {
        update_post_meta($post_id, '_event_type', sanitize_text_field($_POST['event_type']));
    }
}
add_action('save_post', 'dj_landing_save_event_details');

/**
 * Customize login page
 */
function dj_landing_custom_login() {
    echo '<style type="text/css">
        #login h1 a {
            background-image: url(' . get_template_directory_uri() . '/images/logo.png);
            background-size: contain;
            width: 100%;
            height: 80px;
        }
        .login form {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
        }
        .login input[type="text"], .login input[type="password"] {
            border-radius: 5px;
            border: 2px solid #ddd;
        }
        .login input[type="submit"] {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: 600;
        }
    </style>';
}
add_action('login_enqueue_scripts', 'dj_landing_custom_login');

/**
 * Add custom body classes
 */
function dj_landing_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'dj-landing-page';
    }
    
    if (is_rtl()) {
        $classes[] = 'rtl-layout';
    }
    
    return $classes;
}
add_filter('body_class', 'dj_landing_body_classes');

/**
 * Customize excerpt length
 */
function dj_landing_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'dj_landing_excerpt_length');

/**
 * Add structured data for DJ business
 */
function dj_landing_structured_data() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'DJ ארז גולד',
            'description' => 'DJ מקצועי לחתונות, אירועים וחגיגות עם ניסיון של 30 שנה',
            'telephone' => '+972-52-2648094',
            'url' => home_url(),
            'serviceType' => 'DJ Services',
            'areaServed' => 'Israel',
            'sameAs' => array(
                'https://www.facebook.com/share/19CKXU9HWC/',
                'https://www.instagram.com/djerezgold'
            )
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'dj_landing_structured_data');

/**
 * Remove WordPress admin bar from front-end for non-admins
 */
function dj_landing_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'dj_landing_remove_admin_bar');

/**
 * Add theme customizer options
 */
function dj_landing_customize_register($wp_customize) {
    // Contact section
    $wp_customize->add_section('dj_contact', array(
        'title'    => __('DJ Contact Info', 'dj-landing'),
        'priority' => 30,
    ));

    // Phone number
    $wp_customize->add_setting('dj_phone', array(
        'default'           => '+972-52-2648094',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dj_phone', array(
        'label'   => __('Phone Number', 'dj-landing'),
        'section' => 'dj_contact',
        'type'    => 'text',
    ));

    // WhatsApp number
    $wp_customize->add_setting('dj_whatsapp', array(
        'default'           => '972522648094',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dj_whatsapp', array(
        'label'   => __('WhatsApp Number', 'dj-landing'),
        'section' => 'dj_contact',
        'type'    => 'text',
    ));

    // Facebook URL
    $wp_customize->add_setting('dj_facebook', array(
        'default'           => 'https://www.facebook.com/share/19CKXU9HWC/',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('dj_facebook', array(
        'label'   => __('Facebook URL', 'dj-landing'),
        'section' => 'dj_contact',
        'type'    => 'url',
    ));

    // Instagram URL
    $wp_customize->add_setting('dj_instagram', array(
        'default'           => 'https://www.instagram.com/djerezgold',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('dj_instagram', array(
        'label'   => __('Instagram URL', 'dj-landing'),
        'section' => 'dj_contact',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'dj_landing_customize_register');

/**
 * Security enhancements
 */
// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove unnecessary meta tags
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * Performance optimizations
 */
// Remove emoji scripts and styles
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Disable embeds
function dj_landing_disable_embeds() {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
}
add_action('init', 'dj_landing_disable_embeds');

/**
 * Add Google Analytics support
 */
function dj_landing_google_analytics() {
    $ga_id = get_theme_mod('google_analytics_id');
    if ($ga_id && !is_admin() && !current_user_can('manage_options')) {
        ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo esc_attr($ga_id); ?>');
        </script>
        <?php
    }
}
add_action('wp_head', 'dj_landing_google_analytics');

/**
 * Add Google Analytics customizer option
 */
function dj_landing_analytics_customizer($wp_customize) {
    $wp_customize->add_section('dj_analytics', array(
        'title'    => __('Analytics', 'dj-landing'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('google_analytics_id', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('google_analytics_id', array(
        'label'   => __('Google Analytics ID', 'dj-landing'),
        'section' => 'dj_analytics',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'dj_landing_analytics_customizer');
?>