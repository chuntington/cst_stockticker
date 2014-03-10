<?php
	/*
	 * Plugin Name: GPS Stock Ticker
	 * Description: Custom stock ticker for GPS. Uses shortcode [stockticker stocks='item item item'].
	 * Version: 0.5
	 * Author: Cameron Huntington
	 * Author URI: http://gradientps.com
	 */

//Add scripts
add_action('wp_enqueue_scripts', 'cst_scripts');

function cst_scripts() {
    wp_enqueue_style('stock-style', plugins_url('lib/css/stock-style.css', __FILE__));
    wp_enqueue_style('scroll-style', plugins_url('lib/css/scroll-style.css', __FILE__));
    wp_enqueue_script('cst-stocks', plugins_url('lib/js/cst-stocks.js', __FILE__), array('jquery'));
    wp_enqueue_script('cst-stocks-init', plugins_url('lib/js/cst-stocks-init.js', __FILE__), array('jquery'));
    wp_register_script('scroll', plugins_url('lib/js/scroll.js', __FILE__), array('jquery'));
    wp_register_script('fade', plugins_url('lib/js/fade.js', __FILE__), array('jquery'));
}


//Add Shortcode
add_filter('widget_text', 'do_shortcode');
add_filter( 'widget_text', 'shortcode_unautop');
add_shortcode('stockticker', 'cst_shortcode');

function cst_shortcode($atts) {
	extract(shortcode_atts(array(
        'stocks' => '',
        'display' => false,
    ), $atts));

    wp_enqueue_script('cst-stocks-init');

	return '<div class="stockContainer" data-array="' . esc_attr($stocks) . '" data-display="' . esc_attr($display) . '"><ul class="stockTick" id="scroller"></ul></div>';
}

//Add widget
require_once('lib/cst-widget.php');


//Create admin menu
add_action('admin_menu', 'cst_create_menu');

function cst_create_menu() {
    add_options_page('GPS Stock Ticker', 'GPS Stock Ticker', 'administrator', 'cst', 'cst_options_page');
}


//Register settings
add_action('admin_init', 'register_cst_settings');

function register_cst_settings() {
    register_setting('cst_options', 'cst_options');
    add_settings_section('cst_checkboxes', false, false, 'cst');

    require_once('lib/cst-stocklist.php'); //Get the stock listing array

    foreach ($stockarray as $key => $value) {
        add_settings_field($value, $key, 'cst_stock_callback', 'cst', 'cst_checkboxes', 
            array('symbol' => $key, 'code' => $value)
        );
    }
}


//Settings callback
function cst_stock_callback($args) {
    $options = get_option('cst_options');
    $sym = $args['symbol'];
    $code = $args['code'];
    echo '<input type="checkbox" id="'.$sym.'" name="cst_options['.$sym.']" value="'.$code.'"' . checked( $code, $options[$sym], false ) . '/>';
}


//Settings page
function cst_options_page() {
?>

<div class="wrap">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Example Shortcode:</th>
            <td>[stockticker stocks='NYSE:UPS INDEXDJX:DJI NYSE:AIR etc.']</td>
        </tr>
        <tr valign="top">
            <th scope="row">Where to find stock extensions:</th>
            <td><a href="https://www.google.com/finance" target="_blank">https://www.google.com/finance</a></td>
            <td>Search for the stock you're looking for, then copy the acronym (complete with prefixes INDEX:, NYSE:, etc.) found in the search bar (or directly below) into the stockticker shortcode.</td>
        </tr>
        <tr valign="top">
            <th scope="row">Try your own stock symbol:</th>
            <td><input id="symbol" type="text" placeholder=".DJI, NYSE:UPS, etc."></td>
            <td id="result"></td>
        </tr>
        <tr valign="top">
            <th scope="row">Your Current Shortcode:</th>
            <td width="38%" style="color:green;">[stockticker stocks='<span id="receive-checked">
                <?php 
                    foreach (get_option('cst_options') as $key => $value) { echo $value.' '; }
                ?>
            </span>']</td>
            <td>Copy this and use it as your new shortcode! You can save your current shortcode by hitting 'Submit' at the bottom of the page.</td>
        </tr>
    </table>

    <form method="post" action="options.php">
        <?php do_settings_sections('cst'); ?>
        <?php settings_fields('cst_options'); ?>
        <?php submit_button('Save Shortcode'); ?>
    </form>
</div>


<!--AJAX for the input box and result text appension on settings page-->
<script>
jQuery(function($) {
    $('#symbol').on('keyup', function(event) {
        event.preventDefault();
        var response = false;
        $.getJSON('https://finance.google.com/finance/info?client=ig&q=' + $('#symbol').val() + '&callback=?', function(response) {
                var stockInfo = response[0];
            }
        ).done(function() {$('#result').text('Works!').css({'color': 'green'});})

        if (!response) {
            $('#result').text('No result.').css({'color': 'red'});
        }
    });

    function getChecked() {
        $('#receive-checked').empty();
        $('input:checked').each(function() {
            $('#receive-checked').append($(this).val() + ' ');
        });
    }

    $('input:checkbox').on('click', function() {
        getChecked();
    });
});
</script>

<?php } ?>