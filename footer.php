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

do_action('university_hub_action_after_content'); ?>

	<?php do_action('university_hub_action_before_footer'); ?>
    <?php do_action('university_hub_action_footer'); ?>
	<?php do_action('university_hub_action_after_footer'); ?>

<?php do_action('university_hub_action_after'); ?>

<?php wp_footer(); ?>
</body>
</html>
