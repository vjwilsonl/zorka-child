<?php
global $zorka_data;
$cat = get_queried_object();
$page_sub_title = '';

if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_background_arr = get_term_meta($cat->term_id,'zorka_custom_page_title_background');
    if (is_array($page_title_background_arr) && count($page_title_background_arr )) {
        $page_title_background = $page_title_background_arr[0]['url'];
    }
    $page_sub_title =  strip_tags(term_description());
}

if (empty($page_title_background)) {
    //$page_title_background = $zorka_data['shop-page-title-background'];
    if (!get_queried_object_id()) {
        $page_title_background = get_the_post_thumbnail_url("135"); // hardcode to find SHOP page
    } else {
        $page_title_background = get_the_post_thumbnail_url($cat->ID);
    }
}

$class = array();

$class[] = 'page-title-wrapper page-title-shop-wrapper';
$custom_style = '';
if (!empty($page_title_background)) {
    $class[] = 'dark';
    $class[] = 'page-title-image';
    $custom_style = 'style="background-image: url('.$page_title_background.');"';
}
/*else {
    $class[] = 'border-bottom';
}*/

$class_name = join(' ',$class);
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

<section class="<?php echo esc_attr($class_name) ?>"  <?php echo wp_kses_post($custom_style); ?>>

        <div class="page-title-inner">
            <div class="container">
                <h1 class="shop-custom-header"><?php woocommerce_page_title(); ?></h1>
                <?php if (!empty($page_sub_title)) : ?>
                    <span><?php echo esc_html($page_sub_title);?></span>
                <?php endif; ?>
            </div>
        </div>
	<link rel="stylesheet" id="g5plus-google-fonts-css" href="https://fonts.googleapis.com/css?family=Lato%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CMontserrat%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CLato%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CLobster+Two%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CLato%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CMontserrat%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic%7CLato%3A100%2C300%2C400%2C600%2C700%2C900%2C100italic%2C300italic%2C400italic%2C600italic%2C700italic%2C900italic&amp;ver=4.9.5" type="text/css" media="all">
</section>
<?php endif; ?>




