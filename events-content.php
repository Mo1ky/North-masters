<?php 

$event_id = get_the_ID();

$event_img_src = get_the_post_thumbnail_url( $event_id, 'full' );
$event_inside_img_src = carbon_get_post_meta( $event_id, 'inside-img' );

$event_info = wpautop(carbon_get_post_meta($event_id, 'event-info'));
$event_mini_info = wpautop(carbon_get_post_meta($event_id, 'event-mini-info'));

$event_organizer = carbon_get_post_meta($event_id, 'event-organizer');

$events_labels = carbon_get_post_meta($event_id, 'events-labels');

$event_phone = carbon_get_post_meta($event_id, 'event-phone');
$event_email = carbon_get_post_meta($event_id, 'event-email');
$event_vk = carbon_get_post_meta($event_id, 'event-vk');

$event_date_start = carbon_get_post_meta( $event_id, 'event-date-start' );
$event_time_start = carbon_get_post_meta($event_id, 'event-time-start');

$event_place = carbon_get_post_meta( $event_id, 'event-place' );
$event_ya_link = carbon_get_post_meta($event_id, 'event-ya-link');

?>


<!--Начало шаблона-->

<!--Внешний виджет-->

<?php foreach ($events_labels as $event) : ?>
                            
    <?php $event_filter_end = ($event_filter_end . ' ' . 'f-'.$event['label']); ?>

<?php endforeach; ?>


<a href="#popup_<?php echo get_the_title(); ?>" class="mix <?php echo $event_filter_end; ?> link block popup-link">

<div class="event_object search_object">

    <div class="item-master-class">

        <div class="item-event__content">

            <h2 class="item-event__title">

            <?php echo get_the_title(); ?>

            </h2>

            <div class="item-event__text">

            <?php echo $event_mini_info; ?>

            </div>



            <div class="item-events">

            <div class="item-event__text">Дата мероприятия:&nbsp;<span

                    class="event_date"><?php echo $event_date_start; ?></span></div>

            </div>

        </div>

        <div class="item-master-class__image">

            <img src="<?php echo $event_img_src; ?>" alt="">

        </div>

    </div>

</div>

</a>



<!--Модальное окно-->

<div id="popup_<?php echo get_the_title(); ?>" class="popup">

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

            <?php echo $event_info; ?>

            </div>



            <div style = "background: url(<?php echo wp_get_attachment_image_url($event_inside_img_src, 'full') ?>) center 10% / cover no-repeat;" class="popup__img"></div>

        </div>

        <div class="popup__info">

            <h2 class="popup__header">Организатор:</h2>



            <table cellspacing="0">

            <tr>

                <td class="leftcol"><i class="fa fa-user-circle-o" aria-hidden="true"></i></td>

                <td class="rightcol">

                    <div class="organizers"><?php echo $event_organizer; ?></div>

                </td>

            </tr>

            </table>



            <?php if ($event_phone or $event_email or $event_vk) : ?>

                <h2 class="popup__header">Контакты:</h2>

                <table cellspacing="0">
                <?php if ($event_phone) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-phone" aria-hidden="true"></td>

                    <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                            <div class="section-info"><?php echo $event_phone; ?></div>

                        </span></td>

                </tr>
                <?php endif; ?>
                <?php if ($event_email) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-envelope-o"></i></td>

                    <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                            <div class="section-info"><?php echo $event_email; ?></div>

                        </span></td>

                </tr>
                <?php endif; ?>
                <?php if ($event_vk) : ?>
                <tr>

                    <td class="leftcol"><i class="fa fa-solid fa-globe"></i></td>

                    <td class="rightcol"><a target="_blank" class="item-master-class__link"

                            href="<?php echo $event_vk; ?>">Вконтакте</a></td>

                </tr>
                <?php endif; ?>
                </table>

            <?php endif; ?>



            <h2 class="popup__header">Время:</h2>



            <table cellspacing="0" id="maket">

            <tr>

                <td class="leftcol"><i class="fa fa-calendar" aria-hidden="true"></i></td>

                <td class="rightcol">

                    <div class="section-info">Дата мероприятия:&nbsp;<span

                        class="event_date"><?php echo $event_date_start; ?></span></div>

                </td>

            </tr>

            <tr>

                <td class="leftcol"><i class="fa fa-clock-o" aria-hidden="true"></i></td>

                <td class="rightcol">

                    <div class="section-info">Начало в&nbsp;<span class="event_time"><?php echo $event_time_start; ?></span></div>

                </td>

            </tr>

            </table>

            <h2 class="popup__header">Адрес:</h2>

            <table cellspacing="0">

            <tr>

                <td class="leftcol"><i class="fa fa-bandcamp" aria-hidden="true"></i></td>

                <td class="rightcol"><span class="tooltip" data-title="Скопировать">

                        <div class="section-info"><?php echo $event_place; ?></div>

                    </span></td>

            </tr>
            <tr>
                <td class="leftcol"><i class="fa fa-location-arrow" aria-hidden="true"></i></td>
                
                <td class="rightcol">
                    
                    <a class="section-info" target="_blank" href="<?php echo $event_ya_link; ?>">Открыть в Яндекс.картах</a>

                </td>
            </tr>
            </table>

            &nbsp;
            <!--
            <div style="position:relative;overflow:hidden;"><a

                href="https://yandex.ru/maps/"

                style="color:#eee;font-size:12px;position:absolute;top:0px;">Северодвинск</a>
                
                <a href="https://yandex.ru/maps/10849/severodvinsk/house/sovetskaya_ulitsa_25/Z0AYfgRpTEcPQFhufXl3d39gYw==/?from=mapframe&ll=39.840301%2C64.565596&z=17"
                style="color:#eee;font-size:12px;position:absolute;top:14px;"><?php echo $event_place; ?> на

                карте Северодвинска — Яндекс Карты</a><iframe

                src="<?php echo $event_ya_link; ?>" width=100% height="400"

                frameborder="1" allowfullscreen="true" style="position:relative;" loading="lazy"></iframe></div>-->
            </div>
                


    </div>



</div>

</div>   

<!--Конец шаблона-->