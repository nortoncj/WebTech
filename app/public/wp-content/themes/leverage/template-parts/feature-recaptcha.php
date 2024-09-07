<?php
/**
 * @package Leverage
 */
?>

<?php 
$recaptcha = get_field( 'recaptcha', 'option' ); 

if ( $recaptcha && $recaptcha['enable_recaptcha'] ) {
    
    $recaptcha_site_key   = $recaptcha['recaptcha_site_key'];

    wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?render='.$recaptcha_site_key, array(), wp_get_theme()->get( 'Version' ) );
    
    $recaptcha_script = 'jQuery(function ($) { "use strict"; let siteKey = "'.$recaptcha_site_key.'"; if(siteKey) { $(\'input[name="reCAPTCHA"]\').attr("data-key", siteKey); grecaptcha.ready(function() { grecaptcha.execute(siteKey, { action: "create_comment" }).then(function(token) { $(\'input[name="reCAPTCHA"]\').val(token); }) }) } })';
    
    wp_add_inline_script('recaptcha', $recaptcha_script, 'after');
}