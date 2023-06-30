<?php 

namespace App;

class Singleton {
    final public static function get_instance() {
        static $instances = [];
        $called_class = get_called_class();
        if(! isset($instances[ $called_class ]) ) {
            $instances[ $called_class ] = new $called_class();

        }
        return $instances[ $called_class ];
    }
}


?>