<!DOCTYPE html>
<html lang="ru">

<head>
<meta charset="UTF-8">
    <!--Надо для корректного отображения-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Надо для корректного отображения-->
    <meta name="description" content="Этот сайт — проводник в мир северного творчества. Он ознакомит вас с мастерами прикладного искусства Северодвинска и их работами; культурными центрами и интересными местами Севера, а также поможет в реализации личных задумок.">
    <title>Мастера Северодвинска</title>
    <meta property="og:site_name" content="Мастера Северодвинска">
    <!--Надо для корректного отображения-->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/icon/favicon.ico">
    <!--fonts-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.css">
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/Montserrat.css">
    
    <!--Надо для корректного отображения-->

    <!--Меню с поиском и челиком-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/normalize.css">
    <!--Надо-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/styles.css">
    <!--general css-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/media.css">
    <!--menu buttons-->
    <!--это что бы картинки на главной стринице были и менялись-->
    <!--Надо-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.6.0.min.js"></script>
    <!--Эта штука нужна для того что бы работали меняюшиеся картинки-->
</head>

<body>
<header class="header">
      <div class="upper-header">
          <!--эта часть делает лучше верхнюю часть меню-->
          <div class="center">
              <!--центрирует верхнюю менюшку-->
              <div class="upper-header__content">
                  <!-- это штука позиционирует кнопки поиска и аккаунта-->
                  <div class="logo">
                      <img class="logo_img" src="<?php echo get_template_directory_uri(); ?>/assets/icon/icon.png">
                  </div>
                  <span class="site-title"><a href="http://severmasters29.ru.xsph.ru/"><?php echo carbon_get_theme_option( 'site-title' ); ?></a>
                            <br><span><?php echo carbon_get_theme_option( 'site-description' ); ?></span></span>
                  <div class="user-block">
                  </div>
                  <div class="menu-box mobile-toggle">
                      <i class="fa fa-bars"></i>
                  </div>
                  <nav class="dws-menu">
                <ul>
                    <li>
                        <a href="http://severmasters29.ru.xsph.ru/crafts/">Виды ремёсел</a>
                    </li>
                    <li>
                        <a href="http://severmasters29.ru.xsph.ru/masters/">Мастера</a>
                    </li>
                    <li>
                        <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m2">
                        <a>мастер-классы</a>
                        <label for="sub_m2" class="toggleSubmenu"><i class="fa"></i></label>
                        <ul>
                            <li><a href="http://severmasters29.ru.xsph.ru/online/"><i class="fa fa-solid fa-globe"></i>&nbsp;ОНЛАЙН</a></li>
                            <li><a href="http://severmasters29.ru.xsph.ru/offline/"><i class="fa fa-calendar"></i></i>&nbsp;ОФЛАЙН</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://severmasters29.ru.xsph.ru/events/">Мероприятия</a>
                    </li>
                    <li>
                        <a href="http://severmasters29.ru.xsph.ru/shops/">Сувенирные лавки</a>
                    </li>
                    <li class="header-item user">
                        <!--
                        <a href="#" title="Поиск по сайту"><i class="fa fa-search" aria-hidden="true"></i></a>
                        -->
                        <a href="http://severmasters29.ru.xsph.ru/about/" title="Об авторе"><i class="fa fa-user" aria-hidden="true"></i></a>

                    </li>
                </ul>
            </nav>
              </div>
          </div>
      </div>
      </header>
<div class="wrapper">