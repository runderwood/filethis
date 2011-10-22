<?php

if(getenv('FILETHIS_LIBDIR')) {
    define('FILETHIS_LIBDIR', rtrim(getenv('FILETHIS_LIBDIR'), '/'));
} else {
    define('FILETHIS_LIBDIR', dirname(dirname(__FILE__)).'/lib/');
}

if(getenv('FILETHIS_DATDIR')) {
    define('FILETHIS_DATDIR', rtrim(getenv('FILETHIS_DATDIR'), '/'));
} else {
    define('FILETHIS_DATDIR', dirname(dirname(__FILE__)).'/dat/');
}

if(getenv('FILETHIS_CONFDIR')) {
    define('FILETHIS_CONFDIR', rtrim(getenv('FILETHIS_CONFDIR'), '/'));
} else {
    define('FILETHIS_CONFDIR', dirname(dirname(__FILE__)).'/conf/');
}

require_once(FILETHIS_LIBDIR.'filethis.php');
Filethis::init();
Filethis::go();
