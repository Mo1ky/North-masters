<?php

add_filter('show_admin_bar', '__return_false');

remove_action('wp_head',             'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles',     'print_emoji_styles' );
remove_action('admin_print_styles',  'print_emoji_styles' );

remove_action('wp_head', 'wp_resource_hints', 2 ); //remove dns-prefetch
remove_action('wp_head', 'wp_generator'); //remove meta name="generator"
remove_action('wp_head', 'wlwmanifest_link'); //remove wlwmanifest
remove_action('wp_head', 'rsd_link'); // remove EditURI
remove_action('wp_head', 'rest_output_link_wp_head');// remove 'https://api.w.org/
remove_action('wp_head', 'rel_canonical'); //remove canonical
remove_action('wp_head', 'wp_shortlink_wp_head', 10); //remove shortlink
remove_action('wp_head', 'wp_oembed_add_discovery_links'); //remove alternate

//удаление лишних пунктов меню в админке
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
	//remove_menu_page('options-general.php'); // Удаляем раздел Настройки	
  	remove_menu_page('tools.php'); // Инструменты
	remove_menu_page('users.php'); // Пользователи
	remove_menu_page('plugins.php'); // Плагины
	remove_menu_page('themes.php'); // Внешний вид	
	remove_menu_page('edit.php'); // Посты блога
	//remove_menu_page('upload.php'); // Медиабиблиотека
	//remove_menu_page('edit.php?post_type=page'); // Страницы
	remove_menu_page('edit-comments.php'); // Комментарии	
}

add_action('wp_enqueue_scripts', 'site_scripts');
function site_scripts() {
  $version = '0.0.0.0';
  wp_dequeue_style( 'wp-block-library' );
  wp_deregister_script( 'wp-embed' );

  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:900%7CRoboto:300&display=swap&subset=cyrillic', [], $version);
  wp_enqueue_style('main-style', get_stylesheet_uri(), [], $version);

  wp_enqueue_script('focus-visible', 'https://unpkg.com/focus-visible@5.0.2/dist/focus-visible.js', [], $version, true);
  wp_enqueue_script('lazy-load', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js', [], $version, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', ['focus-visible', 'lazy-load'], $version, true);

  wp_localize_script('main-js', 'WPJS', [
    'siteUrl' => get_template_directory_uri(),
  ]);
}

/*carbon-fields-options*/
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
    add_theme_support('post-thumbnails');
}
use Carbon_Fields\Container;
use Carbon_Fields\Field; 


