<?php
/**
 * Fallback template.
 *
 * @package Barella
 */

get_header();
?>
<main class="section">
	<div class="container entry-content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<h1>Страница не найдена</h1>
			<p>Используйте меню для перехода к разделам сайта.</p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
