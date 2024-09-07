<?php
/**
 * @package Leverage
 */
?>

<?php 
$cookie_notice = get_field( 'cookie_notice', 'option' ); 

if ( $cookie_notice && $cookie_notice['enable_cookie_notice'] ) {

    $cookie_description      = $cookie_notice['cookie_description'];

    $statement_url           = $cookie_notice['statement_url'];
    $statement_label         = $cookie_notice['statement_label'];
    $accept_label            = $cookie_notice['accept_label'];
    $settings_label          = $cookie_notice['settings_label'];
    $save_label              = $cookie_notice['save_label'];

    $essential_info          = $cookie_notice['essential_info'];
    $essential_title         = $cookie_notice['essential_title'];
    $essential_description   = $cookie_notice['essential_description'];
    $analytics_title         = $cookie_notice['analytics_title'];
    $analytics_description   = $cookie_notice['analytics_description'];
    $performance_title       = $cookie_notice['performance_title'];
    $performance_description = $cookie_notice['performance_description'];
    $marketing_title         = $cookie_notice['marketing_title'];
    $marketing_description   = $cookie_notice['marketing_description'];

    $cookie_notice_script = 'let cookieNotice=!0;cookieNotice&&(gdprCookieNoticeLocales.en={description:"'.$cookie_description.'",settings:"'.$settings_label.'",accept:"'.$accept_label.'",statement:"'.$statement_label.'",save:"'.$save_label.'",always_on:"'.$essential_info.'",cookie_essential_title:"'.$essential_title.'",cookie_essential_desc:"'.$essential_description.'",cookie_performance_title:"'.$analytics_title.'",cookie_performance_desc:"'.$analytics_description.'",cookie_analytics_title:"'.$performance_title.'",cookie_analytics_desc:"'.$performance_description.'",cookie_marketing_title:"'.$marketing_title.'",cookie_marketing_desc:"'.$marketing_description.'"},statement_url="'.$statement_url.'",gdprCookieNotice({locale:"en",timeout:2000,expiration:30,domain:window.location.hostname,implicit:0,statement:statement_url,performance:["JSESSIONID"],analytics:["ga"],marketing:["SSID"]}));';

	wp_add_inline_script('main', $cookie_notice_script, 'after');
}