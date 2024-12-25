<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package University_Hub
 */

/**
 * Hook - university_hub_action_after_content.
 *
 * @hooked university_hub_content_end - 10
 */
do_action('university_hub_action_after_content'); ?>

	 /**
 * Hook - university_hub_action_before_footer.
 *
 * @hooked university_hub_add_footer_bottom_widget_area - 5
 * @hooked university_hub_footer_start - 10
 */<?php

do_action('university_hub_action_before_footer'); ?>
     /**
 * Hook - university_hub_action_footer.
 *
 * @hooked university_hub_footer_copyright - 10
 */<?php

do_action('university_hub_action_footer'); ?>
	 /**
 * Hook - university_hub_action_after_footer.
 *
 * @hooked university_hub_footer_end - 10
 */<?php

do_action('university_hub_action_after_footer'); ?>

 /**
 * Hook - university_hub_action_after.
 *
 * @hooked university_hub_page_end - 10
 * @hooked university_hub_footer_goto_top - 20
 */<?php

do_action('university_hub_action_after'); ?>

<?php wp_footer(); ?>
</body>
</html>
