<?php
/**
 * Reusable case card template part.
 * Expects $barella_case array: title, place, scope, text.
 *
 * @package Barella
 */

$barella_case = isset( $barella_case ) ? $barella_case : array();
?>
<article class="case">
	<div class="photo-placeholder">Фото объекта<br />добавляется отдельной задачей оператора</div>
	<div class="case__body">
		<h3 class="case__title"><?php echo esc_html( $barella_case['title'] ); ?></h3>
		<p class="case__meta"><?php echo esc_html( $barella_case['place'] ); ?> · <?php echo esc_html( $barella_case['scope'] ); ?></p>
		<p class="case__text"><?php echo esc_html( $barella_case['text'] ); ?></p>
	</div>
</article>
