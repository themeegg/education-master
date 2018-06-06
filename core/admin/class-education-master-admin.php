<?php
/**
 * Education Master Admin Class.
 *
 * @author  ThemeEgg
 * @package Education Master
 * @since   1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Education_Master_Admin')) :

    /**
     * Education_Master_Admin Class.
     */
    class Education_Master_Admin
    {

        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('wp_loaded', array(__CLASS__, 'hide_notices'));
            add_action('load-themes.php', array($this, 'admin_notice'));
        }

        /**
         * Add admin menu.
         */
        public function admin_menu()
        {
            $theme = wp_get_theme(get_template());

            $page = add_theme_page(esc_html__('About', 'education-master') . ' ' . $theme->display('Name'), esc_html__('About', 'education-master') . ' ' . $theme->display('Name'), 'activate_plugins', 'edm-welcome', array(
                $this,
                'welcome_screen'
            ));
            add_action('admin_print_styles-' . $page, array($this, 'enqueue_styles'));
        }

        /**
         * Enqueue styles.
         */
        public function enqueue_styles()
        {
            global $education_master_version;

            wp_enqueue_style('edm-welcome-admin', get_template_directory_uri() . '/core/admin/css/welcome-admin.css', array(), $education_master_version);
        }

        /**
         * Add admin notice.
         */
        public function admin_notice()
        {
            global $education_master_version, $pagenow;
            wp_enqueue_style('edm-message', get_template_directory_uri() . '/core/admin/css/admin-notices.css', array(), $education_master_version);

            // Let's bail on theme activation.
            if ('themes.php' == $pagenow && isset($_GET['activated'])) {
                add_action('admin_notices', array($this, 'welcome_notice'));
                update_option('education_master_admin_notice_welcome', 1);

                // No option? Let run the notice wizard again..
            } elseif (!get_option('education_master_admin_notice_welcome')) {
                add_action('admin_notices', array($this, 'welcome_notice'));
            }
        }

        /**
         * Hide a notice if the GET variable is set.
         */
        public static function hide_notices()
        {
            if (isset($_GET['edm-hide-notice']) && isset($_GET['_education_master_notice_nonce'])) {
                if (!wp_verify_nonce(wp_unslash($_GET['_education_master_notice_nonce']), 'education_master_hide_notices_nonce')) {
                    wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'education-master'));
                }

                if (!current_user_can('manage_options')) {
                    wp_die(esc_html__('Cheatin&#8217; huh?', 'education-master'));
                }

                $hide_notice = sanitize_text_field(wp_unslash($_GET['edm-hide-notice']));
                update_option('education_master_admin_notice_' . $hide_notice, 1);
            }
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice()
        {
            ?>
            <div id="message" class="updated education-master-message">
                <a class="education-master-message-close notice-dismiss"
                   href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('edm-hide-notice', 'welcome')), 'education_master_hide_notices_nonce', '_education_master_notice_nonce')); ?>"><?php esc_html_e('Dismiss', 'education-master'); ?></a>
                <p><?php
                    /* translators: 1: anchor tag start, 2: anchor tag end*/
                    printf(esc_html__('Welcome! Thank you for choosing education master! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%1$s.', 'education-master'), '<a href="' . esc_url(admin_url('themes.php?page=edm-welcome')) . '">', '</a>');
                    ?></p>
                <p class="submit">
                    <a class="button-secondary"
                       href="<?php echo esc_url(admin_url('themes.php?page=edm-welcome')); ?>"><?php esc_html_e('Get started with Education Master', 'education-master'); ?></a>
                </p>
            </div>
            <?php
        }

        /**
         * Intro text/links shown to all about pages.
         *
         * @access private
         */
        private function intro()
        {
            global $education_master_version;
            $theme = wp_get_theme(get_template());

            // Drop minor version if 0
            $major_version = substr($education_master_version, 0, 3);
            ?>
            <div class="educatino-master-theme-info">
                <h1>
                    <?php esc_html_e('About', 'education-master'); ?>
                    <?php echo esc_html($theme->display('Name')); ?>
                    <?php printf('%s', $major_version); ?>
                </h1>

                <div class="welcome-description-wrap">
                    <div class="about-text"><?php echo esc_html($theme->display('Description')); ?></div>

                    <div class="education-master-screenshot">
                        <img src="<?php echo esc_url(get_template_directory_uri()) . '/screenshot.png'; ?>"/>
                    </div>
                </div>
            </div>

            <p class="education-master-actions">
                <a href="<?php echo esc_url('http://themeegg.com/themes/education-master/'); ?>"
                   class="button button-secondary"
                   target="_blank"><?php esc_html_e('Theme Info', 'education-master'); ?></a>

                <a href="<?php echo esc_url(apply_filters('education_master_theme_url', 'http://demo.themeegg.com/themes/education-master/')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('View Demo', 'education-master'); ?></a>

                <a href="<?php echo esc_url(apply_filters('education_master_rate_url', 'https://wordpress.org/support/view/theme-reviews/education-master?filter=5#postform')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('Rate this theme', 'education-master'); ?></a>
                <a href="<?php echo esc_url(apply_filters('education_master_pro_theme_url', 'https://themeegg.com/downloads/education-master-pro-wordpress-theme/')); ?>"
                   class="button button-primary docs"
                   target="_blank"><?php esc_html_e('View Pro Version', 'education-master'); ?></a>
            </p>

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php if (empty($_GET['tab']) && $_GET['page'] == 'edm-welcome') {
                    echo 'nav-tab-active';
                } ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'edm-welcome'), 'themes.php'))); ?>">
                    <?php echo $theme->display('Name'); ?>
                </a>
                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'changelog') {
                    echo 'nav-tab-active';
                } ?>" href="<?php echo esc_url(admin_url(add_query_arg(array(
                    'page' => 'edm-welcome',
                    'tab' => 'changelog'
                ), 'themes.php'))); ?>">
                    <?php esc_html_e('Changelog', 'education-master'); ?>
                </a>

            </h2>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen()
        {
            $current_tab = empty($_GET['tab']) ? 'about' : sanitize_title(wp_unslash($_GET['tab']));

            // Look for a {$current_tab}_screen method.
            if (is_callable(array($this, $current_tab . '_screen'))) {
                return $this->{$current_tab . '_screen'}();
            }

            // Fallback to about screen.
            return $this->about_screen();
        }

        /**
         * Output the about screen.
         */
        public function about_screen()
        {
            $theme = wp_get_theme(get_template());
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <div class="changelog point-releases">
                    <div class="under-the-hood two-col">

                        <div class="col">
                            <h3><?php esc_html_e('Theme Customizer', 'education-master'); ?></h3>
                            <p><?php esc_html_e('All Theme Options are available via Customize screen.', 'education-master') ?></p>
                            <p><a href="<?php echo admin_url('customize.php'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Customize', 'education-master'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Documentation', 'education-master'); ?></h3>
                            <p><?php esc_html_e('Please view our documentation page to setup the theme.', 'education-master') ?></p>
                            <p><a href="<?php echo esc_url('http://docs.themeegg.com/docs/education-master/'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Documentation', 'education-master'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Got theme support question?', 'education-master'); ?></h3>
                            <p><?php esc_html_e('Please put it in our dedicated support forum.', 'education-master') ?></p>
                            <p><a href="<?php echo esc_url('https://themeegg.com/support-forum'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Support', 'education-master'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Any question about this theme or us?', 'education-master'); ?></h3>
                            <p><?php esc_html_e('Please send it via our sales contact page.', 'education-master') ?></p>
                            <p><a href="<?php echo esc_url('http://themeegg.com/contact/'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Contact Page', 'education-master'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3>
                                <?php
                                esc_html_e('Translate', 'education-master');
                                echo ' ' . $theme->display('Name');
                                ?>
                            </h3>
                            <p><?php esc_html_e('Click below to translate this theme into your own language.', 'education-master') ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://translate.wordpress.org/projects/wp-themes/education-master'); ?>"
                                   class="button button-secondary">
                                    <?php
                                    esc_html_e('Translate', 'education-master');
                                    echo ' ' . $theme->display('Name');
                                    ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="return-to-dashboard education-master">
                    <?php if (current_user_can('update_core') && isset($_GET['updated'])) : ?>
                        <a href="<?php echo esc_url(self_admin_url('update-core.php')); ?>">
                            <?php is_multisite() ? esc_html_e('Return to Updates', 'education-master') : esc_html_e('Return to Dashboard &rarr; Updates', 'education-master'); ?>
                        </a> |
                    <?php endif; ?>
                    <a href="<?php echo esc_url(self_admin_url()); ?>"><?php is_blog_admin() ? esc_html_e('Go to Dashboard &rarr; Home', 'education-master') : esc_html_e('Go to Dashboard', 'education-master'); ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Output the changelog screen.
         */
        public function changelog_screen()
        {
            global $wp_filesystem;

            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('View changelog below:', 'education-master'); ?></p>

                <?php
                $changelog_file = apply_filters('education_master_changelog_file', get_template_directory() . '/readme.txt');

                // Check if the changelog file exists and is readable.
                if ($changelog_file && is_readable($changelog_file)) {
                    WP_Filesystem();
                    $changelog = $wp_filesystem->get_contents($changelog_file);
                    $changelog_list = $this->parse_changelog($changelog);

                    echo wp_kses_post($changelog_list);
                }
                ?>
            </div>
            <?php
        }

        /**
         * Output the changelog screen.
         */
        public function freevspro_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('Upgrade to PRO version for more awesome features.', 'education-master'); ?></p>

                <table>
                    <thead>
                    <tr>
                        <th class="table-feature-title"><h3><?php esc_html_e('Features', 'education-master'); ?></h3>
                        </th>
                        <th><h3><?php esc_html_e('Education Master', 'education-master'); ?></h3></th>
                        <th><h3><?php esc_html_e('Education Master Pro', 'education-master'); ?></h3></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h3><?php esc_html_e('Support', 'education-master'); ?></h3></td>
                        <td><?php esc_html_e('Forum', 'education-master'); ?></td>
                        <td><?php esc_html_e('Forum + Emails/Support Ticket', 'education-master'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Category color options', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Additional color options', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('15', 'education-master'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Primary color option', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Font size options', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Google fonts options', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('500+', 'education-master'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Custom widgets', 'education-master'); ?></h3></td>
                        <td><?php esc_html_e('7', 'education-master'); ?></td>
                        <td><?php esc_html_e('16', 'education-master'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social icons', 'education-master'); ?></h3></td>
                        <td><?php esc_html_e('6', 'education-master'); ?></td>
                        <td><?php esc_html_e('6', 'education-master'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social sharing', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Site layout option', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Options in breaking news', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Change read more text', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Related posts', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Author biography', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Footer copyright editor', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('728x90 Advertisement', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Featured category slider', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Random posts widget', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Tabbed widget', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Videos', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('WooCommerce compatible', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Multiple header options', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Readmore flying card', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Weather widget', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Currency converter widget', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Category enable/disable option', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Reading indicator option', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Lightbox support', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Call to action widget', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Contact us template', 'education-master'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="btn-wrapper">
                            <a href="<?php echo esc_url(apply_filters('education_master_pro_theme_url', 'https://themeegg.com/downloads/education-master-pro-wordpress-theme/')); ?>"
                               class="button button-secondary docs"
                               target="_blank"><?php esc_html_e('View Pro', 'education-master'); ?></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         *
         * @param  string $content
         *
         * @return string
         */
        private function parse_changelog($content)
        {
            $matches = null;
            $regexp = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if (preg_match($regexp, $content, $matches)) {
                $changes = explode('\r\n', trim($matches[1]));

                $changelog .= '<pre class="changelog">';

                foreach ($changes as $index => $line) {
                    $changelog .= wp_kses_post(preg_replace('~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line));
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post($changelog);
        }


        /**
         * Output the supported plugins screen.
         */
        public function supported_plugins_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('This theme recommends following plugins:', 'education-master'); ?></p>
                <ol>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/social-icons/'); ?>"
                           target="_blank"><?php esc_html_e('Social Icons', 'education-master'); ?></a>
                        <?php esc_html_e(' by ThemeEgg', 'education-master'); ?>
                    </li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/easy-social-sharing/'); ?>"
                           target="_blank"><?php esc_html_e('Easy Social Sharing', 'education-master'); ?></a>
                        <?php esc_html_e(' by ThemeEgg', 'education-master'); ?>
                    </li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/contact-form-7/'); ?>"
                           target="_blank"><?php esc_html_e('Contact Form 7', 'education-master'); ?></a></li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/wp-pagenavi/'); ?>"
                           target="_blank"><?php esc_html_e('WP-PageNavi', 'education-master'); ?></a></li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/woocommerce/'); ?>"
                           target="_blank"><?php esc_html_e('WooCommerce', 'education-master'); ?></a></li>
                    <li>
                        <a href="<?php echo esc_url('https://wordpress.org/plugins/polylang/'); ?>"
                           target="_blank"><?php esc_html_e('Polylang', 'education-master'); ?></a>
                        <?php esc_html_e('Fully Compatible in Pro Version', 'education-master'); ?>
                    </li>
                    <li>
                        <a href="<?php echo esc_url('https://wpml.org/'); ?>"
                           target="_blank"><?php esc_html_e('WPML', 'education-master'); ?></a>
                        <?php esc_html_e('Fully Compatible in Pro Version', 'education-master'); ?>
                    </li>
                </ol>

            </div>
            <?php
        }

    }

endif;

return new Education_Master_Admin();
