<?php

namespace JotApp;

class Controller {
    protected $appModel;


    public function __construct($appModel) {
        $this->appModel = $appModel;
    }
}

?>