add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	
    Container::make( 'theme_options', __( 'Общие настройки' ) )
        ->add_tab('Шапка сайта', [
            Field::make( 'text', 'site-title', 'Название сайта' ),
            Field::make( 'text', 'site-description', 'Описание названия сайта' ),
            
        ])
          
        ->add_tab('Подвал сайта', [
            Field::make( 'text', 'mail-footer', 'Почта для связи' ),
            Field::make( 'text', 'phone-number-footer', 'Номер телефона для связи' ),

        ])

        // ->add_tab('Индекс страница', [
        // 	Field::make( 'text', 'site-greetings', 'Приветственная надпись' ),
		// 	Field::make( 'text', 'site-greetings-description', 'Описание приветственной надписи' ),

		// ])

	// 	->add_tab('Настройка карусели', [
    //     	Field::make( 'association', 'karysel_options', __( 'Карусель' ) )
	// 		->set_types( [
	// 			[
	// 				'type'      => 'post',
	// 				'post_type' => 'picture',
	// 			]	
	// 	 	])

			
	// ])
	;
	Container::make( 'post_meta', __( 'Информация о мастере' ) )  // обязательно 'post_meta'
	-> show_on_post_type('masters')
	->add_tab('Информация', [
		Field::make( 'rich_text', 'master-info', 'Информация' )
		->set_required(true)
				->help_text('Заполните это поле вместо поля сверху')
	]);

	Container::make( 'post_meta', __( 'Дополнительные поля' ) )  // обязательно 'post_meta'
	-> show_on_post_type('masters')

	->add_tab('Контакты', [
			Field::make( 'text', 'master-phone', 'Номер телефона' )
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'master-email', 'Почта')
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'master-vk', 'Вконтакте (Ссылка)')
			->help_text('Оставьте пустым, если нет'),
	])
	->add_tab('Галерея', [
		Field::make( 'complex', 'master-gallery', 'Галерея мастера' )
		->set_max(4)
		->add_fields([
			Field::make( 'image', 'master-gallery-photo', 'Изображение' )
			->set_required(true),
		])
		
	])
	->add_tab('Ремеcло', [
		Field::make('text', 'master-top', 'Ремесло мастера')	
		->set_required(true),
		Field::make('text', 'master-top-label', 'Ярлык ремесла мастера')
		->set_required(true)
		->help_text('ВНИМАНИЕ: вставте Ярлык ремесла из "Виды ремесел". необходимо для работы поиска'),		
	]);  

	Container::make( 'post_meta', __( 'Информация о ремесле' ) )  // обязательно 'post_meta'
	-> show_on_post_type('top')
	->add_tab('Информация', [
		Field::make( 'rich_text', 'top-info', 'Информация' )
		->set_required(true)
				->help_text('Заполните это поле вместо поля сверху')
	]);

	Container::make( 'post_meta', __( 'Дополнительные поля' ) )  // обязательно 'post_meta'
	-> show_on_post_type('top')
	
	->add_tab('Ярлык', [
		Field::make( 'text', 'top-label', 'Ярлык ремесла' )
		->set_required(true)
			->help_text('Напишите сюда название ремесла на английском без пробелов. Пример: felted-toy'),
		Field::make("checkbox", "top-filter", 'Отображать в фильтрах на странице "Мастера"')
	])
	->add_tab('Мастера', [
		Field::make( 'complex', 'top-masters', 'Мастера, занимающиеся этим ремеслом' )
		->add_fields([
			Field::make( 'text', 'master', 'ФИО' )
			->set_required(true)
			->help_text('Напишите сюда ФИО мастера полностью. Пример: Гордон Елена Ивановна'),
		])
	])
	
	->add_tab('Галерея', [
		Field::make( 'complex', 'top-gallery', 'Галерея ремесла' )
		->set_max(4)
		->add_fields([
			Field::make( 'image', 'top-gallery-photo', 'Изображение' )
			->set_required(true),
		])
	]);

    Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'
		-> show_on_page(22)

        ->add_tab('Настройка карусели', [
        	Field::make( 'association', 'karysel_options', 'Карусель' )
			->set_types( [
				[
					'type'      => 'post',
					'post_type' => 'picture',
				]	
		 	])
			
		])
		->add_tab('Приветствие', [
        	Field::make( 'rich_text', 'site-greetings', 'Приветственная надпись' ),
			Field::make( 'rich_text', 'site-greetings-description', 'Описание приветственной надписи' ),
		]);

	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'	
		-> show_on_page(41)

        ->add_tab('Настройка мастеров', [
        	Field::make( 'association', 'masters_options', 'Мастера' )
			->set_types( [
				[
					'type'      => 'post',
					'post_type' => 'masters',
				]	
		 	])
			
		]);  
	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'	
		-> show_on_page(29)

		->add_tab('Настройка фильтров', [
        	Field::make( 'complex', 'top-filters', 'Фильтры на странице "Виды ремесел"' )
			->add_fields([
				Field::make( 'text', 'name', 'Имя фильтра' )
				->set_required(true),
				Field::make( 'text', 'label', 'Ярлык фильтра' )
				->set_required(true)
				->help_text('Напишите сюда название фильтра на английском без пробелов. Пример: test-toys'),
				Field::make( 'complex', 'tops-in-filters', 'Ремесла в фильтре' )
					->add_fields([
						Field::make( 'text', 'top-in-filter', 'Ярлык ремесла' )
						->set_required(true)
						->help_text('Напишите сюда Ярлык ремесла с его страницы в "Виды ремесел"'),
					])
			])
			
		])
        ->add_tab('Настройка ремесел', [
        	Field::make( 'association', 'tops_options', 'Ремесла' )
			->set_types( [
				[
					'type'      => 'post',
					'post_type' => 'top',
				]	
		 	])
			
		]);  
		
	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'
		-> show_on_page(127)
		->add_tab('Сувенирные лавки', [
			Field::make( 'complex', 'shops', 'Лавки' )
			->setup_labels( ['singular_name' => 'лавку', 'plural_name'   => 'лавок',])
			->add_fields([
				Field::make( 'image', 'img', 'Фото' )
				->set_required(true),
				Field::make( 'text', 'name', 'Название' )
				->set_required(true),
				Field::make( 'text', 'url', 'Ссылка' )
				->set_required(true),
			])
		]);
	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'
		-> show_on_page(123)
		->add_tab('Фильтры', [
			Field::make( 'complex', 'online-filters', 'Фильтры онлайн мастер-классов' )
			->setup_labels( ['singular_name' => 'фильтр', 'plural_name'   => 'фильтров',])
			->add_fields([
				Field::make( 'text', 'name', 'Название фильтра' )
				->set_required(true),
				Field::make( 'text', 'label', 'Ярлык фильтра' )
				->help_text('Напишите сюда название фильтра на английском без пробелов. Пример: test-toys')
				->set_required(true),
			])
		])
		->add_tab('Онлайн мастер-классы', [
			Field::make( 'complex', 'online', 'Мастер-классы' )
			->setup_labels( ['singular_name' => 'мастер-класс', 'plural_name'   => 'мастер-классов',])
			->add_fields([
				Field::make( 'image', 'img', 'Фото' )
				->set_required(true),
				Field::make( 'text', 'name', 'Название' )
				->set_required(true),
				Field::make( 'rich_text', 'description', 'Краткое описание' )
				->set_required(true),
				Field::make( 'text', 'url', 'Ссылка' )
				->set_required(true),
				Field::make( 'complex', 'labels', 'Ярлыки' )
				->setup_labels( ['singular_name' => 'ярлык', 'plural_name'   => 'ярлыков',])
				->add_fields([
					Field::make( 'text', 'label', 'Ярлык фильтра' )
					->help_text('Напишите сюда ярлык фильтра, под которым хотите видеть данный пост'),
				])
					
					
			])
		]);


	
	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'	
		-> show_on_page(121)

		->add_tab('Фильтры', [
			Field::make( 'complex', 'events-filters', 'Фильтры мероприятий' )
			->setup_labels( ['singular_name' => 'фильтр', 'plural_name'   => 'фильтров',])
			->add_fields([
				Field::make( 'text', 'name', 'Название фильтра' )
				->set_required(true),
				Field::make( 'text', 'label', 'Ярлык фильтра' )
				->help_text('Напишите сюда название фильтра на английском без пробелов. Пример: test-toys')
				->set_required(true),
			])
	])

		->add_tab('Настройка мероприятий', [
			Field::make( 'association', 'events_options', 'Мероприятия' )
			->set_types( [
				[
					'type'      => 'post',
					'post_type' => 'events',
				]	
			])
			
	]); 

	Container::make( 'post_meta', __( 'Информация о мероприятии' ) )  // обязательно 'post_meta'
	-> show_on_post_type('events')
	->add_tab('Информация', [
		Field::make( 'rich_text', 'event-info', 'Информация' )
		->set_required(true)
				->help_text('Заполните это поле вместо поля сверху'),
	])
	->add_tab('Краткое описание', [
		Field::make( 'rich_text', 'event-mini-info', 'Краткое описание' )
		->set_required(true),	
	]);

	Container::make( 'post_meta', __( 'Дополнительные поля' ) )  // обязательно 'post_meta'
	-> show_on_post_type('events')
	->add_tab('Доп. изображение', [
		Field::make( 'image', 'inside-img', 'Изображение внутри модального окна' )
		->set_required(true),
	])
	->add_tab('Ярлыки', [
	Field::make( 'complex', 'events-labels', 'Ярлыки' )
	->setup_labels( ['singular_name' => 'ярлык', 'plural_name'   => 'ярлыков',])
	->add_fields([
		Field::make( 'text', 'label', 'Ярлык фильтра' )
		->help_text('Напишите сюда ярлык фильтра, под которым хотите видеть данный пост')
		->set_required(true),
	])
	])

	->add_tab('Организатор', [
		Field::make( 'text', 'event-organizer', 'Организатор' )
		->set_required(true)
	])
	->add_tab('Контакты', [
			Field::make( 'text', 'event-phone', 'Номер телефона' )
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'event-email', 'Почта')
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'event-vk', 'Вконтакте (Ссылка)')
			->help_text('Оставьте пустым, если нет'),
	])		

	->add_tab('Время', [
		Field::make('text', 'event-date-start', 'Дата мероприятия')	
		->set_required(true)
		->help_text('ВНИМАНИЕ: Заполнять строго в соответствии с примером. Пример: ДД.ММ.ГГГГ'),
		Field::make('text', 'event-time-start', 'Время начала')
		->set_required(true)
		->help_text('Пример: 12:56'),		
	])
	->add_tab('Адрес', [
		Field::make('text', 'event-place', 'Место проведения')	
		->set_required(true),
		Field::make('text', 'event-ya-link', 'Ссылка на место в Яндекс картах')
		->set_required(true)
		->help_text('Как получить? 1. Открываете место на карте 2. Нажимаете "Поделиться" 3. Копируете ссылку Пример: https://yandex.ru/maps/-/CDQlBDKR'),		
	]);  

	Container::make( 'post_meta', __( 'Настройка' ) )  // обязательно 'post_meta'	
		-> show_on_page(125)

		->add_tab('Фильтры', [
			Field::make( 'complex', 'offline-filters', 'Фильтры офлайн мастер-классов' )
			->setup_labels( ['singular_name' => 'фильтр', 'plural_name'   => 'фильтров',])
			->add_fields([
				Field::make( 'text', 'name', 'Название фильтра' )
				->set_required(true),
				Field::make( 'text', 'label', 'Ярлык фильтра' )
				->help_text('Напишите сюда название фильтра на английском без пробелов. Пример: test-toys')
				->set_required(true),
			])
	])

		->add_tab('Настройка офлайн мастер-классов', [
			Field::make( 'association', 'offline_options', 'Офлайн мастер-классы' )
			->set_types( [
				[
					'type'      => 'post',
					'post_type' => 'offline',
				]	
			])
			
	]); 

