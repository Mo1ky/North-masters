<?php
/*
Template Name: Виды ремёсел
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/lightgallery.css">
<?php

$top_id = get_the_ID();

$top_gallery = carbon_get_post_meta($top_id, 'top-gallery');
$top_info = carbon_get_post_meta($top_id, 'top-info');
$top_img_src = get_the_post_thumbnail_url( $top_id, 'full' );
$top_filters = carbon_get_post_meta($top_id, 'top-filters');

?>

<main class="main">
            <div class="center">
               <div class="types">
                  <h1 class="types__title title">Направления творчества</h1>
                  <div class="types__filters">
                     <h2 class="filters__title">Виды изделий:</h2>
                     <button type="button" class="types__button" data-filter="all">Все виды</button>

                     <?php if ($top_filters) : ?>

                        <?php foreach ($top_filters as $attribute) : ?>

                        <button type="button" class="types__button" data-filter=".f-<?php echo $attribute['label']; ?>"><?php echo $attribute['name']; ?></button>
                        
                        <?php endforeach; ?>

                     <?php endif; ?>
                     
                  </div>
                  
                  <?php 
                        $tops = carbon_get_post_meta( 29, 'tops_options');
                        if ($tops) :
                        $tops_ids = wp_list_pluck($tops, 'id');
                        // echo '<pre>';
                        // print_r($masters_ids);
                        // echo '</pre>';
                        $tops_query_args = [
                            'post_type' => 'top',
                            'post__in'  => $tops_ids,
                            'orderby'   => 'post__in',
                        ];
                        $tops_query = new WP_Query( $tops_query_args);
                        
                    ?>

                    <?php if ( $tops_query->have_posts() ) : ?>
                     <div class="types__row">
                        
                        <!-- цикл -->
                        <?php while ( $tops_query->have_posts() ) : $tops_query->the_post(); ?>
                           
                            <?php echo get_template_part('top-content'); ?>
                            
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

<?php if ( $tops_query->have_posts() ) : ?>                        
    <!-- цикл -->
    
    <script type="text/javascript">


    <?php wp_reset_postdata(); ?>

    <?php while ( $tops_query->have_posts() ) : $tops_query->the_post(); ?>

        lightGallery(document.getElementById('lightgallery<?php echo get_the_ID(); ?>'));

    <?php endwhile; ?>
    
    // <!-- чистим данные -->
    <?php wp_reset_postdata(); ?>
    </script>
<?php endif; ?>
<script>
      var mixer = mixitup(".types__row");
</script>




