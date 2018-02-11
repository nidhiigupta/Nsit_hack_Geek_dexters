<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* Custom constants */
/* NOTE: Please add a trailing slash here and use it as CONSTANT.'folder' without a slash at starting. */
define('SITEURL' , 'http://'.$_SERVER['HTTP_HOST'].'/');
define('ASSETS' , 'http://'.$_SERVER['HTTP_HOST'].'/assets/');


//DATABASE CREDENTIALS
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME' , 'webassnp_new');
define('DB_PASSWORD' , '0dZwgKTb6&Td');
define('DB_DATABASE' , 'webassnp_webassets_new');


//Social Media key
define('MIN_MATCH_PERCENT' , '75');
# Facebook Constants
define('FB_API_VERSION', 'v2.10');
//if(SITEURL == 'http://whyral.in/') {
define('FB_APP_ID' , '460531114323275');
define('FB_APP_SECRET' , 'deb28650d50c3f7527b3be37c3399b54');
define('FB_ACCESS_TOKEN', 'EAAGi2cF6LUsBACXZCkwXjtryfqmZARWJPZBMoazKrFvn9bTBaiwVwSalhqAFIxzbI695ApYcfDGv4TJRlzYjwX6TUdKWek7fqlZCsJgFlKwprEXfQCnCaC6oTgMSkBGZBITICWNAwofC26AI7VXGemMZAhaGg1b9oOA3li49gqGR3PmcGfHpS0');
/*}
else {
define('FB_APP_ID' , '1996606623902064');
define('FB_APP_SECRET' , 'ac419fe2dddc7dae772fc7990d9b9cd2');
define('FB_ACCESS_TOKEN', 'EAAcX5zSS6XABACMNWO0ZBisDvlza8HsIVgSwvidLgHoTP357VzfJiMb2QL2YszMso8xgBewQIFayMyj6M7UqY0bRpImFNZCJKbLe5BefRXSEjz2c8OuzCCTodBwVTqIcqZCFZCYDp8ZBu0bEGhZB4zuHeMckvskNljPtHWf5ENzwZDZD');
}*/
# Twitter Constants
define('TWITTER_CONSUMER_KEY', 'yRWHtFr3I0DCOBj7QPvjjGp9c');
define('TWITTER_CONSUMER_SECRET', 'OiFvaKBFCN1SyOeWwCdk9eRaePL4UNvHfQePgoXnUEwmu9Mjef');
define('TWITTER_ACCESS_TOKEN', '885788205877997568-tIAMUIAvXb5g6iMvMAunASWZ25jlc2B');
define('TWITTER_ACCESS_TOKEN_SECRET', 'H7Q4SyP6GqvIdxOyZAsSWOo3VXfMkin5SHC9PNUZtt453');
define('TWITTER_API_HOST', 'https://api.twitter.com/1.1/');
# Google Constants
//NOTE: Google API CLient ID and secret are in a JSON file located at /application/config/google_client_secret.json
# Instagram Constants
define('INSTAGRAM_CLIENT_ID', '6f5eb1cc96f54f969a0d26960efb39fb');
define('INSTAGRAM_CLIENT_SECRET', '9d50d0c98d6742479860911996a81646');
#Clickmeter Constants
define('CLICKMETER_API_KEY', '4F8C714C-F9AB-48FC-B577-3DCCA2275135');
#Paypal Constants
define('PAYPAL_CLIENT_ID', 'AQ25Kagv_-yJBBEZ0fcqg3wdTXsMtOVFdV6B4b-JYtLDJOnaH0heJ6t7waHduNZbDUOpRAJX6ij1QJDF');
define('PAYPAL_SECRET_ID', 'ELl-LybU5hBxT1fU0LURWHgAHYNAr4bao_sYzwWHiJzokZuwJmrVg2bFAKaQaEQa3wdHHl4hvcskbct2');
#Payumoney
define('PAYU_MERCHANT_KEY', 'JXr6xwE0');
define('PAYU_SALT', 'zhS6WBloRj');
#LinkedIn
define('LINKEDIN_CLIENT_ID', '86dsanrpl7nd2m');
define('LINKEDIN_CLIENT_SECRET', 'jrRKaH5nWeqb6YOX');
?>