Container::make( 'post_meta', __( 'Информация об офлайн мастер-классе' ) )  // обязательно 'post_meta'
	-> show_on_post_type('offline')
	->add_tab('Информация', [
		Field::make( 'rich_text', 'offline-info', 'Информация' )
		->set_required(true)
				->help_text('Заполните это поле вместо поля сверху'),
	])
	->add_tab('Краткое описание', [
		Field::make( 'rich_text', 'offline-mini-info', 'Краткое описание' )
		->set_required(true),	
	]);

	Container::make( 'post_meta', __( 'Дополнительные поля' ) )  // обязательно 'post_meta'
	-> show_on_post_type('offline')
	->add_tab('Доп. изображение', [
		Field::make( 'image', 'inside-img', 'Изображение внутри модального окна' )
		->set_required(true),
	])
	->add_tab('Ярлыки', [
	Field::make( 'complex', 'offline-labels', 'Ярлыки' )
	->setup_labels( ['singular_name' => 'ярлык', 'plural_name'   => 'ярлыков',])
	->add_fields([
		Field::make( 'text', 'label', 'Ярлык фильтра' )
		->help_text('Напишите сюда ярлык фильтра, под которым хотите видеть данный пост')
		->set_required(true),
	])
	])
	->add_tab('Контакты', [
			Field::make( 'text', 'offline-phone', 'Номер телефона' )
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'offline-email', 'Почта')
			->help_text('Оставьте пустым, если нет'),
			Field::make('text', 'offline-vk', 'Вконтакте (Ссылка)')
			->help_text('Оставьте пустым, если нет'),
	])		

	->add_tab('Время', [
		Field::make('text', 'offline-date-start', 'Дата офлайн мастер-класса')	
		->set_required(true)
		->help_text('ВНИМАНИЕ: Заполнять строго в соответствии с примером. Пример: ДД.ММ.ГГГГ'),
		Field::make('text', 'offline-time-start', 'Время начала')
		->set_required(true)
		->help_text('Пример: 12:56'),		
	])
	->add_tab('Адрес', [
		Field::make('text', 'offline-place', 'Место проведения')	
		->set_required(true),
		Field::make('text', 'offline-ya-link', 'Ссылка на место в Яндекс картах')
		->set_required(true)
		->help_text('Как получить? 1. Открываете место на карте 2. Нажимаете "Поделиться" 3. Копируете ссылку Пример: https://yandex.ru/maps/-/CDQlBDKR'),		
	]);  

}

