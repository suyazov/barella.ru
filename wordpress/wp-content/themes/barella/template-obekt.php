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

$barella_photos_base = get_template_directory_uri() . '/assets/img/objects/' . $barella_object['id'] . '/';

get_header();
?>
<main>
	<section class="hero hero--object">
		<div class="container">
			<nav class="breadcrumbs" aria-label="Хлебные крошки">
				<a href="<?php echo esc_url( home_url( '/obekty/' ) ); ?>">Все объекты</a>
				<span aria-hidden="true">/</span>
				<span><?php echo esc_html( $barella_object['title'] ); ?></span>
			</nav>
			<h1><?php echo esc_html( $barella_object['title'] ); ?></h1>
			<p class="hero__meta">
				<span class="hero__meta-item"><?php echo esc_html( $barella_object['city'] ); ?></span>
				<span class="hero__meta-item"><?php echo esc_html( $barella_object['scope'] ); ?></span>
			</p>
		</div>
	</section>

	<section class="section object-overview">
		<div class="container">
			<dl class="object-info">
				<div class="object-info__item">
					<dt>Адрес</dt>
					<dd><?php echo esc_html( $barella_object['address'] ); ?></dd>
				</div>
				<div class="object-info__item">
					<dt>Заказчик</dt>
					<dd><?php echo esc_html( $barella_object['customer'] ); ?></dd>
				</div>
				<div class="object-info__item">
					<dt>Предмет работ</dt>
					<dd><?php echo esc_html( $barella_object['subject'] ); ?></dd>
				</div>
			</dl>

			<div class="object-works">
				<h2>Выполненные работы</h2>
				<ul class="object-works__list">
					<?php foreach ( $barella_object['works'] as $barella_work ) : ?>
						<li><?php echo esc_html( $barella_work ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<section class="section section--alt object-gallery-section">
		<div class="container">
			<h2>Фотографии объекта</h2>
			<div class="object-gallery">
				<?php foreach ( $barella_object['photos'] as $barella_photo ) : ?>
					<figure class="object-gallery__item">
						<img src="<?php echo esc_url( $barella_photos_base . $barella_photo['file'] ); ?>"
							width="<?php echo esc_attr( $barella_photo['width'] ); ?>"
							height="<?php echo esc_attr( $barella_photo['height'] ); ?>"
							alt="<?php echo esc_attr( $barella_photo['alt'] ); ?>" loading="lazy" />
					</figure>
				<?php endforeach; ?>
			</div>
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
