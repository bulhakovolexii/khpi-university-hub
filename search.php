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
			<div id="sresult">

<script>
  (function() {
    var cx = '007565565918680382381:ile4ywk9zwk';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search queryParameterName="s" enableAutoComplete="true"></gcse:search>

			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
	/**
	 * Hook - university_hub_action_sidebar.
	 *
	 * @hooked: university_hub_add_sidebar - 10
	 */
	do_action( 'university_hub_action_sidebar' );
?>
<?php get_footer(); ?>
