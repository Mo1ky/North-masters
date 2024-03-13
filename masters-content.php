<?php 

$master_id = get_the_ID();


$master_gallery = carbon_get_post_meta($master_id, 'master-gallery');
$master_phone = carbon_get_post_meta($master_id, 'master-phone');
$master_email = carbon_get_post_meta($master_id, 'master-email');
$master_vk = carbon_get_post_meta($master_id, 'master-vk');
$master_info = wpautop(carbon_get_post_meta($master_id, 'master-info'));
$master_top = carbon_get_post_meta($master_id, 'master-top');
$master_img_src = get_the_post_thumbnail_url( $master_id, 'full' );
$master_top_label = carbon_get_post_meta($master_id, 'master-top-label');

?>

<a href="#popup-<?php echo get_the_title(); ?>" style = "background: url(<?php echo $master_img_src; ?>) center 10% / cover no-repeat;" class="block <?php echo $master_top_label; ?> mix popup-link">
    <h2 class="block__title"><?php echo get_the_title(); ?></h2>

    <div class="block__info">
        <p>Направление: <span><?php echo $master_top; ?></span></p>
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
                    
                <?php echo $master_info; ?>
                
                </div>
                <div class="popup__img" style = "background: url(<?php echo $master_img_src; ?>) center 10% / cover no-repeat;">

                </div>
            </div>
            <?php if ($master_phone or $master_email or $master_vk) : ?>
                <div class="popup__info">
                    <h2 class="popup__header">Контакты:</h2>

                    <table cellspacing="0">
                        <?php if ($master_phone) : ?>
                        <tr>
                            <td class="leftcol"><i class="fa fa-phone" aria-hidden="true"></td>
                            <td class="rightcol"><span class="tooltip" data-title="Скопировать">
                                    <div class="section-info"><?php echo $master_phone; ?></div>
                                </span></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($master_email) : ?>
                        <tr>
                            <td class="leftcol"><i class="fa fa-envelope-o"></i></td>
                            <td class="rightcol"><span class="tooltip" data-title="Скопировать">
                                    <div class="section-info"><?php echo $master_email; ?></div>
                                </span></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($master_vk) : ?>
                        <tr>
                            <td class="leftcol"><i class="fa fa-solid fa-globe"></i></td>
                            <td class="rightcol"><a target="_blank" class="item-master-class__link"
                                    href="<?php echo $master_vk; ?>">Вконтакте</a></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            <?php endif; ?>
            <div class="popup__info">
                <h2 class="popup__header">Направление:</h2>
                <table cellspacing="0">
                    <tr>
                        <td class="leftcol"><i class="fa fa-cubes" aria-hidden="true"></i></td>
                        <td class="rightcol">
                            <a class="item-master-class__link" data-modal="popup-<?php echo $master_top_label ?>"  href=".http://severmasters.ru.xsph.ru/crafts/" target="_self"><?php echo $master_top; ?></a> 
                            
                        </td>
                    </tr>
                </table>
            </div>

            <div class="popup__footer">
                <?php if ($master_gallery) : ?>
                    <h2 class="popup__header">Работы мастера:</h2>
                    <div id="lightgallery<?php echo $master_id; ?>" class="gallery-light">
                        <?php foreach ($master_gallery as $attribute) : ?> 
                                <a class="lightgallery__item" href="<?php echo wp_get_attachment_image_url($attribute['master-gallery-photo'], 'full'); ?>">
                                    <img loading="lazy" alt="<?php echo $master_top; ?>" src="<?php echo wp_get_attachment_image_url($attribute['master-gallery-photo'], 'full') ?>">
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
