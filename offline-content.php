<?php 

$offline_id = get_the_ID();

$offline_img_src = get_the_post_thumbnail_url( $offline_id, 'full' );
$offline_inside_img_src = carbon_get_post_meta( $offline_id, 'inside-img' );

$offline_info = wpautop(carbon_get_post_meta($offline_id, 'offline-info'));
$offline_mini_info = wpautop(carbon_get_post_meta($offline_id, 'offline-mini-info'));

$offline_labels = carbon_get_post_meta($offline_id, 'offline-labels');

$offline_phone = carbon_get_post_meta($offline_id, 'offline-phone');
$offline_email = carbon_get_post_meta($offline_id, 'offline-email');
$offline_vk = carbon_get_post_meta($offline_id, 'offline-vk');

$offline_date_start = carbon_get_post_meta( $offline_id, 'offline-date-start' );
$offline_time_start = carbon_get_post_meta($offline_id, 'offline-time-start');

$offline_place = carbon_get_post_meta( $offline_id, 'offline-place' );
$offline_ya_link = carbon_get_post_meta($offline_id, 'offline-ya-link');

?>

<?php foreach ($offline_labels as $offline) : ?>
                            
    <?php $offline_filter_end = ($offline_filter_end . ' ' . 'f-'.$offline['label']); ?>
                        
<?php endforeach; ?>

<a href="#popup-<?php echo get_the_title(); ?>" class="mix <?php echo $offline_filter_end; ?> link block popup-link">

    <div class="item-master-class search_object"> 

        <div class="item-event__content">

            <h2 class="item-event__title">

                <?php echo get_the_title(); ?>

            </h2>                  

            <div class="item-event__text">

                <?php echo $offline_mini_info; ?>    

            </div>

        

            <div class="item-events">

                <div class="item-event__text">Дата мастер-класса:&nbsp;

                    <span class="event_date"><?php echo $offline_date_start; ?></span></div>

            </div>

        </div>

        <div class="item-master-class__image">

        <img style="image-rendering: optimizeSpeed;" src="<?php echo $offline_img_src; ?>" alt="">

        </div>

    </div>          

</a>

<div id="popup-<?php echo get_the_title(); ?>" class="popup">

    <div class="popup__body">

        <div class="popup__content">

            <div class="popup__header">

                <h1 class="popup__title"><?php echo get_the_title(); ?></h1>

                <a href="#" class="popup__close close-popup">

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/cross.svg" alt="Закрыть модальное окно">

                </a>

            </div>

            <div class="popup__middle">

                <div class="popup__info">

                <?php echo $offline_info; ?>

                </div>

                <img style = "background: url(<?php echo wp_get_attachment_image_url($offline_inside_img_src, 'full') ?>) center 10% / cover no-repeat;" class="popup__img" alt=""></img>

            </div>



            <div class="popup__info">

                <?php if ($offline_phone or $offline_email or $offline_vk) : ?>
                
                <h2 class="popup__header">Контакты:</h2>

                <table cellspacing="0">
                <?php if ($offline_phone) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-phone" aria-hidden="true"></td>

                    <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                            <div class="section-info"><?php echo $offline_phone; ?></div>

                        </span></td>

                </tr>
                <?php endif; ?>
                <?php if ($offline_email) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-envelope-o"></i></td>

                    <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                            <div class="section-info"><?php echo $offline_email; ?></div>

                        </span></td>

                </tr>
                <?php endif; ?>
                <?php if ($offline_vk) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-solid fa-globe"></i></td>

                    <td class="rightcol"><a target="_blank" class="item-master-class__link"

                            href="<?php echo $offline_vk; ?>">Вконтакте</a></td>

                </tr>
                <?php endif; ?>
                </table>

                <?php endif; ?>

            </div>

            <h2 class="popup__header">Время:</h2>



            <table cellspacing="0" id="maket">

            <tr>

                <td class="leftcol"><i class="fa fa-calendar" aria-hidden="true"></i></td>

                <td class="rightcol">

                    <div class="section-info">Дата мастер-класса:&nbsp;<span

                        class="event_date"><?php echo $offline_date_start; ?></span></div>

                </td>

            </tr>

            <tr>

                <td class="leftcol"><i class="fa fa-clock-o" aria-hidden="true"></i></td>

                <td class="rightcol">

                    <div class="section-info">Начало в&nbsp;<span class="event_time"><?php echo $offline_time_start; ?></span></div>

                </td>

            </tr>

            </table>

            <h2 class="popup__header">Адрес:</h2>

            <table cellspacing="0">

            <tr>

                <td class="leftcol"><i class="fa fa-bandcamp" aria-hidden="true"></i></td>

                <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                        <div class="section-info"><?php echo $offline_place; ?></div>

                    </span></td>


            </tr>
            <tr>
                <td class="leftcol"><i class="fa fa-location-arrow" aria-hidden="true"></i></td>
                
                <td class="rightcol">
                    
                    <a class="section-info" target="_blank" href="<?php echo $offline_ya_link; ?>">Открыть в Яндекс.картах</a>

                </td>
            </tr>
            </table>

            &nbsp;

                <!--
                <div style="position:relative;overflow:hidden;">
                    <iframe
                        src="<?php echo $offline_ya_link; ?>" width=100% height="400"
                        frameborder="1" allowfullscreen="true" style="position:relative;" loading="lazy">
                    </iframe>
                    
                </div>
                -->
            </div>



        </div>

    </div>

