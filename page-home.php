<?php
/*
Template Name: Главная 
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/owl.theme.default.min.css">
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/mainJQ.js" defer></script>
<!-- Карусель -->



<?php

	$karysel_imgs = carbon_get_post_meta( $page_id, 'karysel_options');
	if ($karysel_imgs) :
	$karysel_imgs_ids = wp_list_pluck($karysel_imgs, 'id');

	$karysel_imgs_query_args = [

		'post_type' => 'picture',
		'post__in' => $karysel_imgs_ids,
		'orderby'   => 'post__in',
	];

	$karysel_imgs_query = new WP_Query( $karysel_imgs_query_args );
	
	
?>


<?php if ( $karysel_imgs_query->have_posts() ) : ?>
<div class="main-carousel-block">
	<div class="owl-carousel main-carousel">
	
	<!-- цикл -->
	<?php while ( $karysel_imgs_query->have_posts() ) : $karysel_imgs_query->the_post(); ?>
	<a href="http://severmasters29.ru.xsph.ru/crafts/">
		<?php echo get_template_part('karysel-content'); ?>
	</a>
		

	<?php endwhile; ?>
	
	<!-- конец цикла -->

	<!-- чистим данные -->
	<?php wp_reset_postdata(); ?>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>


			
			<!--<div class="owl-slide">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/carousel/3.webp">
				<a href="./top.html#popup-7" class="owl-slide-text">
					Обработка бересты
				</a>
			</div> 
			<div class="owl-slide">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/carousel/6.webp">
				<a href="./top.html#popup-5" class="owl-slide-text">
					Лоскутное шитьё
				</a>
			</div>
			<div class="owl-slide">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/carousel/7.webp">
				<a href="./top.html#popup-11" class="owl-slide-text">
					Керамика
				</a>
			</div>
			<div class="owl-slide">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/carousel/8.webp">
				<a href="./top.html#popup-15" class="owl-slide-text">
					Бондарное дело
				</a>
			</div>
			<div class="owl-slide">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/carousel/5.webp">
				<a data-href="./top.html#popup-3" href="./top.htm#popup-3" class="owl-slide-text">
					Народная игрушка
				</a>
			</div> -->
		

        <!--Основная надпись-->
        <main class="main main-index">
            <div class="center">
                <div class="site__greetings">
                    <p class="first">
                        <?php echo carbon_get_post_meta( $page_id, 'site-greetings' ); ?>
                    </p>
                    <p>
                        <?php echo wpautop(carbon_get_post_meta( $page_id, 'site-greetings-description' )); ?>
                    </p>
                </div>
            </div>
        </main>

<?php get_footer(); ?>