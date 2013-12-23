<?php

namespace JotApp;

class Controller {
    protected $appModel;

    public function __construct() {}

    public function setAppModel($appModel) {
        $this->appModel = $appModel;
    }

}

?>
