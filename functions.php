<?php
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles', 1000 );
function child_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'zorka_style-min' ) );
}

// if you want to add some custom function
// display an 'Out of Stock' label on archive pages
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10 );
function woocommerce_template_loop_stock() {
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() )
        echo '<p class="stock out-of-stock">Out of Stock</p>';
}
?>
