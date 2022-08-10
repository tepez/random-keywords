<?php
/*
Plugin Name: Random Keywords
Plugin URI: http://yourls.org/
Description: Assign random keywords to shorturls, like bitly (sho.rt/hJudjK)
Version: 1.1
Author: Tom Yam
Author URI: https://github.com/tomyam1
*/

/* Release History:
*
* 1.0 Initial release
* 1.1 Added: don't increment sequential keyword counter & save one SQL query
* Fixed: plugin now complies to character set defined in config.php
*/

global $ozh_random_keyword;

/*
* CONFIG: EDIT THIS
*/

// Length of random keyword
$ozh_random_keyword['length'] = 5;

// The characters set type
// Changes the random key generation of yourls yo use just 23456789bcdfghjkmnpqrstvwxyz characters.
// (no vowels to make no offending word, no 0/1/o/l to avoid confusion between letters & digits)
// https://github.com/YOURLS/YOURLS/blob/1.9.1/includes/functions.php#L715

$ozh_random_keyword['type'] = '1';

/*
* DO NOT EDIT FARTHER
*/

// Generate a random keyword
yourls_add_filter( 'random_keyword', 'ozh_random_keyword' );
function ozh_random_keyword() {
        global $ozh_random_keyword;
        return yourls_rnd_string( $ozh_random_keyword['length'], $ozh_random_keyword['type'] );
}

// Don't increment sequential keyword tracker
yourls_add_filter( 'get_next_decimal', 'ozh_random_keyword_next_decimal' );
function ozh_random_keyword_next_decimal( $next ) {
        return ( $next - 1 );
}
