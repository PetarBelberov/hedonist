<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Plugin Name: Hedonist Services Widget
Description: To use the Hedonist Services Widget, after activation in the plugins page you should go to the widget section. There is a new "Service" widget area and new available widget - "Service widget". You could drag and drop the widget in the widget area for best result. You could change the title of the widget area from the menu "Settings" / "Services plugin". Pleasant usage.
Version: 1.0
Author: Dev Group
Author URI: https://devgroup.net/
*/

include_once('hedonist-services-options.php');
add_action('widgets_init', 'hedonist_register_widget_service');

function hedonist_register_widget_service() {
    register_widget( 'jpen_Service_widget');
}

// Register widget area compatible with the Service widget
function service_widget() {
    register_sidebar(array(
        'name' => 'Service #2',
        'id' => 'service-widget',
        'before_widget' => '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services-container animatable bounceInLeft">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="service-widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'service_widget');

class jpen_Service_widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'services_widget',
            'description' => 'Service widget',
        );
        //creates a new widget with the id of 'example-widget', the name 'Example Widget', and two widget options: a class name and a short description.
        parent::__construct( 'services_widget', 'Service widget', $widget_options );
    }


    function widget( $args, $instance ) {
        // Include css and js stylesheets inside the widget
        wp_enqueue_style( 'style-service', get_template_directory_uri() . '/widgets/hedonist-services/style-services.css' );
        
        if( !empty( $instance['title-services'] ) && !empty( $instance['image-services'])) {
        echo $args['before_widget'];

        // Returns the crc32 checksum of services title as unique positive integer
        $id = hedonist_autocorrect_url($instance['url-services']);

        // Rest of the widget content
        ?>
        <a data-toggle="modal" href="#<?php echo esc_html($id) ?>">
            <div class="service">
                <img src="<?php echo esc_url($instance['image-services']) ?>" alt="image-services">
                <h3><?php echo esc_html($instance['title-services']) ?></h3>
                <p><?php echo esc_html($instance['description-services']) ?></p>
                <?php
                $regex_services = '/\{(.*)\}\s*|(.+ )+([0-9]+\s?[\p{L}]{2,3})/mu';
                preg_match_all($regex_services, $instance['modal_services'], $matches_services, PREG_SET_ORDER);
                ?>
            </div>
        </a>
        <?php
        echo $args['after_widget'];
       
        ?>
            <!-- Modal -->
            <!-- Modal: modalQuickView -->
            <?php if(!empty( $matches_services) && !empty( $instance['modal_image_1'])) { ?>
            <?php  ?>
            <div class="modal fade" id="<?php echo esc_attr($id) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" id="modal-services-<?php echo esc_attr($id); ?>" role="document">
                    <div class="modal-content">
                        <div class="modal-body-big">
                            <!--Header-->
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel-<?php echo esc_attr($id) ?>"><?php echo esc_html($instance['title-services']) ?></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <!--Carousel Wrapper-->
                                    <?php  ?>
                                    <div id="carousel-thumb-<?php echo esc_attr($id) ?>" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                        <div class="carousel-inner" role="listbox">
                                            <?php
                                                if( !empty( $instance['modal_image_1'] )) {
                                            ?>
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100"
                                                         src="<?php echo esc_url($instance['modal_image_1']) ?>"
                                                         alt="First slide">
                                                </div>
                                            <?php
                                                }
                                            ?>

                                            <?php
                                            if( !empty( $instance['modal_image_2'] )) {
                                                ?>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                         src="<?php echo esc_url($instance['modal_image_2']) ?>"
                                                         alt="Second slide">
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if( !empty( $instance['modal_image_3'] )) {
                                                ?>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                         src="<?php echo ($instance['modal_image_3']) ?>"
                                                         alt="Third slide">
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!--/.Slides-->
                                        <!--Controls-->
                                         <?php
                                            if( !empty( $instance['modal_image_1'] && !empty( $instance['modal_image_2'] ) ||
                                                !empty( $instance['modal_image_1'] && !empty( $instance['modal_image_3'] ) ||
                                                !empty( $instance['modal_image_2'] && !empty( $instance['modal_image_3'] ))))) {
                                        ?>

                                        <a class="carousel-control-prev" href="#carousel-thumb-<?php echo esc_attr($id) ?>" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-thumb-<?php echo esc_attr($id) ?>" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                                <?php
                                            }
                                         ?>
                                        <!--/.Controls-->
                                        <ol class="carousel-indicators">
                                            <?php
                                            if( !empty( $instance['modal_image_1'] )) {
                                                ?>
                                                <li data-target="#carousel-thumb-<?php echo esc_attr($id) ?>" data-slide-to="0" class="active"></li>
                                                <?php
                                            }

                                            if( !empty( $instance['modal_image_2'] )) {
                                                ?>
                                                <li data-target="#carousel-thumb-<?php echo esc_attr($id) ?>" data-slide-to="1"></li>
                                                <?php
                                            }

                                            if( !empty( $instance['modal_image_3'] )) {
                                                ?>
                                                <li data-target="#carousel-thumb-<?php echo esc_attr($id) ?>" data-slide-to="2"></li>
                                                <?php
                                            }
                                            ?>
                                        </ol>
                                    </div>
                                    <!--/.Carousel Wrapper-->
                                </div>
                                <div class="col-lg-7">
                                    <!--Body-->
                                    <div class="modal-body">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Услуги</th>
                                                <th>Цена&emsp;</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($matches_services as $match) { ?>
                                                <tr>
                                                    <!-- error handling -->
                                                    <?php if(count($match) == 2) : ?>
                                                        <td class="modal-services-subheaders"><?php echo "<u>" . esc_attr($match[1]) . "</u>", PHP_EOL; ?></td>
                                                    <?php else : ?>
                                                        <td class="modal-services-subheaders"><?php echo "<u>" . esc_attr($match[1]) . "</u>", ' ', esc_attr($match[2]), PHP_EOL; ?></td>
                                                        <td><?php echo $match[3]; ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    }
    // Processes widget options to be saved
    public function update( $new_instance, $old_instance ) {

        return $new_instance;

    }

    public function form( $instance )
    {

        // Extract the data from the instance variable
        $title = '';
        if( !empty( $instance['title-services'] ) ) {
            $title = $instance['title-services'];
        }

        $url = '';
        if( !empty( $instance['url-services'] ) ) {
            $url = hedonist_autocorrect_url($instance['url-services']);
        }

        $description = '';
        if( !empty( $instance['description-services'] ) ) {
            $description = $instance['description-services'];
        }

        $image = '';
        if(isset($instance['image-services'])) {
            $image = $instance['image-services'];
        }
        else {
            $image = null;
        }
        

        // Modal

        $modal_image_1 = '';
        if(isset($instance['modal_image_1'])) {
            $modal_image_1 = $instance['modal_image_1'];
        }

        $modal_image_2 = '';
        if(isset($instance['modal_image_2'])) {
            $modal_image_2 = $instance['modal_image_2'];
        }

        $modal_image_3 = '';
        if(isset($instance['modal_image_3'])) {
            $modal_image_3 = $instance['modal_image_3'];
        }

        $modal_services = '';
        if(isset($instance['modal_services'])) {
            $modal_services = $instance['modal_services'];
        }

        ?>
        <!-- Displaying the fields in the administrator form -->

        <!-- Title field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title-services' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title-services' ); ?>" name="<?php echo $this->get_field_name( 'title-services' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
        if(!isset($title) || trim($title) == '') {
            echo "You did not fill out title field. Required!";
        }
        ?>

         <!-- URL field -->
         <p>
            <label for="<?php echo $this->get_field_name( 'url-services' ); ?>"><?php _e( 'URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url-services' ); ?>" name="<?php echo $this->get_field_name( 'url-services' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
        </p>
        <?php
        if(!isset($url) || trim($url) == '') {
            echo "You did not fill out url field. Required!";
        }
        ?>

        <!-- Description field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'description-services' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description-services' ); ?>" name="<?php echo $this->get_field_name( 'description-services' ); ?>" type="text" ><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <?php
        if(!isset($description) || trim($description) == '') {
            echo "You did not fill out description field.";
        }
        ?>

        <!-- Image field -->
        <p>
            <label for="<?php echo $this->get_field_name( 'image-services' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image-services' ); ?>" id="<?php echo $this->get_field_id( 'image-services' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
        <?php
        if(!isset($image) || trim($image) == '') {
            echo "You did not upload image field. Required";
        }
        ?>
        <!-- Modal -->
        <h3><?php _e( 'Modal' ); ?></h3>
        <!-- Image field 1 -->
        <p>
            <label for="<?php echo $this->get_field_name( 'modal_image_1' ); ?>"><?php _e( 'Modal image 1:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'modal_image_1' ); ?>" id="<?php echo $this->get_field_id( 'modal_image_1' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $modal_image_1 ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>

        <!-- Image field 2 -->
        <p>
            <label for="<?php echo $this->get_field_name( 'modal_image_2' ); ?>"><?php _e( 'Modal image 2:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'modal_image_2' ); ?>" id="<?php echo $this->get_field_id( 'modal_image_2' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $modal_image_2 ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>

        <!-- Image field 3 -->
        <p>
            <label for="<?php echo $this->get_field_name( 'modal_image_3' ); ?>"><?php _e( 'Modal image 3:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'modal_image_3' ); ?>" id="<?php echo $this->get_field_id( 'modal_image_3' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $modal_image_3 ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>

        <!-- Services Text area -->
        <span class="modal-services-textarea">
            <label for="<?php echo $this->get_field_name( 'modal_services' ); ?>"><?php _e( 'List all services. Each service must be in a new line' ); ?></label>
            <textarea class="widefat" placeholder="Example:
            {Header}
            Service 50 лв
            Service 100 EU
            Service - 200 USD" name="<?php echo $this->get_field_name( 'modal_services' ); ?>" id="<?php echo $this->get_field_id( 'modal_services' ); ?>" type="text" value="<?php echo esc_attr( $modal_services ); ?>" rows="4" cols="40"><?php echo esc_attr( $modal_services ); ?></textarea>
        </span>
        <?php
    }
}


