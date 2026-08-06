<?php
/**
 * Template Name: О компании
 *
 * @package Barella
 */

get_header();
?>
<main>
	<section class="hero">
		<div class="container">
			<h1>О компании</h1>
			<p>Барелла — это команда профильных инженеров, проектировщиков и монтажников, которая проектирует, комплектует и вводит в эксплуатацию инженерные системы зданий: вентиляцию, кондиционирование и отопление.</p>
			<a class="btn btn--light" href="#feedback-form">Получить бесплатную консультацию</a>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2>Барелла в цифрах</h2>
			<div class="grid grid--4">
				<div class="card figure"><div class="figure__value">15+</div><div class="figure__label">лет инженерной практики</div></div>
				<div class="card figure"><div class="figure__value">300+</div><div class="figure__label">реализованных объектов</div></div>
				<div class="card figure"><div class="figure__value">40+</div><div class="figure__label">инженеров и проектировщиков в штате</div></div>
				<div class="card figure"><div class="figure__value">24/7</div><div class="figure__label">сервисная поддержка объектов</div></div>
			</div>
		</div>
	</section>

	<section class="section section--alt">
		<div class="container">
			<h2>Три направления работы</h2>
			<div class="grid grid--3">
				<div class="card card--direction">
					<h3>Вентиляция</h3>
					<p>Проектирование и монтаж приточно-вытяжных систем, дымоудаление, аспирация производств, вентиляция чистых помещений.</p>
				</div>
				<div class="card card--direction">
					<h3>Кондиционирование</h3>
					<p>Мультизональные VRF-системы, чиллер-фанкойлы, прецизионное кондиционирование, системы для серверных и промышленных площадок.</p>
				</div>
				<div class="card card--direction">
					<h3>Отопление</h3>
					<p>Индивидуальные тепловые пункты, котельные, водяное и лучистое отопление для жилых, общественных и промышленных объектов.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2>Реализованные проекты</h2>
			<p class="lead">Среди наших объектов — фармацевтические и промышленные производства, бизнес-центры, жилые комплексы и энергоцентры.</p>
			<div class="grid grid--3">
				<div class="card"><h3>Светлана</h3><p>Инженерные системы производственной площадки.</p></div>
				<div class="card"><h3>Ретиноиды</h3><p>Вентиляция и климат фармацевтического производства.</p></div>
				<div class="card"><h3>Кабельное производство, Псков</h3><p>Промышленная вентиляция цехов.</p></div>
				<div class="card"><h3>ПОЛИСАН</h3><p>Климатические системы научно-производственного комплекса.</p></div>
				<div class="card"><h3>VERTICAL</h3><p>Вентиляция и кондиционирование бизнес-центра.</p></div>
				<div class="card"><h3>Кальянный бар на Невском</h3><p>Вытяжная вентиляция с повышенным воздухообменом.</p></div>
				<div class="card"><h3>ЖК на Октябрьской набережной</h3><p>Инженерия жилого комплекса.</p></div>
				<div class="card"><h3>Энергоцентр Рублево-Архангельское</h3><p>Вентиляция энергоцентра посёлка.</p></div>
			</div>
			<p style="margin-top:24px;"><a class="btn" href="<?php echo esc_url( home_url( '/obekty/' ) ); ?>">Все объекты</a></p>
		</div>
	</section>

	<section class="section section--alt">
		<div class="container">
			<h2>С какими объектами мы работаем</h2>
			<div class="grid grid--3">
				<div class="card"><h3>Производства</h3><p>Фармацевтика, пищевая промышленность, кабельные и металлообрабатывающие цеха.</p></div>
				<div class="card"><h3>Коммерческая недвижимость</h3><p>Бизнес-центры, торговые площади, рестораны и бары.</p></div>
				<div class="card"><h3>Жилые комплексы</h3><p>Многоквартирные дома, апартаменты, загородные посёлки.</p></div>
				<div class="card"><h3>Энергетика</h3><p>Энергоцентры, котельные, тепловые пункты.</p></div>
				<div class="card"><h3>Медицина и лаборатории</h3><p>Чистые помещения, прецизионный климат, стерильные зоны.</p></div>
				<div class="card"><h3>IT-инфраструктура</h3><p>Серверные и дата-центры с резервированием охлаждения.</p></div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2>Руководство</h2>
			<div class="grid grid--4">
				<div class="card team-member">
					<div class="photo-placeholder">Фото руководителя<br />добавляется оператором</div>
					<h3>Генеральный директор</h3>
					<p>Стратегия и развитие компании</p>
				</div>
				<div class="card team-member">
					<div class="photo-placeholder">Фото руководителя<br />добавляется оператором</div>
					<h3>Технический директор</h3>
					<p>Инженерные решения и качество</p>
				</div>
				<div class="card team-member">
					<div class="photo-placeholder">Фото руководителя<br />добавляется оператором</div>
					<h3>Руководитель проектного отдела</h3>
					<p>Проектирование и согласования</p>
				</div>
				<div class="card team-member">
					<div class="photo-placeholder">Фото руководителя<br />добавляется оператором</div>
					<h3>Начальник монтажного участка</h3>
					<p>Монтаж и пусконаладка</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section section--alt">
		<div class="container">
			<h2>Наши принципы работы</h2>
			<ol class="principles">
				<li><strong>Инженерный подход.</strong> Каждое решение подтверждено расчётом, а не шаблоном.</li>
				<li><strong>Прозрачная смета.</strong> Фиксируем стоимость и состав работ до начала монтажа.</li>
				<li><strong>Собственные монтажные бригады.</strong> Не передаём критичные работы субподрядчикам.</li>
				<li><strong>Соблюдение сроков.</strong> Поэтапный график с контрольными точками для заказчика.</li>
				<li><strong>Гарантия и сервис.</strong> Обслуживаем смонтированные системы после сдачи объекта.</li>
				<li><strong>Документация без сюрпризов.</strong> Передаём полный комплект исполнительной документации.</li>
			</ol>
		</div>
	</section>

	<section class="section cta">
		<div class="container">
			<h2>Давайте обсудим ваш проект</h2>
			<p>Расскажите о задаче — инженер Бареллы предложит решение и рассчитает ориентировочную смету.</p>
			<a class="btn btn--light" href="#feedback-form">Получить бесплатную консультацию</a>
		</div>
	</section>

	<section class="section" id="feedback">
		<div class="container">
			<h2>Форма обратной связи</h2>
			<?php barella_feedback_form(); ?>
		</div>
	</section>
</main>
<?php
get_footer();
