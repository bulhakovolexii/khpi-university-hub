<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package University_Hub
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while (have_posts()):
      the_post(); ?>

			<?php get_template_part('template-parts/content', 'single'); ?>
            
            <!-- share btns -->           
            <div class="university_hub_widget_social">
                <span><?php _e( 'Share to:', 'khpi-university-hub' );?> </span>
                <ul>
                <li><a href="https://www.facebook.com/share.php?u=<?php echo urlencode(
                    get_permalink()
                ); ?>"></a></li>
                <li><a href="https://x.com/intent/tweet?<?php echo 'text=' .
                    urlencode(get_the_title()) .
                    '&url=' .
                    urlencode(get_permalink()); ?>"></a></li>
                <li><a href="https://t.me/share/url?url=<?php echo urlencode(
                    get_permalink()
                ) .
                    '&text=' .
                    urlencode(get_the_title()); ?>"></a></li>
                <li><a href="https://www.linkedin.com/shareArticle?title=<?php echo urlencode(
                    get_the_title()
                ) .
                    '&url=' .
                    urlencode(get_permalink()); ?>&mini=true"></a></li>
                <li><a href="mailto:?subject=<?php echo get_the_title() .
                    '&body=' .
                    urlencode(get_permalink()); ?>"></a></li>
                </ul>
            </div>

			<?php // Previous/next post navigation.

      the_post_navigation([
       'next_text' =>
           '<span class="meta-nav" aria-hidden="true">' .
           __('Next', 'university-hub') .
           '</span> ' .
           '<span class="screen-reader-text">' .
           __('Next post:', 'university-hub') .
           '</span> ' .
           '<span class="post-title">%title</span>',
       'prev_text' =>
           '<span class="meta-nav" aria-hidden="true">' .
           __('Previous', 'university-hub') .
           '</span> ' .
           '<span class="screen-reader-text">' .
           __('Previous post:', 'university-hub') .
           '</span> ' .
           '<span class="post-title">%title</span>',
   ]); ?>

			<?php // If comments are open or we have at least one comment, load up the comment template.

      if (comments_open() || get_comments_number()):
       comments_template();
   endif; ?>

		<?php
  endwhile;
// End of the loop.
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action('university_hub_action_sidebar'); ?>
<?php get_footer(); ?>
