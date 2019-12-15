<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/** Step 2 (from text above). Register the above function using the admin_menu action hook */
add_action( 'admin_menu', 'services_plugin_menu' );

/** Step 1. Function that contains the menu-building code */
function services_plugin_menu() {
    $submenu_text = '<span class="submenu-text-edit">Services Plugin &nbsp;</span>';
    $submenu_dashicon = '<span class="dashicons dashicons-edit submenu"></span>';
    //➤
    // Adds a new item to the Settings administration menu via the add_options_page() function
    add_options_page(
            'Services Plugin Options',              // page_title
            $submenu_text . $submenu_dashicon,      // menu_title
            'manage_options',                       // capability
            'services-unique-identifier',           // menu_slug
            'services_plugin_options'               // function
    );
}

// Include css and js stylesheets inside the widget
wp_enqueue_style( 'style-services',  get_template_directory_uri() . '/widgets/hedonist-services/style-services.css' );

/** Step 3. HTML output for the page */
function services_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    // variables for the field and option names
    $opt_name = 'services_widget_title';
    $hidden_field_name = 'services_submit_hidden';
    $data_field_name = 'services_widget_title';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
    // Read their posted value
    $opt_val = $_POST[ $data_field_name ];

    // Save the posted value in the database
    update_option( $opt_name, $opt_val );

    // Put a "settings saved" message on the screen

    ?>
    <div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
    <?php

}

// Now display the settings editing screen

echo '<div class="wrap">';

// header
echo "";
echo "<h2><span class=\"dashicons dashicons-edit settings\"></span>&emsp;" . __( 'Services Plugin Title', 'menu-test' ) . "</h2>";

// settings form

?>
    <div id="services-description-settings">
        <p>In this field you can change the title of the Services Area</p>
    </div>
    <form name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

        <p><?php _e("Services Title:", 'menu-test' ); ?>
            <input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
        </p><hr />

        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>

    </form>
    </div>
<?php
}
