<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Hedonist Our Team Widget
Description: To use the Hedonist Our Team Widget, after activation in the plugins page you should go to the widget section. There is a new "Our Team" widget area and new available widget - "Our Team widget". You could drag and drop the widget in the widget area for best result. You could change the title of the widget area from the menu "Settings" / "Our Team plugin". Pleasant usage.
Version: 1.0
Author: Dev Group
Author URI: https://devgroup.net/
*/

include_once('hedonist-our-team-options.php');
add_action('widgets_init', 'hedonist_register_widget_our_team');

function hedonist_register_widget_our_team() {
    register_widget( 'jpen_Our_team_widget');
}

// Register widget area compatible with the Service widget
function our_team_widget() {
    register_sidebar(array(
        'name' => 'Our Team #3',
        'id' => 'our-team-widget',
        'before_widget' => '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 our-team-container">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="our-team-widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'our_team_widget');

class jpen_Our_team_widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'our_team_widget',
            'description' => 'Our_Team widget',
        );
        //creates a new widget with the id of 'our-team-widget', the name 'Our Team widget', and two widget options: a class name and a short description.
        parent::__construct( 'our_team_widget', 'Our Team widget', $widget_options );

        add_action( 'admin_enqueue_scripts', array( $this, 'mfc_assets' ) );
    }

    public function mfc_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script( 'hedonist-media-upload', get_template_directory_uri() . '/custom-style/hedonist-media-upload.js', array('jquery'), 1.1, true );
        wp_enqueue_style('thickbox');
    }

    function widget( $args, $instance ) {
        // Include css and js stylesheets inside the widget
        wp_enqueue_style( 'style-our-team', get_template_directory_uri() . '/widgets/hedonist-our-team/style-our-team.css' );

        if( !empty( $instance['name-team-member'] ) && !empty( $instance['image-team-member']) && !empty( $instance['phone-team-member']) && !empty( $instance['job-team-member'])) {
            echo $args['before_widget'];

            // Rest of the widget content
            ?>
            <div class="profile">
                <div class="img-box">
                    <img src="<?php echo $instance['image-team-member'] ?>" class="img-responsive">
                    <ul class="text-center">
                        <li><i class="fa fa-mobile"></i></li>
                        <p class="team-member-phone"><?php echo $instance['phone-team-member'] ?></p>
                    </ul>
                </div>
                <h1><?php echo $instance['name-team-member'] ?></h1>
                <h2><?php echo $instance['job-team-member'] ?></h2>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }

    // Processes widget options to be saved
    public function update( $new_instance, $old_instance ) {

        return $new_instance;
    }

    public function form( $instance )
    {

        // Extract the data from the instance variable
        $name = '';
        if( !empty( $instance['name-team-member'] ) ) {
            $name = $instance['name-team-member'];
        }

        $job = '';
        if( !empty( $instance['job-team-member'] ) ) {
            $job = $instance['job-team-member'];
        }

        $phone = '';
        if( !empty( $instance['phone-team-member'] ) ) {
            $phone = $instance['phone-team-member'];
        }

        $image = '';
        if(isset($instance['image-team-member'])) {
            $image = $instance['image-team-member'];
        }
        else {
            $image = null;
        }

        ?>

        <!-- Displaying the fields in the administrator form -->

        <!-- Name field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'name-team-member' ); ?>"><?php _e( 'Name:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name-team-member' ); ?>" name="<?php echo $this->get_field_name( 'name-team-member' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
        </p>
        <?php
        if(!isset($name) || trim($name) == '') {
            echo "You did not fill out name field. Required!";
        }
        ?>

        <!-- Job field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'job-team-member' ); ?>"><?php _e( 'Job:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'job-team-member' ); ?>" name="<?php echo $this->get_field_name( 'job-team-member' ); ?>" type="text" ><?php echo esc_attr( $job ); ?></textarea>
        </p>
        <?php
        if(!isset($job) || trim($job) == '') {
            echo "You did not fill out job field. Required!";
        }
        ?>

        <!-- Phone field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'phone-team-member' ); ?>"><?php _e( 'Phone:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'phone-team-member' ); ?>" name="<?php echo $this->get_field_name( 'phone-team-member' ); ?>" type="text" ><?php echo esc_attr( $phone ); ?></textarea>
        </p>
        <?php
        if(!isset($phone) || trim($phone) == '') {
            echo "You did not fill out phone field. Required!";
        }
        ?>
        <!-- Image field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'image-team-member' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image-team-member' ); ?>" id="<?php echo $this->get_field_id( 'image-team-member' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
        <?php
        if(!isset($image) || trim($image) == '') {
            echo "You did not upload image field. Required!";
        }
        ?>
        <?php
    }
}


