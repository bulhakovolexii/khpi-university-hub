<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package University_Hub
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
  $google_cse_id = get_theme_mod('google_cse_id', '');

  if (!empty($google_cse_id)): ?>

			<script async src="https://cse.google.com/cse.js?cx=<?php echo $google_cse_id; ?>"></script>
			<div class="gcse-search" data-queryParameterName="s"></div>

        <?php else: ?>

		<?php if (have_posts()): ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'university-hub'), '<span>' . get_search_query() . '</span>'); ?></h1>
			</header><!-- .page-header -->

			<?php while (have_posts()):
       the_post(); ?>

				<?php get_template_part('template-parts/content', 'search'); ?>

			<?php
   endwhile; ?>

			<?php do_action('university_hub_action_posts_navigation'); ?>

		<?php else: ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>
		
		<?php endif;
  ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php do_action('university_hub_action_sidebar'); ?>
<?php get_footer(); ?>
