<?php

$top_id = get_the_ID();

$top_gallery = carbon_get_post_meta($top_id, 'top-gallery');
$top_info = wpautop(carbon_get_post_meta($top_id, 'top-info'));
$top_img_src = get_the_post_thumbnail_url( $top_id, 'full' );
$top_label = carbon_get_post_meta($top_id, 'top-label');
$top_filters = carbon_get_post_meta(29, 'top-filters');
$top_masters = carbon_get_post_meta($top_id, 'top-masters');

?>

<?php if ($top_filters) : ?>
    
    <?php foreach ($top_filters as $filter) : ?>
        <?php $tops_in_filter = $filter['tops-in-filters']; ?>
        
        
        <?php foreach ($tops_in_filter as $attribute) : ?>
            
            <?php if ($attribute['top-in-filter'] == $top_label) : ?>
                
                
                <?php $top_filter = ($top_filter . ' ' . 'f-'.$filter['label']); ?>
                                
                
            <?php endif; ?>
        <?php endforeach; ?>
        
        
    <?php endforeach; ?>
    
<?php endif; ?>

<a href="#popup-<?php echo $top_label; ?>" style = "background: url(<?php echo $top_img_src; ?>) center 10% / cover no-repeat;" class="types__block block <?php echo $top_filter; ?> mix popup-link">
    <h2 class="block__title"><?php echo get_the_title(); ?></h2>
</a>
<div id="popup-<?php echo $top_label; ?>" class="popup">
    <div class="popup__body">
        <div class="popup__content">
            <div class="popup__header">
                <h1 class="popup__title"><?php echo get_the_title(); ?></h1>
                <a href="#" class="popup__close close-popup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/cross.svg" alt="Закрыть модальное окно">
                </a>
            </div>
            <div class="popup__info">

            <?php echo  $top_info; ?>

            </div>



            <?php if ($top_masters) : ?>
            <div class="popup__info">
                <h2 class="popup__header">Мастера:</h2>
                <table cellspacing="0">
                <?php foreach ($top_masters as $attribute) : ?> 
                    <tr>
                        <td class="leftcol"><i class="fa fa-user" aria-hidden="true"></i></td>

                        <td class="rightcol">
                        
                            <a class="item-master-class__link"  href=".http://severmasters.ru.xsph.ru/masters/" target="_self"  data-modal="popup-<?php echo $attribute['master']; ?>"><?php echo $attribute['master']; ?></a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>


            
            <div class="popup__footer">
            <?php if ($top_gallery) : ?>
                    <h2 class="popup__header">Галерея примеров:</h2>
                    <div id="lightgallery<?php echo $top_id; ?>" class="gallery-light">
                        <?php foreach ($top_gallery as $attribute) : ?>                                 
                                <a class="lightgallery__item" href="<?php echo wp_get_attachment_image_url($attribute['top-gallery-photo'], 'full'); ?>">
                                    <img loading="lazy" alt="<?php echo get_the_title(); ?>" src="<?php echo wp_get_attachment_image_url($attribute['top-gallery-photo'], 'full') ?>">
                                </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
            </div>
        
        </div>
    </div>
</div>