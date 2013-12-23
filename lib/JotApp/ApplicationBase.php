<?php

namespace JotApp;

class ApplicationBase {
    private static $INSTANCE;

    protected $config;
    protected $appModel;
    protected $controllers;
    protected $dataSources;

    private $controllerCache = array();
    private $dataSourceCache = array();

    protected function __construct() {
        //$this->_initAppModel();
    }

    public static function getInstance() {
        if (empty(self::$INSTANCE)) {
            $className = get_called_class();
            self::$INSTANCE = new $className();
        }

        return self::$INSTANCE;
    }


    public function getAppModel() {
        $appModel = $this->_initAppModel();
        return $appModel;
    }


    public function getController($controllerName) {
        if (empty($this->controllerCache[$controllerName])) {
            $className = $this->controllers[$controllerName];

            if (class_exists($className)) {
                $controllerClass = new $className();

                if (is_a($controllerClass, 'JotApp\Controller')) {
                    $this->_injectController($controllerClass);
                    $this->controllerCache[$controllerName] = $controllerClass;
                }

            }
        }

        return $this->controllerCache[$controllerName];
    }


    public function setConfig($config) {
        $this->config = $config;
    }

    public function getDomain() {
        return $this->config->domain;
    }

    public function getFacebookAppId() {
        return $this->config->facebookAppId;
    }



    protected function _initAppModel() {
        if (empty($this->appModel)) {
            if (!empty($this->appModelClass) && class_exists($this->appModelClass)) {
                $className = $this->appModelClass;
                $appModel = new $className();
                $appModel->addDataSource($this->config->datasources['__DEFAULT__']);
                $this->appModel = $appModel;
            }
        }

        return $this->appModel;
    }


}

?>
