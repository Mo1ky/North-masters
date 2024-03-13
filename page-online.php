<?php

/*

Template Name: Онлайн

*/

?>

<?php get_header(); ?>

<?php
$online_mk_id = get_the_ID();
$online_mk = carbon_get_post_meta($online_mk_id, 'online');
$online_mk_filters = carbon_get_post_meta($online_mk_id, 'online-filters');

?>

<main class="main">

            <div class="center">

                  <div class="types">

                     <h1 class="master-class__title title">Онлайн мастер-классы</h1>

                     <div class="types__filters">

                        <h2 class="filters__title">По видам изделий:</h2>

                        <button type="button" class="types__button" data-filter="all">Все мастер-классы</button>

                           <?php if ($online_mk_filters) : ?>

                              <?php foreach ($online_mk_filters as $filter) : ?>

                                 <button type="button" class="types__button" data-filter=".f-<?php echo $filter['label']; ?>"><?php echo $filter['name']; ?></button>

                              <?php endforeach; ?>

                           <?php endif; ?>

                     </div>

                  </div>



                  <div class="master-class">

                     <div class="master-class__body">  

                        <?php if ($online_mk) : ?>

                           <?php foreach ($online_mk as $mk) : ?>
                             
                              <?php if ($mk['labels']) : ?>

                                 <?php foreach ($mk['labels'] as $filter) : ?>

                                    <?php $labels = $filter['label']; ?>
                                          
                                          <?php if ($labels) : ?>

                                             <?php $mk_filter_end = ($mk_filter_end . ' ' . 'f-'.$labels); ?>
                                                            
                                             
                                          <?php endif; ?>

                                 <?php endforeach; ?>
                              
                              <?php endif; ?>
                                 

                              <a href="<?php echo $mk['url']; ?>" target="_blank" class="link" class="item-master-class__link-title">

                                 <div class="master-class__item item-master-class mix <?php echo $mk_filter_end; ?>">

                                    <div class="item-master-class__content">

                                       <h2 class="item-master-class__title">        

                                          <?php echo $mk['name']; ?>

                                       </h2>

                                       <div class="item-master-class__text">

                                          <?php echo wpautop($mk['description']); ?>

                                       </div>

                                    </div>

                                    <div class="item-master-class__image">

                                       <img src="<?php echo wp_get_attachment_image_url($mk['img'], 'full'); ?>" alt="">

                                    </div>

                                 </div>

                              </a>
                              <?php $mk_filter_end = ''; ?>
                              <?php wp_reset_postdata(); ?>
                           <?php endforeach; ?>
                           <?php else: ?><div class="fail-message"><span>Пока что здесь ничего нет.</span></div>
                        <?php endif; ?>

                     </div>

                  </div>

            </div>

         </main> 





<?php get_footer(); ?>

<script>      

      var mixer = mixitup(".master-class__body");

</script>