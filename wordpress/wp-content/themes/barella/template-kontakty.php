<?php
/**
 * Template Name: Контакты
 *
 * @package Barella
 */

get_header();
?>
<main>
	<section class="hero">
		<div class="container">
			<h1>Контакты</h1>
			<p>Свяжитесь с нами удобным способом или оставьте заявку через форму обратной связи.</p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="grid grid--2">
				<div>
					<h2>Как нас найти</h2>
					<ul class="contacts-list">
						<li>
							<strong>Адрес</strong>
							г. Санкт-Петербург, пр-кт. Полюстровский, дом 59, лит.А
						</li>
						<li>
							<strong>Телефон</strong>
							<a href="tel:+79214164646">+7 (921) 416-46-46</a>
						</li>
						<li>
							<strong>Email</strong>
							<a href="mailto:info@barella.ru">info@barella.ru</a>
						</li>
					</ul>
					<div class="photo-placeholder map-placeholder">Карта проезда добавляется отдельной задачей оператора</div>
				</div>
				<div>
					<h2>Форма обратной связи</h2>
					<?php barella_feedback_form(); ?>
				</div>
			</div>
		</div>
	</section>

	<section class="section cta">
		<div class="container">
			<h2>Давайте обсудим ваш проект</h2>
			<p>Оставьте заявку — инженер Бареллы свяжется с вами и ответит на вопросы.</p>
			<a class="btn btn--light" href="#feedback-form">Получить бесплатную консультацию</a>
		</div>
	</section>
</main>
<?php
get_footer();
