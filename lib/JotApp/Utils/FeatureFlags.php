<?php

namespace JotApp\Utils;

class FeatureFlags {
    private static $INSTANCE;

    protected $env      = NULL;
    protected $flags    = array();
    protected $envFlags = array();

    protected function __construct($env=NULL) {
        if($env) {
            $this->setEnv($env);
        }
    }

    public function setEnv($env) {
        $this->env = $env;
        if (!$empty($this->envFlags[$env])) {
            $this->flags = $this->envFlags[$env];
        }
    }

    public static function getInstance($env=NULL) {
        if (empty(self::$INSTANCE)) {
            $className = get_called_class();
            self::$INSTANCE = new $className($env);
        }
        return self::$INSTANCE;
    }

    public function __get($flag) {
        $value = NULL;

        if (array_key_exists($flag, $this->flags)) {
            $value = $this->flags[$flag];
        }
        
        return $value;
    }
    
    public function __isset($flag) {
        return array_key_exists($flag, $this->flags);
    }

}

?>
