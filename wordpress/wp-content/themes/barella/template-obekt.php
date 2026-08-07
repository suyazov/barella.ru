<?php
/**
 * Template Name: Объект
 *
 * Single object page. The object is selected by the `barella_object_id`
 * post meta (or, as a fallback, by the page slug) and rendered from the
 * canonical data in inc/objects-data.php.
 *
 * @package Barella
 */

$barella_object_id = get_post_meta( get_the_ID(), 'barella_object_id', true );

$barella_object = null;
foreach ( barella_objects_data() as $barella_candidate ) {
	if ( $barella_candidate['id'] === $barella_object_id || $barella_candidate['slug'] === get_post_field( 'post_name', get_the_ID() ) ) {
		$barella_object = $barella_candidate;
		break;
	}
}

if ( ! $barella_object ) {
	wp_safe_redirect( home_url( '/obekty/' ) );
	exit;
}

$barella_cover       = $barella_object['photos'][0];
$barella_gallery     = array_slice( $barella_object['photos'], 1 );
$barella_photos_base = get_template_directory_uri() . '/assets/img/objects/' . $barella_object['id'] . '/';

get_header();
?>
<main>
	<section class="hero hero--object">
		<div class="container">
			<nav class="breadcrumbs" aria-label="Хлебные крошки">
				<a href="<?php echo esc_url( home_url( '/obekty/' ) ); ?>">Наши объекты</a>
				<span aria-hidden="true">/</span>
				<span><?php echo esc_html( $barella_object['title'] ); ?></span>
			</nav>
			<h1><?php echo esc_html( $barella_object['title'] ); ?></h1>
			<p><?php echo esc_html( $barella_object['city'] ); ?> · <?php echo esc_html( $barella_object['scope'] ); ?></p>
		</div>
	</section>

	<section class="section section--alt object-feature">
		<div class="container">
			<div class="object-feature__layout">
				<figure class="object-feature__cover">
					<img src="<?php echo esc_url( $barella_photos_base . $barella_cover['file'] ); ?>"
						width="<?php echo esc_attr( $barella_cover['width'] ); ?>"
						height="<?php echo esc_attr( $barella_cover['height'] ); ?>"
						alt="<?php echo esc_attr( $barella_cover['alt'] ); ?>" loading="lazy" />
				</figure>
				<div class="object-feature__facts">
					<ul class="object-feature__meta">
						<li><strong>Адрес</strong><?php echo esc_html( $barella_object['address'] ); ?></li>
						<li><strong>Заказчик</strong><?php echo esc_html( $barella_object['customer'] ); ?></li>
						<li><strong>Предмет работ</strong><?php echo esc_html( $barella_object['subject'] ); ?></li>
					</ul>
					<h2 class="object-feature__works-title">Выполненные работы</h2>
					<ul class="object-feature__works">
						<?php foreach ( $barella_object['works'] as $barella_work ) : ?>
							<li><?php echo esc_html( $barella_work ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php if ( $barella_gallery ) : ?>
				<div class="object-gallery">
					<?php foreach ( $barella_gallery as $barella_photo ) : ?>
						<figure class="object-gallery__item">
							<img src="<?php echo esc_url( $barella_photos_base . $barella_photo['file'] ); ?>"
								width="<?php echo esc_attr( $barella_photo['width'] ); ?>"
								height="<?php echo esc_attr( $barella_photo['height'] ); ?>"
								alt="<?php echo esc_attr( $barella_photo['alt'] ); ?>" loading="lazy" />
						</figure>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<p class="object-back"><a href="<?php echo esc_url( home_url( '/obekty/' ) ); ?>">← Все объекты</a></p>
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
