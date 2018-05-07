<?php
/**
 * EDM: Featured Posts
 *
 * Widget show the featured posts from selected categories in different layouts.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'widgets_init', 'education_master_register_featured_widget' );

function education_master_register_featured_widget() {
    register_widget( 'Education_Master_Featured_Posts' );
}

class Education_Master_Featured_Posts extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'education_master_featured_posts',
            'description' => __( 'Displays featured posts from selected categories in different layouts.', 'education-master' )
        );
        parent::__construct( 'education_master_featured_posts', __( 'Featured Posts', 'education-master' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $education_master_categories_lists = education_master_categories_lists();

        $fields = array(

            'block_title' => array(
                'education_master_widgets_name'         => 'block_title',
                'education_master_widgets_title'        => __( 'Block title', 'education-master' ),
                'education_master_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'education-master' ),
                'education_master_widgets_field_type'   => 'text'
            ),

            'block_cat_ids' => array(
                'education_master_widgets_name'         => 'block_cat_ids',
                'education_master_widgets_title'        => __( 'Block Categories', 'education-master' ),
                'education_master_widgets_field_type'   => 'multicheckboxes',
                'education_master_widgets_field_options' => $education_master_categories_lists
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

        $education_master_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $education_master_block_cat_ids  = empty( $instance['block_cat_ids'] ) ? '' : $instance['block_cat_ids'];

        echo $before_widget;
    ?>
        <div class="edm-block-wrapper featured-posts edm-clearfix">
            <?php
                if( !empty( $education_master_block_title ) ) {
                    echo $before_title . esc_html( $education_master_block_title ) . $after_title;
                }
            ?>
            <div class="edm-featured-posts-wrapper">
                <?php
                    if( !empty( $education_master_block_cat_ids ) ) {
                        $checked_cats = array();
                        foreach( $education_master_block_cat_ids as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_cats_ids = implode( ",", $checked_cats );
                        $education_master_post_count = apply_filters( 'education_master_featured_posts_count', 4 );
                        $education_master_posts_args = array(
                                'post_type' => 'post',
                                'cat' => $get_cats_ids,
                                'posts_per_page' => absint( $education_master_post_count )
                            );
                        $education_master_posts_query = new WP_Query( $education_master_posts_args );
                        if( $education_master_posts_query->have_posts() ) {
                            while( $education_master_posts_query->have_posts() ) {
                                $education_master_posts_query->the_post();
                ?>
                            <div class="edm-single-post-wrap edm-clearfix">
                                <div class="edm-single-post">
                                    <div class="edm-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                                if( has_post_thumbnail() ) {
                                                    the_post_thumbnail( 'education-master-block-thumb' );
                                                }
                                            ?>
                                        </a>
                                    </div><!-- .edm-post-thumb -->
                                    <div class="edm-post-content">
                                        <h3 class="edm-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
                                    </div><!-- .edm-post-content -->
                                </div> <!-- edm-single-post -->
                            </div><!-- .edm-single-post-wrap -->
                <?php
                            }
                        }
                    }
                ?>
            </div><!-- .edm-featured-posts-wrapper -->
        </div><!--- .edm-block-wrapper -->
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
