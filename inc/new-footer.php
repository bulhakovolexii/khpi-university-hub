<?php

if (!function_exists('university_hub_footer_copyright')):
    /**
     * Footer copyright
     *
     * @since 1.0.0
     */
    function university_hub_footer_copyright()
    {
        // Check if footer is disabled.
        $footer_status = apply_filters('university_hub_filter_footer_status', true);
        if (true !== $footer_status) {
            return;
        }

        // Footer Menu.
        $footer_menu_content = wp_nav_menu([
            'theme_location' => 'footer',
            'container' => 'div',
            'container_id' => 'footer-navigation',
            'depth' => 1,
            'fallback_cb' => false,
            'echo' => false,
        ]);

        // Copyright content.
        $copyright_text = university_hub_get_option('copyright_text');
        $copyright_text = apply_filters('university_hub_filter_copyright_text', $copyright_text);
        if (!empty($copyright_text)) {
            $copyright_text = wp_kses_data($copyright_text);
        }

        // Powered by content.
        // $powered_by_text = sprintf(__('University Hub by %s', 'university-hub'), '<a target="_blank" rel="designer" href="https://wenthemes.com/">' . __('WEN1 Themes', 'university-hub') . '</a>');

        // Social in footer.
        $show_social_in_footer = university_hub_get_option('show_social_in_footer');
        ?>

		<div class="colophon-inner">

		    <?php if (true === $show_social_in_footer && has_nav_menu('social')): ?>
			    <div class="colophon-column">
			    	<div class="footer-social">
			    		<?php the_widget('University_Hub_Social_Widget'); ?>
			    	</div><!-- .footer-social -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>


		    <?php if (!empty($footer_menu_content)): ?>
		    	<div class="colophon-column">
					<?php echo $footer_menu_content; ?>
		    	</div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if (!empty($copyright_text)): ?>
			    <div class="colophon-column">
			    	<div class="copyright">
			    		<?php echo str_replace('%year%', date('Y'), $copyright_text); ?>
			    	</div><!-- .copyright -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

             <?php if (!empty($powered_by_text)): ?>
			    <div class="colophon-column">
			    	<div class="site-info">
			    		<?php echo $powered_by_text; ?>
			    	</div><!-- .site-info -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		</div><!-- .colophon-inner -->

	    <?php
    }
endif;
