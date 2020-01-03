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
        'before_widget' => '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 our-team-container animatable bounceInRight">',
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
        // Include css and js stylesheets inside the widget
        wp_enqueue_style( 'style-our-team', get_template_directory_uri() . '/widgets/hedonist-our-team/style-our-team.css' );
    }

    function widget( $args, $instance ) {

        if( !empty( $instance['name-team-member'] ) && !empty( $instance['image-team-member']) && !empty( $instance['phone-team-member']) && !empty( $instance['job-team-member'])) {
            echo $args['before_widget'];

            $id = $instance['name-team-member'];
            $id_arr = explode(' ',trim($id));
            $id = strtolower($id_arr[0]);

            // Rest of the widget content
            ?>
            
            <div class="profile">
                <a data-toggle="modal" href="#<?php echo $id ?>">
                    <div class="team-member-img">
                        <div class="img-box team-member">
                            <div class="team-member-overlay"></div>
                            <img src="<?php echo $instance['image-team-member'] ?>" class="img-responsive" alt="image-team-member">
                        </div>
                    </div>
                </a>
                <h1><?php echo $instance['name-team-member'] ?></h1>
                <h2><?php echo $instance['job-team-member'] ?></h2>
                <p><?php echo $instance['phone-team-member'] ?></p>
                <ul class="call-us-button">
                    <li>
                        <a href="tel:<?php echo $instance['phone-team-member'] ?>"><i class="fa fa-phone icon"></i></a>
                    </li>
                </ul>
            </div>
            
            <?php
            echo $args['after_widget'];
            ?>
            <!-- Modal -->
            <!-- Modal: modalQuickView -->
            <?php if(!empty( $instance['modal-description'])) : ?>
            <div class="modal fade team-member-description" id="<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg modal-our-team" role="document">
                    <div class="modal-content">
                        <div class="modal-body-big">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--Header-->
                                    <div class="modal-header team-member-description-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">X</span>
                                        </button>
                                    </div>
                                    <!--Carousel Wrapper-->
                                    <div class="carousel slide carousel-fade carousel-thumbnails team-member-description-body" data-ride="carousel">
                                        <div class="img-box team-member">
                                            <div class="team-member-overlay"></div>
                                            <img src="<?php echo $instance['image-team-member'] ?>" class="img-responsive" alt="image-team-member"> 
                                        </div>
                                        <div class="carousel-inner team-member-description-content" role="listbox">
                                           <p><?php echo $instance['modal-description'] ?></p>
                                        </div> 
                                                                                 
                                    </div>
                                    <!--/.Carousel Wrapper-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;
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

        $modal_description = '';
        if(isset($instance['modal-description'])) {
            $modal_description = $instance['modal-description'];
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
        
        <!-- Modal description -->
        <p>
            <label for="<?php echo $this->get_field_name( 'modal-description' ); ?>"><?php _e( 'Team Member Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'modal-description' ); ?>" name="<?php echo $this->get_field_name( 'modal-description' ); ?>" type="text" ><?php echo esc_attr( $modal_description ); ?></textarea>
        </p>
        <?php
    }
}