add_action( 'init', 'register_post_types' );

function register_post_types(){	

	register_post_type( 'picture', [
		'label'  => null,
		'labels' => [
			'name'               => 'Картинки в "Каруселе"', // основное название для типа записи
			'singular_name'      => 'Картинка', // название для одной записи этого типа
			'add_new'            => 'Добавить картинку', // для добавления новой записи
			'add_new_item'       => 'Добавление картинки', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование картинки', // для редактирования типа записи
			'new_item'           => 'Новая картинка', // текст новой записи
			'view_item'          => 'Смотреть картинку', // для просмотра записи этого типа.
			'search_items'       => 'Искать картинку', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => '"Карусель"', // название меню
		],

		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-image',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => ['slug' => 'pictures'],
		'query_var'           => true
	] );

	register_post_type( 'top', [
		'label'  => null,
		'labels' => [
			'name'               => 'Виды ремесел', // основное название для типа записи
			'singular_name'      => 'Ремесло', // название для одной записи этого типа
			'add_new'            => 'Добавить ремесло', // для добавления новой записи
			'add_new_item'       => 'Добавление ремесла', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование ремесла', // для редактирования типа записи
			'new_item'           => 'Новое ремесло', // текст новой записи
			'view_item'          => 'Смотреть ремесло', // для просмотра записи этого типа.
			'search_items'       => 'Искать ремесло', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Виды ремесел', // название меню
		],

		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-screenoptions',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => ['slug' => 'crafts'],
		'query_var'           => true
	] );

	register_post_type( 'masters', [
		'label'  => null,
		'labels' => [
			'name'               => 'Мастера', // основное название для типа записи
			'singular_name'      => 'Мастер', // название для одной записи этого типа
			'add_new'            => 'Добавить мастера', // для добавления новой записи
			'add_new_item'       => 'Добавление мастера', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование мастера', // для редактирования типа записи
			'new_item'           => 'Новый мастер', // текст новой записи
			'view_item'          => 'Смотреть мастера', // для просмотра записи этого типа.
			'search_items'       => 'Искать маcтера', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Мастера', // название меню
		],

		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => ['slug' => 'masters'],
		'query_var'           => true
	] );

	register_post_type( 'offline', [
		'label'  => null,
		'labels' => [
			'name'               => 'Офлайн мастер-классы', // основное название для типа записи
			'singular_name'      => 'Офлайн мастер-класс', // название для одной записи этого типа
			'add_new'            => 'Добавить мастер-класс', // для добавления новой записи
			'add_new_item'       => 'Добавление мастер-класса', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование мастер-класса', // для редактирования типа записи
			'new_item'           => 'Новый мастер-класс', // текст новой записи
			'view_item'          => 'Смотреть мастер-классы', // для просмотра записи этого типа.
			'search_items'       => 'Искать мастер-класс', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Офлайн мастер-классы', // название меню
		],

		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-hammer',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => ['slug' => 'masters'],
		'query_var'           => true
	] );
	
	register_post_type( 'events', [
		'label'  => null,
		'labels' => [
			'name'               => 'Мероприятия', // основное название для типа записи
			'singular_name'      => 'Мероприятие', // название для одной записи этого типа
			'add_new'            => 'Добавить мероприятие', // для добавления новой записи
			'add_new_item'       => 'Добавление мероприятия', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование мероприятия', // для редактирования типа записи
			'new_item'           => 'Новое мероприятие', // текст новой записи
			'view_item'          => 'Смотреть мероприятие', // для просмотра записи этого типа.
			'search_items'       => 'Искать мероприятие', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Мероприятия', // название меню
		],

		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-tickets',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => ['slug' => 'masters'],
		'query_var'           => true
	] );

	




	// // список параметров: wp-kama.ru/function/get_taxonomy_labels
	// register_taxonomy( 'crafts', 'masters', [
	// 	'label'                 => '', // определяется параметром $labels->name
	// 	'labels'                => [
	// 		'name'              => 'Вид ремесла мастера',
	// 		'singular_name'     => 'Ремесло',
	// 		'search_items'      => 'Искать ремесло',
	// 		'all_items'         => 'Все ремесла',
	// 		'view_item '        => 'Посмотреть ремесло',
	// 		// 'parent_item'       => 'Parent Genre',
	// 		// 'parent_item_colon' => 'Parent Genre:',
	// 		'edit_item'         => 'Изменить ремесло',
	// 		'update_item'       => 'Обновить ремесло',
	// 		'add_new_item'      => 'Добавить новое ремесло',
	// 		'new_item_name'     => 'Добавить новое название ремесла',
	// 		'menu_name'         => 'Категории ремесел',
	// 		// 'back_to_items'     => '← Back to Genre',
	// 	],
	// 	'description'           => '', // описание таксономии
	// 	'public'                => true,
	// 	// 'publicly_queryable'    => null, // равен аргументу public
	// 	// 'show_in_nav_menus'     => true, // равен аргументу public
	// 	// 'show_ui'               => true, // равен аргументу public
	// 	// 'show_in_menu'          => true, // равен аргументу show_ui
	// 	// 'show_tagcloud'         => true, // равен аргументу show_ui
	// 	// 'show_in_quick_edit'    => null, // равен аргументу show_ui
	// 	'hierarchical'          => false,
	// 	'rewrite'               => true,
	// 	//'query_var'             => $taxonomy, // название параметра запроса
	// 	'capabilities'          => array(),
	// 	'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
	// 	'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
	// 	'show_in_rest'          => null, // добавить в REST API
	// 	'rest_base'             => null, // $taxonomy
	// 	// '_builtin'              => false,
	// 	//'update_count_callback' => '_update_post_term_count',
		
	// ] );

	
}

// add_action( 'register_post_types', 'add_taxonomy_thumbs' );

// function add_taxonomy_thumbs( $out, $term ) {
//     if($term->description){
//         echo '<img src="'.$term->description.'" style="margin:0 10px 3px 0;float:left;" width="48px" height="48px" />';
//     }
//     return $out;
// }
 
// add_filter( 'crafts_row_actions', 'add_taxonomy_thumbs', 10, 2 );