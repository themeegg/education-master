<?php
/**
 * EDM: Default Tabbed
 *
 * Widget to display latest posts and comment in tabbed layout.
 *
 * @package ThemeEgg
 * @subpackage Education Master
 * @since 1.0.0
 */

add_action( 'widgets_init', 'education_master_register_default_tabbed_widget' );

function education_master_register_default_tabbed_widget() {
	register_widget( 'Education_Master_Default_Tabbed' );
}

class Education_Master_Default_Tabbed extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'education_master_default_tabbed',
            'description' => __( 'A widget shows recent posts and comment in tabbed layout.', 'education-master' )
        );
        parent::__construct( 'education_master_default_tabbed', __( 'Default Tabbed', 'education-master' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'latest_tab_title' => array(
                'education_master_widgets_name'         => 'latest_tab_title',
                'education_master_widgets_title'        => __( 'Latest Tab title', 'education-master' ),
                'education_master_widgets_default'      => __( 'Latest', 'education-master' ),
                'education_master_widgets_field_type'   => 'text'
            ),

            'comments_tab_title' => array(
                'education_master_widgets_name'         => 'comments_tab_title',
                'education_master_widgets_title'        => __( 'Comments Tab title', 'education-master' ),
                'education_master_widgets_default'      => __( 'Comments', 'education-master' ),
                'education_master_widgets_field_type'   => 'text'
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

        $education_master_latest_title   = empty( $instance['latest_tab_title'] ) ? __( 'Latest', 'education-master' ) : $instance['latest_tab_title'];
        $education_master_comments_title  = empty( $instance['comments_tab_title'] ) ? __( 'Comments', 'education-master' ) : $instance['comments_tab_title'];

        echo $before_widget;
    ?>
            <div class="edm-default-tabbed-wrapper edm-clearfix" id="edm-tabbed-widget">

                <ul class="widget-tabs edm-clearfix" id="edm-widget-tab">
                    <li><a href="#latest"><?php echo esc_html( $education_master_latest_title ); ?></a></li>
                    <li><a href="#comments"><?php echo esc_html( $education_master_comments_title ); ?></a></li>
                </ul><!-- .widget-tabs -->

                <div id="latest" class="edm-tabbed-section edm-clearfix">
                    <?php
                        $education_master_post_count = apply_filters( 'education_master_latest_tabbed_posts_count', 5 );
                        $latest_args = array(
                                'posts_per_page' => $education_master_post_count
                            );
                        $latest_query = new WP_Query( $latest_args );
                        if( $latest_query->have_posts() ) {
                            while( $latest_query->have_posts() ) {
                                $latest_query->the_post();
                    ?>
                                <div class="edm-single-post edm-clearfix">
                                    <div class="edm-post-thumb">
                                        <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail( 'education-master-block-thumb' ); ?> </a>
                                    </div><!-- .edm-post-thumb -->
                                    <div class="edm-post-content">
                                        <h3 class="edm-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="edm-post-meta"><?php education_master_posted_on(); ?></div>
                                    </div><!-- .edm-post-content -->
                                </div><!-- .edm-single-post -->
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </div><!-- #latest -->

                <div id="comments" class="edm-tabbed-section edm-clearfix">
                    <ul>
                        <?php
                            $education_master_comments_count = apply_filters( 'education_master_comment_tabbed_posts_count', 5 );
                            $education_master_tabbed_comments = get_comments( array( 'number' => $education_master_comments_count ) );
                            foreach( $education_master_tabbed_comments as $comment  ) {
                        ?>
                                <li class="edm-single-comment edm-clearfix">
                                    <?php
                                        $title = get_the_title( $comment->comment_post_ID );
                                        echo '<div class="edm-comment-avatar">'. get_avatar( $comment, '55' ) .'</div>';
                                    ?>
                                    <div class="edm-comment-desc-wrap">
                                        <strong><?php echo strip_tags( $comment->comment_author ); ?></strong>
                                        <?php esc_html_e( '&nbsp;commented on', 'education-master' ); ?>
                                        <a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>" rel="external nofollow" title="<?php echo esc_attr( $title ); ?>"> <?php echo esc_html( $title ); ?></a>: <?php echo wp_html_excerpt( $comment->comment_content, 50 ); ?>
                                    </div><!-- .edm-comment-desc-wrap -->
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div><!-- #comments -->

            </div><!-- .edm-default-tabbed-wrapper -->
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
