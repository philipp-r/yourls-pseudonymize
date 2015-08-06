<?php
/*
Plugin Name: Pseudonymize Plugin
Plugin URI: http://github.com/philipp-r/yourls-pseudonymize
Description: Pseudonymize IP addresses (remove last 2 segment). Supports IPv4 and IPv6.
Version: 2
Author: Philipp
Author URI: http://github.com/philipp-r/
 */
/* Forked from:
Author: Ubicoo
Author URI: http://www.ubicoo.com
*/

yourls_add_filter( 'get_IP', 'ubicoo_pseudonymize_IP' );

function ubicoo_pseudonymize_IP( $ip ) {
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $segments = explode(":", $ip);
        $segments[count($segments)-1] = 0;
        $segments[count($segments)-2] = 0;

        $pseudo_IP = implode(":", $segments);

        # FIXME: also handle IPv4 addresses at the end of IPv6, like ::ffff:127.0.0.1
        
    } elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $segments = explode(".", $ip);
        $segments[3] = 0;
        $segments[2] = 0;

        $pseudo_IP = implode(".", $segments);
    } else {
        $pseudo_IP = $ip;
    }

    return $pseudo_IP;
}

