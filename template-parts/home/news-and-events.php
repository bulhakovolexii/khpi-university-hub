<?php
/**
 * Template part for displaying home news and events section.
 *
 * @package University_Hub
 */
?>
<?php
$news_and_events_ntitle = university_hub_get_option('news_and_events_ntitle');
$news_and_events_nnumber = university_hub_get_option('news_and_events_nnumber');
$news_and_events_ncategory = university_hub_get_option('news_and_events_ncategory');
$news_and_events_etitle = university_hub_get_option('news_and_events_etitle');
$news_and_events_enumber = university_hub_get_option('news_and_events_enumber');
$news_and_events_ecategory = university_hub_get_option('news_and_events_ecategory');
?>
<div id="university-hub-news-and-events" class="home-section-news-and-events">
	<div class="container">
		<div class="inner-wrapper">
			<div class="recent-news">
				<h2><?php echo esc_html($news_and_events_ntitle); ?></h2>
				<?php
    $qargs = ['posts_per_page' => absint($news_and_events_nnumber), 'no_found_rows' => true, 'ignore_sticky_posts' => true];
if (absint($news_and_events_ncategory) > 0) {
    $qargs['cat'] = absint($news_and_events_ncategory);
} // Fetch posts.
$the_query = new WP_Query($qargs);
?>

				<?php if ($the_query->have_posts()): ?>
					<div class="inner-wrapper">

						<?php while ($the_query->have_posts()):
						    $the_query->the_post(); ?>

							<div class="news-post">
								<?php
        $image_size = university_hub_get_option('news_and_events_image_size');
						    // Получаем выбранный размер.
						    if (has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($image_size, [
    'class' => 'aligncenter',
]); ?></a>
<?php endif;
						    ?>


								<div class="news-content">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="block-meta">
										<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time(_x('F d, Y', 'date format', 'university-hub')); ?></a></span>
										<?php if (!post_password_required() && (comments_open() || get_comments_number())): ?>
											<span class="comments-link">
												<?php comments_popup_link(esc_html__('0 comments', 'university-hub'), esc_html__('1 Comment', 'university-hub'), esc_html__('% Comments', 'university-hub')); ?>
											</span>
										<?php endif; ?>
									</div><!-- .block-meta -->
									<?php
						     $excerpt = university_hub_the_excerpt(20);
						    echo wp_kses_post(wpautop($excerpt));
						    ?>
								</div><!-- .news-content -->

							</div><!-- .news-post -->
						<?php
						endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div><!-- .inner-wrapper -->

				<?php endif; ?>
			</div><!-- .recent-news -->
			<div class="recent-events">
				<h2><?php echo esc_html($news_and_events_etitle); ?></h2>
				<?php
    $qargs = ['posts_per_page' => absint($news_and_events_enumber), 'no_found_rows' => true, 'ignore_sticky_posts' => true];
if (absint($news_and_events_ecategory) > 0) {
    $qargs['cat'] = absint($news_and_events_ecategory);
} // Fetch posts.
$the_query = new WP_Query($qargs);
?>

				<?php if ($the_query->have_posts()): ?>

						<?php while ($the_query->have_posts()):
						    $the_query->the_post(); ?>

							<div class="event-post">
								<div class="custom-entry-date">
									<?php // Getting a setting from the Customizer


         $news_display_style = get_theme_mod('home_news_display_style', 'calendar');
						    if ($news_display_style === 'calendar'): ?>
    <span class="entry-month"><?php the_time(_x('M', 'date format', 'university-hub')); ?></span>
									<span class="entry-day"><?php the_time(_x('d', 'date format', 'university-hub')); ?></span>
<?php else: ?>
    <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail', ['class' => 'alignleft']); ?>
        </a>
    <?php endif; ?>
<?php endif;
						    ?>

								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php
        $excerpt = university_hub_the_excerpt(10);
						    echo wp_kses_post(wpautop($excerpt));
						    ?>
							</div> <!-- .event-post -->

						<?php
						endwhile; ?>
						<?php wp_reset_postdata(); ?>


				<?php endif; ?>

                <!-- more-events-link -->
				<?php
$blog_page_url = esc_url(get_permalink(get_option('page_for_posts')));
$events_link = !empty($news_and_events_ecategory)
    ? esc_url(get_category_link($news_and_events_ecategory))
    : $blog_page_url;
$events_title = !empty($news_and_events_etitle)
    ? esc_html__("All", "khpi-university-hub") . ' ' . esc_html(mb_strtolower($news_and_events_etitle))
    : esc_html_e('Events', 'university-hub');
?>

<p id="more-events">
    <a href="<?php echo $events_link; ?>">
        <?php echo $events_title; ?> &nbsp;<i class="fa-solid fa-arrow-right"></i>
    </a>
</p>


			</div><!-- .recent-news -->

			</div> <!-- .inner-wrapper -->

		</div> <!-- .container -->
	</div><!-- .home-section-news-and-events -->
