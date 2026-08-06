<?php
/**
 * Template Name: Объекты
 *
 * @package Barella
 */

$barella_object_photos = array(
	array(
		'file'   => '01.jpg',
		'width'  => 1280,
		'height' => 960,
		'alt'    => 'Смонтированные воздуховоды приточной вентиляции в производственном помещении завода «Светлана»',
	),
	array(
		'file'   => '02.jpg',
		'width'  => 1280,
		'height' => 960,
		'alt'    => 'Разводка прямоугольных воздуховодов системы вентиляции, объект ООО «Оптосенс»',
	),
	array(
		'file'   => '03.jpg',
		'width'  => 1280,
		'height' => 720,
		'alt'    => 'Воздухораспределители приточной вентиляции над производственной зоной',
	),
	array(
		'file'   => '04.jpg',
		'width'  => 960,
		'height' => 1280,
		'alt'    => 'Приточно-вытяжная установка Domekt с подключёнными воздуховодами',
	),
	array(
		'file'   => '05.jpg',
		'width'  => 960,
		'height' => 1280,
		'alt'    => 'Монтаж наружного воздуховода на фасаде здания на пр. Энгельса, д. 27',
	),
	array(
		'file'   => '06.jpg',
		'width'  => 960,
		'height' => 1280,
		'alt'    => 'Подключение воздуховодов к вентиляционной установке во время монтажных работ',
	),
);

$barella_object = array(
	'title'    => 'Производственные помещения на территории завода «Светлана»',
	'address'  => 'г. Санкт-Петербург, пр. Энгельса, д. 27, литера АД',
	'customer' => 'ООО «Оптосенс»',
	'subject'  => 'Поставка и монтаж оборудования систем вентиляции, кондиционирования и увлажнения производственных и административных помещений.',
	'works'    => array(
		'Монтаж вентиляционного оборудования Ruck',
		'Монтаж приточно-вытяжной установки Domekt',
		'Монтаж увлажнителя Carel',
		'Монтаж кассетных сплит-систем Lessar',
		'Монтаж элементов управления',
		'Пусконаладочные работы',
	),
	'cover'    => $barella_object_photos[3],
	'gallery'  => $barella_object_photos,
);

$barella_cases = array(
	array(
		'title' => 'Ретиноиды',
		'place' => 'Санкт-Петербург',
		'scope' => 'Фармацевтическое производство',
		'text'  => 'Вентиляция и кондиционирование чистых помещений фармацевтического производства с поддержанием классов чистоты и перепадов давления.',
	),
	array(
		'title' => 'Кабельное производство',
		'place' => 'Псков',
		'scope' => 'Промышленная вентиляция',
		'text'  => 'Системы аспирации и общеобменной вентиляции цехов кабельного производства: удаление технологических выделений, подогрев приточного воздуха.',
	),
	array(
		'title' => 'ПОЛИСАН',
		'place' => 'Санкт-Петербург',
		'scope' => 'Климат научно-производственного комплекса',
		'text'  => 'Комплексное климатическое обеспечение научно-производственного комплекса: вентиляция, кондиционирование лабораторных и офисных зон.',
	),
	array(
		'title' => 'VERTICAL',
		'place' => 'Санкт-Петербург',
		'scope' => 'Бизнес-центр',
		'text'  => 'Вентиляция и мультизональное кондиционирование бизнес-центра VERTICAL: поквартирное регулирование, автоматика и диспетчеризация.',
	),
	array(
		'title' => 'Кальянный бар на Невском',
		'place' => 'Санкт-Петербург, Невский проспект',
		'scope' => 'Вытяжная вентиляция HoReCa',
		'text'  => 'Вытяжная вентиляция с повышенным воздухообменом для кальянного бара в историческом здании: бесшумные канальные вентиляторы, компенсация вытяжки.',
	),
	array(
		'title' => 'ЖК на Октябрьской набережной',
		'place' => 'Санкт-Петербург',
		'scope' => 'Инженерия жилого комплекса',
		'text'  => 'Приточно-вытяжная вентиляция и системы отопления жилого комплекса на Октябрьской набережной: квартиры, паркинг, коммерческие помещения.',
	),
	array(
		'title' => 'Энергоцентр Рублево-Архангельское',
		'place' => 'Московская область',
		'scope' => 'Вентиляция энергоцентра',
		'text'  => 'Вентиляция энергоцентра посёлка Рублево-Архангельское: машинные залы, газовые узлы, аварийная вентиляция с резервированием.',
	),
);

get_header();
?>
<main>
	<section class="hero">
		<div class="container">
			<h1>Объекты</h1>
			<p>Реализованные проекты Бареллы: производства, бизнес-центры, жилые комплексы и энергообъекты. Первый согласованный объект — с фотоотчётом, остальные публикуются по решению клиента.</p>
		</div>
	</section>

	<?php $barella_photos_base = get_template_directory_uri() . '/assets/img/objects/01-svetlana/'; ?>
	<section class="section section--alt object-feature">
		<div class="container">
			<h2><?php echo esc_html( $barella_object['title'] ); ?></h2>
			<div class="object-feature__layout">
				<figure class="object-feature__cover">
					<img src="<?php echo esc_url( $barella_photos_base . $barella_object['cover']['file'] ); ?>"
						width="<?php echo esc_attr( $barella_object['cover']['width'] ); ?>"
						height="<?php echo esc_attr( $barella_object['cover']['height'] ); ?>"
						alt="<?php echo esc_attr( $barella_object['cover']['alt'] ); ?>" loading="lazy" />
				</figure>
				<div class="object-feature__facts">
					<ul class="object-feature__meta">
						<li><strong>Адрес</strong><?php echo esc_html( $barella_object['address'] ); ?></li>
						<li><strong>Заказчик</strong><?php echo esc_html( $barella_object['customer'] ); ?></li>
						<li><strong>Предмет работ</strong><?php echo esc_html( $barella_object['subject'] ); ?></li>
					</ul>
					<h3>Выполненные работы</h3>
					<ul class="object-feature__works">
						<?php foreach ( $barella_object['works'] as $barella_work ) : ?>
							<li><?php echo esc_html( $barella_work ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="object-gallery">
				<?php foreach ( $barella_object['gallery'] as $barella_photo ) : ?>
					<figure class="object-gallery__item">
						<img src="<?php echo esc_url( $barella_photos_base . $barella_photo['file'] ); ?>"
							width="<?php echo esc_attr( $barella_photo['width'] ); ?>"
							height="<?php echo esc_attr( $barella_photo['height'] ); ?>"
							alt="<?php echo esc_attr( $barella_photo['alt'] ); ?>" loading="lazy" />
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="grid grid--3">
				<?php foreach ( $barella_cases as $barella_case ) : ?>
					<?php require get_template_directory() . '/template-parts/case-card.php'; ?>
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
