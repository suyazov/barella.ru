<?php
/**
 * Site header.
 *
 * @package Barella
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">Барелла<span>.</span></a>
		<nav class="main-nav">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/o-kompanii/' ) ); ?>">О компании</a></li>
				<li><a href="<?php echo esc_url( home_url( '/obekty/' ) ); ?>">Объекты</a></li>
				<li><a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>">Контакты</a></li>
			</ul>
		</nav>
		<a class="site-header__phone" href="tel:+79214164646">+7 (921) 416-46-46</a>
	</div>
</header>
