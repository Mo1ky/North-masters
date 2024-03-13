<?php

/*

Template Name: Офлайн

*/

$offline_id = get_the_ID();
$offline_filters = carbon_get_post_meta($offline_id, 'offline-filters');
?>

<?php get_header(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.mixitup-2.1.11.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/filter.js"></script>

<main class="main">

            <div class="center">

               <div class="types">

                  <h2 class="event__title title">Ближайшие мастер-классы</h2>

                  <div class="d7">
                       <input type="text" id="input_sr" placeholder="Искать здесь...">
                     </div>
               <div class="spoiler_wrap">
                  <div class="spoiler_title_wrap">
                     <h1 class="spoiler_title filters__title">
                                   Фильтры<i class="fa fa-angle-down arrow-t " aria-hidden="true"></i>
                        </h1>
                  </div>
                  &nbsp;&nbsp;
                  <div class="spoiler_content">

                     <div class="types__filters">

                     

                        <h2 class="filters__title">Виды мероприятий:</h2>

                        <form class="controls" id="Filters">

      

                           <fieldset>
                           <?php if ($offline_filters) : ?>

                              <?php foreach ($offline_filters as $filter) : ?>

                                 <label class="checkbox">

                                    <input type="checkbox" value=".f-<?php echo $filter['label']; ?>"/>

                                    <span><?php echo $filter['name']; ?></span>

                                 </label>

                              <?php endforeach; ?>

                           <?php endif; ?>

                           <button id="Reset">Сбросить фильтры</button>

                           </fieldset>

                           <h2 class="filters__title">Время:</h2>

                           <fieldset>

                              <label class="checkbox"> 

                                 <input type="date" id="from" value="" onchange="javascript:onDateChange(this);"/>

                                 <script>

                                    function onDateChange(obj)

                                       {

                                          var date = obj.value;

                                          date = date.replace(/(\d+)-(\d+)-(\d+)/,"$3-$2-$1")

                                          if (date != null) {

                                             calendar_value.value='.' + date;

                                             calendar_value.checked=true;

                                          }

                                          

                                          if (date == "") {

                                             calendar_value.checked=false;

                                          }

                                       }

                                 </script>

                              </label>

                              <label class="checkbox">

      

                                 <input type="checkbox" value="" id="calendar_value"/>

                              </label>

                              <label class="checkbox">

                                 <input type="checkbox" value="" id="today_value"/>

                                 <span id="current_date_time_block_today">Сегодня</span>

      

                              </label>

      

                              <label class="checkbox">

                                 <input type="checkbox" value="" id="tomorrow_value"/>

                                 <span id="current_date_time_block_tomorrow">Завтра</span>

      

                              </label>

                              <label class="checkbox">

                                 <input type="checkbox" value="" id="aftomorrow_value"/>

                                 <span id="current_date_time_block_aftomorrow">Послезавтра</span>

                              </label>

                           

                           </fieldset>

                           

                        </form>

                     </div>        
                  </div>
               </div>
            </div>
               <div class="links_forms">
                        <a class="link_to_form" target="_blank" href="https://forms.yandex.ru/cloud/644cc560c769f117f52b28cb/">Хотите разместить свой мастер-класс?</a>
                        <a class="link_to_form" target="_blank" href="https://forms.yandex.ru/cloud/64e64c1bc09c023e3f33d8de/">Желаете поменять информацию о мастер-классе?</a>
               </div>
                  <div id="Container" class="container">
                     <div class="fail-message">
                        <span>Мастер-классов с выбранными параметрами сейчас нет.
                           <br><br> 
                           <!--
                           Попробуйте изменить настройки фильтра или сбросить фильтры.
                        -->
                        </span>
                     </div>

                     <?php 
                           
                           $offline = carbon_get_post_meta( 125, 'offline_options');
                        
                           $offline_ids = wp_list_pluck($offline, 'id');
                           
                           if ($offline) :
                           // echo '<pre>';
                           // print_r($offline_ids);
                           // echo '</pre>';
                           $offline_query_args = [
                              'post_type' => 'offline',
                              'post__in'  => $offline_ids, 
                              'orderby'   => 'post__in',
                           ];
                           $offline_query = new WP_Query( $offline_query_args );
                        ?>
                  
                        <?php if ( $offline_query->have_posts() ) : ?>
                     
                           
                           <!-- цикл -->
                           <?php while ( $offline_query->have_posts() ) : $offline_query->the_post(); ?>

                     
                              <?php echo get_template_part('offline-content'); ?>
                              

                           <?php endwhile; ?>
                           
                           <!-- конец цикла -->

                           <!-- чистим данные -->
                           <?php wp_reset_postdata(); ?>
                           
                        

                        <?php endif; ?>
                        <?php else: ?>
                        <?php endif; ?>
                        
                                 

                  </div>

               

            </div>

         </main>  

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/date.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/copy.js"></script>

<?php get_footer(); ?>
