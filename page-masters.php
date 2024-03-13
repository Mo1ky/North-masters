<?php
/*
Template Name: Мастера
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/lightgallery.css">
<?php 

$master_id = get_the_ID();

$master_gallery = carbon_get_post_meta($master_id, 'master-gallery');
$master_phone = carbon_get_post_meta($master_id, 'master-phone');
$master_email = carbon_get_post_meta($master_id, 'master-email');
$master_vk = carbon_get_post_meta($master_id, 'master-vk');
$master_info = carbon_get_post_meta($master_id, 'master-info');
$master_top = carbon_get_post_meta($master_id, 'master-top');
$master_img_src = get_the_post_thumbnail_url( $master_id, 'full' );

?>
<main class="main">
<section class="card-section">
            <div class="center">
                <div class="masters">
                    <h1 class="masters__title title">Мастера Северодвинска</h1>
                    <!--Фильтры мастеров-->
                    <div class="types__filters">
                        <h2 class="filters__title">Направления:</h2>
                        <button type="button" class="types__button" data-filter="all">Все направления</button>

                            <?php 
                                                                
                                    $top_ids = wp_list_pluck($top, 'id');
                                
                                    $top_query_args = [
                                        'post_type' => 'top',
                                        'post__in'  => $top_ids,
                                        'orderby'   => 'post__in',
                                    ];
                                    $top_query = new WP_Query( $top_query_args );
                                    
                                ?>
                        
                            <?php if ( $top_query->have_posts() ) : ?>
                                <?php while ( $top_query->have_posts() ) : $top_query->the_post(); ?>
                                    <?php 
                                        $top_id = get_the_ID();
                                        
                                        // print_r($top_id);                                    
                                        $top = carbon_get_post_meta( 29, 'top_options');
                                        $top_ids = wp_list_pluck($top, 'id');
                                        $top_label = carbon_get_post_meta($top_id, 'top-label');
                                        $top_filter = carbon_get_post_meta($top_id, 'top-filter');                                        
                                                                        
                                    ?>
                                    
                                    <?php if ($top_filter) : ?>
                                        
                                        <button type="button" class="types__button" data-filter=".<?php echo $top_label; ?>"><?php echo get_the_title(); ?></button>
                                    
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                                
                            <?php endif; ?>
                    </div>
                    <!--Все мастера-->
                    <div class="links_forms">
                        <a class="link_to_form" target="_blank" href="https://forms.yandex.ru/cloud/644c0b88c09c0213e9b1cd6f/">Вы мастер и хотите находиться на этом сайте?</a>
                        <a class="link_to_form" target="_blank" href="https://forms.yandex.ru/cloud/64e64d5cd046884e4918c3d8/">Желаете изменить информацию о себе?</a>
                    </div>
                    <?php 
                        $masters = carbon_get_post_meta( 41, 'masters_options');
                        if ($masters) :
                        $masters_ids = wp_list_pluck($masters, 'id');
                        // echo '<pre>';
                        // print_r($masters_ids);
                        // echo '</pre>';
                        $masters_query_args = [
                            'post_type' => 'masters',
                            'post__in'  => $masters_ids, 
                            'orderby'   => 'post__in',
                        ];
                        $masters_query = new WP_Query( $masters_query_args );
                    ?>

                    <?php if ( $masters_query->have_posts() ) : ?>
                    <div class="masters__row">
                        
                        <!-- цикл -->
                        <?php while ( $masters_query->have_posts() ) : $masters_query->the_post(); ?>
                    
                            <?php echo get_template_part('masters-content'); ?>
                            

                        <?php endwhile; ?>
                        
                        <!-- конец цикла -->

                        <!-- чистим данные -->
                        <?php wp_reset_postdata(); ?>

                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                        <div class="fail-message"><span>Пока что здесь ничего нет.</span></div>
                    <?php endif; ?>
                
                    
                </div>
            </div>
</section>
</main>
        <script>
            // Устанавливаем значение на одной странице
            const masterLinks = document.querySelectorAll('.item-master-class__link');
            masterLinks.forEach(link => {
                link.addEventListener('click', () => {
                    localStorage.setItem('modal', link.dataset.modal) // для ссылки прописать атрибут data-modal
                })
            })
        </script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/lightgallery.umd.js"></script>
<?php get_footer(); ?>
<script>
    var mixer = mixitup(".masters__row");
</script>

<?php if ( $masters_query->have_posts() ) : ?>                        
    <!-- цикл -->
    <script type="text/javascript">


    <?php wp_reset_postdata(); ?>

    <?php while ( $masters_query->have_posts() ) : $masters_query->the_post(); ?>

        lightGallery(document.getElementById('lightgallery<?php echo get_the_ID(); ?>'));

    <?php endwhile; ?>
    
    // <!-- чистим данные -->
    <?php wp_reset_postdata(); ?>
    </script>
<?php endif; ?>

