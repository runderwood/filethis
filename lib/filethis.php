<?php
class Filethis {

    public static $libdir;
    public static $datdir;
    public static $confdir;
    protected static $_config;

    public static function autoload($cls) {
        $p = join('/', explode('_', strtolower($cls)));
        $p = self::$libdir.$p.'.php';
        $loaded = false;
        if(file_exists($p)) {
            $loaded = include($p);
        }
        return $loaded;
    }

    public function load_conf($grp) {
        $p = self::$confdir.$grp.'.php';
        self::$_config[$grp] = (object)@include($p);
        return self::$_config[$grp];
    }

    public function conf($grp,$k=null) {
        if(isset(self::$_config[$grp])) {
            if($k !== null && isset(self::$_config[$grp]->$k)) {
                return self::$_config[$grp]->$k;
            } else {
                return self::$_config[$grp];
            }
        }
        return null;
    }

    public function init() {

        spl_autoload_register(array(__CLASS__, 'autoload'));

        self::$libdir = FILETHIS_LIBDIR;
        self::$datdir = FILETHIS_DATDIR;
        self::$confdir = FILETHIS_CONFDIR;

        self::load_conf('filethis');
        if(self::conf('filethis','data_dir')) {
            self::$datdir = self::conf('filethis','data_dir');
        }

        self::load_conf('db');

        $dbconf = self::conf('db');
        if(!$dbconf) throw new Exception('DB not configured.');

        $dsn = sprintf('pgsql:host=%s;dbname=%s;user=%s;password=%s', 
            $dbconf->host, $dbconf->name, $dbconf->user, $dbconf->password
        );
        Rudb::connect($dsn);

        self::load_conf('twilio');
    }

    public static function go() {
        try {
            Glue::stick(array(
                '/' => 'filethis_handler_main'
            ));
        } catch(Exception $e) {
            header('HTTP/1.1 404 Not Found');
            die($e->getMessage());
        }
    }
}
