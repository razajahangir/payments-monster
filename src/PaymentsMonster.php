<?php

namespace PaymentsMonster;

class PaymentsMonster {
    
    private static $instance;
    
    private function __construct() {
        // Register custom post types and submenu page
        add_action( 'init', array( $this, 'register_custom_post_types' ) );
        add_action( 'admin_menu', array( $this, 'register_submenu_page' ) );
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PaymentsMonster();
        }
        return self::$instance;
    }

    public function register_custom_post_types() {
        // Register the first custom post type "Payments Pages"
        $labels = array(
            'name' => __( 'Payments Monsters' ),
            'singular_name' => __( 'Payments Page' ),
            'menu_name'             => __( 'Pay Monsters'),
            'all_items'             => __( 'Payment Pages' ),
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'payments-pages' ),
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-welcome-widgets-menus'
        );
        register_post_type( 'payments_page', $args );

        // Register the second custom post type "Transactions"
        $labels = array(
            'name' => __( 'Transactions' ),
            'singular_name' => __( 'Transaction' )
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'transactions' ),
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'show_in_menu' => 'edit.php?post_type=payments_page'
        );
        register_post_type( 'transaction', $args );

        add_action( 'admin_menu', function() {
            remove_submenu_page( 'edit.php?post_type=payments_page', 'post-new.php?post_type=payments_page' );
        } );
    }

    public function register_submenu_page() {
        // Add submenu page under "Payments Monster" menu
        add_submenu_page(
            'edit.php?post_type=payments_page',
            'Settings',
            'Settings',
            'manage_options',
            'paymentsmonster_settings',
            array( $this, 'render_settings_page' )
        );


        add_action( 'admin_menu', function() {
            // Remove the title field
            remove_post_type_support( 'payments_page', 'title' );
        
            // Remove the content box
            remove_post_type_support( 'payments_page', 'editor' );
        
            // Remove all other metaboxes
            remove_meta_box( 'postexcerpt', 'payments_page', 'normal' ); // Remove the "Excerpt" metabox
            remove_meta_box( 'commentsdiv', 'payments_page', 'normal' ); // Remove the "Comments" metabox
            remove_meta_box( 'authordiv', 'payments_page', 'normal' ); // Remove the "Author" metabox
            remove_meta_box( 'slugdiv', 'payments_page', 'normal' ); // Remove the "Slug" metabox
            remove_meta_box( 'trackbacksdiv', 'payments_page', 'normal' ); // Remove the "Trackbacks" metabox
            remove_meta_box( 'postcustom', 'payments_page', 'normal' ); // Remove the "Custom Fields" metabox
            remove_meta_box( 'revisionsdiv', 'payments_page', 'normal' ); // Remove the "Revisions" metabox
            remove_meta_box( 'commentstatusdiv', 'payments_page', 'normal' ); // Remove the "Discussion" metabox
            remove_meta_box( 'pageparentdiv', 'payments_page', 'normal' ); // Remove the "Page Attributes" metabox
            remove_meta_box( 'postimagediv', 'payments_page', 'normal' ); // Remove the "Featured Image" metabox
        } );
        

    }

    public function render_settings_page() {
        // Render your settings page here
    }
}

