<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Hedonist Slide Widget
Description: Slide
Version: 1.0
Author: Dev Group
Author URI: https://devgroup.net/
*/

add_action('widgets_init', 'hedonist_register_widgets');

function hedonist_register_widgets() {
    register_widget( 'jpen_Slide_widget');
}

// Register widget area compatible with the Service widget
function slide_widget() {
    register_sidebar(array(
        'name' => 'Slide #1',
        'id' => 'slide-widget',
        'before_widget' => '<div class="slide">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="slide-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'slide_widget');

class jpen_Slide_widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'slide_widget',
            'description' => 'Slide widget',
        );
        //creates a new widget with the id of 'example-widget', the name 'Example Widget', and two widget options: a class name and a short description.
        parent::__construct( 'slide_widget', 'Slide widget', $widget_options );

        add_action( 'admin_enqueue_scripts', array( $this, 'mfc_assets' ) );
    }

    public function mfc_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('hedonist-media-upload', plugin_dir_url(__FILE__) . 'hedonist-media-upload.js', array( 'jquery' )) ;
        wp_enqueue_style('thickbox');
    }


    function widget( $args, $instance ) {
        // Include css and js stylesheets inside the widget
        wp_enqueue_style( 'style-slide', get_template_directory_uri() . '/widgets/hedonist-slide/style-slide.css' );

        $args['before_widget'];
        // Rest of the widget content
        ?>
        <div class='slider-container animatable bounceIn'>
            <div id="snow_container"><!-- Temporary Snow Container -->
                <?php for ($i=0; $i < 200; $i++) : ?>
                    <div class="snow"></div>
                <?php endfor; ?>
        
            <div class='slider-content'>
            <?php if( !empty( $instance['title'] ) ) : ?>
                <div class='slider-title'>
                    <h1 class="title-heading"><?php echo esc_html($instance['title']) ?></h1>
                </div>
            <?php elseif (isset( $instance['slider_logo'] ) ) :  ?>
                <div class='slider-logo'>
                    <img src="<?php echo esc_url($instance['slider_logo']) ?>" alt="slider-logo">
                </div>
            <?php endif; ?>
                <div class='slider-separator'></div>
                <div class='slider-text'>
                    <p><?php echo esc_html($instance['description']) ?></p>
                </div>
                
                <div class='slider-button'>
                    <a href="<?php echo esc_url($instance['button_link']) ?>" class="slider-button-link">
                        <span class="slider-button-text"><?php echo esc_html($instance['button_name']) ?></span>
                    </a>
                </div>
            </div>
            </div><!-- #snow_container -->
        </div>
<style>
    .slider-container {
        background: linear-gradient( rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.05) ),url("<?php echo $instance['image'] ?>") center;
        background-size: cover;
    }
    <?php
        if ($instance['content-align'] == "Centered") {
            include 'content-align-center.css';
        }
        elseif ($instance['content-align'] == "Right") {
            include 'content-align-right.css';

        }
?>
</style>
        <?php
        echo $args['after_widget'];
    }

    // Processes widget options to be saved
    public function update( $new_instance, $old_instance ) {

        return $new_instance;
    }

    public function form( $instance )
    {

        // Extract the data from the instance variable
        $title = '';
        if( !empty( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        $slider_logo = '';
        if(isset($instance['slider_logo'])) {
            $slider_logo = $instance['slider_logo'];
        }

        $description = '';
        if( !empty( $instance['description'] ) ) {
            $description = $instance['description'];
        }

        $button_name = '';
        if( !empty( $instance['button_name'] ) ) {
            $button_name = $instance['button_name'];
        }

        $button_link = '';
        if( !empty( $instance['button_link'] ) ) {
            $button_link = $instance['button_link'];
        }

        $image = '';
        if(isset($instance['image'])) {
            $image = $instance['image'];
        }

        $align = $instance['content-align'];
        ?>

        <!-- Displaying the fields in the administrator form -->

        <!-- Title field & Image field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'slider_logo' ); ?>"><?php _e( 'Logo:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'slider_logo' ); ?>" id="<?php echo $this->get_field_id( 'slider_logo' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $slider_logo ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Logo" />
        </p>
        <?php
        if((!isset($title) || trim($title) == '') && ((!isset($slider_logo) || trim($slider_logo) == '' ))) {
            echo "You did not fill out either title field or logo image.";
        }
        ?>

        <!-- Description field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" ><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <?php
        if(!isset($description) || trim($description) == '') {
            echo "You did not fill out description field.";
        }
        ?>

        <!-- Button name field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'button_name' ); ?>"><?php _e( 'Button Name:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_name' ); ?>" name="<?php echo $this->get_field_name( 'button_name' ); ?>" type="text" value="<?php echo esc_attr( $button_name ); ?>" />
        </p>
        <?php
        if(!isset($button_name) || trim($button_name) == '') {
            echo "You did not fill out title field.";
        }
        ?>

        <!-- Button link field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'button_link' ); ?>"><?php _e( 'Button Link. For content areas from "#1" to "#5"' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>" />
        </p>
        <?php
        if(!isset($button_link) || trim($button_link) == '') {
            echo "You did not fill out title field.";
        }
        ?>

        <!-- Image field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
        <?php
        if(!isset($image) || trim($image) == '') {
            echo "You did not upload image. </br>";
        }
        ?>

        <!-- Dropdown align field -->
        <label for="<?php echo $this->get_field_id('content-align'); ?>">Content Align:
            <select class='widefat' id="<?php echo $this->get_field_id('content-align'); ?>"
                    name="<?php echo $this->get_field_name('content-align'); ?>" type="text">
                <option value='Left'<?php echo esc_attr(($align=='Left')) ? 'selected' : ''; ?>>
                    Left
                </option>
                <option value='Centered'<?php echo esc_attr(($align=='Centered')) ? 'selected' : ''; ?>>
                    Centered
                </option>
                <option value='Right'<?php echo esc_attr(($align=='Right')) ? 'selected' : ''; ?>>
                    Right
                </option>
            </select>
        </label>
        <?php
    }
}