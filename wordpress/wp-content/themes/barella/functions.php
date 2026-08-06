<?php
/**
 * Barella theme functions.
 *
 * Staging theme for barella.ru (wordpress-staging profile).
 * No secrets, no external services, no outbound mail.
 *
 * @package Barella
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup: menus, title tag, thumbnails.
 */
function barella_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	register_nav_menus(
		array(
			'primary' => 'Основное меню',
		)
	);
}
add_action( 'after_setup_theme', 'barella_setup' );

/**
 * Enqueue theme stylesheet.
 */
function barella_assets() {
	wp_enqueue_style( 'barella-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'barella_assets' );

/**
 * One-time (idempotent) bootstrap on theme activation:
 *  1. Permalinks -> /%postname%/ + flush rewrite rules.
 *  2. Idempotently create the three base pages and assign templates.
 *  3. blog_public is intentionally NOT touched (staging stays noindex).
 */
function barella_after_switch_theme() {
	update_option( 'permalink_structure', '/%postname%/' );

	$pages = array(
		'o-kompanii' => array(
			'title'    => 'О компании',
			'template' => 'template-o-kompanii.php',
		),
		'obekty'     => array(
			'title'    => 'Объекты',
			'template' => 'template-obekty.php',
		),
		'kontakty'   => array(
			'title'    => 'Контакты',
			'template' => 'template-kontakty.php',
		),
	);

	foreach ( $pages as $slug => $config ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$page_id = $page->ID;
		} else {
			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_name'    => $slug,
					'post_title'   => $config['title'],
					'post_content' => '',
				)
			);
		}
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', $config['template'] );
		}
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'barella_after_switch_theme' );

/**
 * Native feedback-form stub handler.
 * Staging: validates input and redirects back with a flag. Never sends mail
 * and never calls external services.
 */
function barella_handle_feedback() {
	$name  = isset( $_POST['barella_name'] ) ? sanitize_text_field( wp_unslash( $_POST['barella_name'] ) ) : '';
	$phone = isset( $_POST['barella_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['barella_phone'] ) ) : '';
	$text  = isset( $_POST['barella_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['barella_message'] ) ) : '';

	$back   = isset( $_POST['barella_back'] ) ? esc_url_raw( wp_unslash( $_POST['barella_back'] ) ) : home_url( '/' );
	$status = ( '' !== $name && '' !== $phone ) ? 'ok' : 'error';
	// Intentionally no wp_mail() and no external request: staging stub only.
	unset( $text );

	wp_safe_redirect( add_query_arg( 'barella_feedback', $status, $back ) . '#feedback-form' );
	exit;
}
add_action( 'admin_post_barella_feedback', 'barella_handle_feedback' );
add_action( 'admin_post_nopriv_barella_feedback', 'barella_handle_feedback' );

/**
 * Render the native feedback-form stub (shared by pages).
 */
function barella_feedback_form() {
	$status = isset( $_GET['barella_feedback'] ) ? sanitize_key( wp_unslash( $_GET['barella_feedback'] ) ) : '';
	?>
	<form class="feedback-form" id="feedback-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="barella_feedback" />
		<input type="hidden" name="barella_back" value="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>" />
		<?php if ( 'ok' === $status ) : ?>
			<p class="feedback-notice feedback-notice--ok">Заявка принята. Демо-режим staging: письма наружу не отправляются.</p>
		<?php elseif ( 'error' === $status ) : ?>
			<p class="feedback-notice feedback-notice--error">Заполните имя и телефон.</p>
		<?php endif; ?>
		<label>
			<span>Ваше имя</span>
			<input type="text" name="barella_name" required />
		</label>
		<label>
			<span>Телефон</span>
			<input type="tel" name="barella_phone" required />
		</label>
		<label>
			<span>Сообщение</span>
			<textarea name="barella_message" rows="4"></textarea>
		</label>
		<button type="submit" class="btn">Отправить заявку</button>
	</form>
	<?php
}
