<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $zorka_data,$woocommerce_loop;

$archive_layout = isset($_GET['layout']) ? $_GET['layout'] : '' ;
$layouts = array('full-content','left-sidebar','right-sidebar');
if (!in_array($archive_layout,$layouts)) {

    $cat = get_queried_object();
    if ($cat && property_exists( $cat, 'term_id' )) {
        $archive_layout = g5plus_get_tax_meta($cat->term_id,'zorka_custom_product_archive_layout');
    }

    if (empty($archive_layout) || $archive_layout == 'none') {
        $archive_layout = $zorka_data['product-archive-layout'];
    }
}

$archive_product_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
if (!in_array($archive_product_columns,array('2','3','4'))) {
    $archive_product_columns = isset($zorka_data['archive-product-columns']) ? $zorka_data['archive-product-columns'] : 3;
}

$class_col = 'col-md-12';

if ($archive_layout == 'left-sidebar' || $archive_layout == 'right-sidebar' ){
    $class_col = 'col-md-9';
}
if ($archive_layout == 'left-sidebar') {
    $class_col .= ' col-md-push-3';
}
get_header();
?>
<?php get_template_part('archive-product','top') ?>
<main role="main" class="site-content-product-archive">
    <div class="container clearfix">
        <?php
            /**
             * woocommerce_archive_description hook.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
        ?>
        <div class="row clearfix">
            <div class="<?php echo esc_attr($class_col); ?>">
                <div class="product-wrapper clearfix">

                    <?php

                    if ( have_posts() ) {
                    echo '<div class="category-filter clearfix">';
                        /**
                         * Hook: woocommerce_before_shop_loop.
                         *
                         * @hooked wc_print_notices - 10
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                    echo '</div>';
                        $woocommerce_loop['columns'] = $archive_product_columns;

                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 *
                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                 */
                                do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    } else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action( 'woocommerce_no_products_found' );
                    }?>
                </div>
            </div>
            <?php
            if ($archive_layout == 'left-sidebar') {
                get_sidebar('shop-left');
            }
            if ($archive_layout == 'right-sidebar') {
                get_sidebar('shop');
            }
            ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>









