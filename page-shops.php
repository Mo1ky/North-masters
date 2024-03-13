<?php

/*

Template Name: Сувенирные лавки

*/

?>

<?php
$shop_id = get_the_ID();
$shops = carbon_get_post_meta($shop_id, 'shops');
?>

<?php get_header(); ?>

         <!-- Основной контент -->

         <main class="main">

            <div class="center">

               <div class="places">

                  <h1 class="places__title title">Сувенирные лавки</h1>

                  <div class="places__row">

                     <?php if ($shops) : ?>
                     
                        <?php foreach  ($shops as $shop) : ?>

                           <a href="<?php echo $shop['url']; ?>" target="_blank" style = "background: url( <?php echo wp_get_attachment_image_url($shop['img'], 'full'); ?>) center 10% / cover no-repeat;" class="places__block">
                          
                              <h2 class="block__title"><?php echo $shop['name']; ?></h2>

                           </a>

                        <?php endforeach; ?>
                        <?php else: ?><div class="fail-message"><span>Пока что здесь ничего нет.</span></div>
                     <?php endif; ?>

                     <!-- <a href="https://vk.com/morskayalavka29" target="_blank" id="ip-2" class="places__block">

                        <h2 class="block__title">Морская Лавка</h2>

                     </a>

                     <a href="https://t.me/darim_schastye" target="_blank" id="ip-3" class="places__block">

                        <h2 class="block__title">Сувенирный бутик <br>«Дарим счастье»</h2>

                     </a>

                     <a href="https://vk.com/krasivoemesto29" target="_blank" id="ip-4" class="places__block">

                        <h2 class="block__title">Красивое место</h2>

                     </a>

                     <a href="https://vk.com/club21352720" target="_blank" id="ip-5" class="places__block">

                        <h2 class="block__title">Изделия мастеров <br>«Чудеса в решете»</h2>

                     </a>

                     <a href="https://vk.com/gallerydoll29" target="_blank" id="ip-6" class="places__block">

                        <h2 class="block__title">Северодвинская кукольная галерея</h2>

                     </a> -->

                  </div>

               </div>

            </div>

         </main>  

<?php get_footer(); ?>