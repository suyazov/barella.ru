<?php
/**
 * Template Name: Объекты
 *
 * Catalog of exactly 10 object cards. Each card links to its own
 * object page (see template-obekt.php and docs/object-page-slugs-v2.md).
 *
 * @package Barella
 */

$barella_objects = barella_objects_data();

get_header();
?>
<main>
	<section class="hero">
		<div class="container">
			<h1>Наши объекты</h1>
			<p>Реализованные проекты Бареллы: производства, апарт-отели, жилые комплексы и энергообъекты.</p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="grid grid--3 objects-grid">
				<?php foreach ( $barella_objects as $barella_object ) : ?>
					<?php
					$barella_cover      = $barella_object['photos'][0];
					$barella_photos_base = get_template_directory_uri() . '/assets/img/objects/' . $barella_object['id'] . '/';
					?>
					<a class="object-card" href="<?php echo esc_url( home_url( '/obekty/' . $barella_object['slug'] . '/' ) ); ?>">
						<span class="object-card__cover">
							<img src="<?php echo esc_url( $barella_photos_base . $barella_cover['file'] ); ?>"
								width="<?php echo esc_attr( $barella_cover['width'] ); ?>"
								height="<?php echo esc_attr( $barella_cover['height'] ); ?>"
								alt="<?php echo esc_attr( $barella_cover['alt'] ); ?>" loading="lazy" />
						</span>
						<span class="object-card__body">
							<span class="object-card__title"><?php echo esc_html( $barella_object['title'] ); ?></span>
							<span class="object-card__meta"><?php echo esc_html( $barella_object['city'] ); ?> · <?php echo esc_html( $barella_object['scope'] ); ?></span>
							<span class="object-card__more">Подробнее об объекте</span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section cta">
		<div class="container">
			<h2>Давайте обсудим ваш проект</h2>
			<p>Покажем релевантные кейсы и предложим решение под ваш объект.</p>
			<a class="btn btn--light" href="<?php echo esc_url( home_url( '/kontakty/#feedback-form' ) ); ?>">Получить бесплатную консультацию</a>
		</div>
	</section>
</main>
<?php
get_footer();
