<?php
/**
 * EDM: Recent Posts
 *
 * Widget to display latest posts with thumbnail.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'widgets_init', 'education_master_register_recent_posts_widget' );

function education_master_register_recent_posts_widget() {
	register_widget( 'Education_Master_Recent_Posts' );
}

class Education_Master_Recent_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'education_master_recent_posts',
            'description' => __( 'A widget shows recent posts with thumbnail.', 'education-master' )
        );
        parent::__construct( 'education_master_recent_posts', __( 'Recent Posts', 'education-master' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'widget_title' => array(
                'education_master_widgets_name'         => 'widget_title',
                'education_master_widgets_title'        => __( 'Widget title', 'education-master' ),
                'education_master_widgets_field_type'   => 'text'
            ),

            'education_master_posts_count' => array(
                'education_master_widgets_name'         => 'education_master_posts_count',
                'education_master_widgets_title'        => __( 'No. of Posts', 'education-master' ),
                'education_master_widgets_default'      => '5',
                'education_master_widgets_field_type'   => 'number'
            )
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $education_master_widget_title  = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];
        $education_master_posts_count   = empty( $instance['education_master_posts_count'] ) ? '' : $instance['education_master_posts_count'];

        $education_master_posts_args = array(
                'posts_per_page' => $education_master_posts_count
            );
        $education_master_post_query = new WP_Query( $education_master_posts_args );

        echo $before_widget;
    ?>
            <div class="edm-recent-posts-wrapper">
                <?php
                    if( !empty( $education_master_widget_title ) ) {
                        echo $before_title . esc_html( $education_master_widget_title ) . $after_title;
                    }

                    if( $education_master_post_query->have_posts() ) {
                        echo '<ul>';
                        while( $education_master_post_query->have_posts() ) {
                            $education_master_post_query->the_post();
                ?>
                            <li>
                                <div class="edm-single-post edm-clearfix">
                                    <div class="edm-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'education-master-block-thumb' ); ?>
                                        </a>
                                    </div><!-- .edm-post-thumb -->
                                    <div class="edm-post-content">
                                        <h3 class="edm-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
                                    </div><!-- .edm-post-content -->
                                </div><!-- .edm-single-post -->
                            </li>
                <?php
                        }
                        echo '</ul>';
                    }
                    wp_reset_postdata();
                ?>
            </div><!-- .edm-recent-posts-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    education_master_widgets_updated_field_value()     defined in edm-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$education_master_widgets_name] = education_master_widgets_updated_field_value( $widget_field, $new_instance[$education_master_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    education_master_widgets_show_widget_field()       defined in edm-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $education_master_widgets_field_value = !empty( $instance[$education_master_widgets_name] ) ? wp_kses_post( $instance[$education_master_widgets_name] ) : '';
            education_master_widgets_show_widget_field( $this, $widget_field, $education_master_widgets_field_value );
        }
    }
}
