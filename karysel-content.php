<?php 

$picture_id = get_the_ID();

$picture_img_src = get_the_post_thumbnail_url( $picture_id, 'full' );

?>

<div class="owl-slide">
    <img src="<?php echo $picture_img_src; ?>">
    <span href="" class="owl-slide-text">
        <?php echo get_the_title(); ?>
    </span>
</div>