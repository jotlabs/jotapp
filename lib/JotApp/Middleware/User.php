<?php

namespace JotApp\Middleware;

use Slim\Middleware;
use JotApp\ApplicationBase;

class User extends Middleware {
    public function call() {
        $slim = $this->app;

        $sessionId = $slim->getCookie('jot-id');
        //$sessionId = '2fd91d4ddb0f81dc337d2d5b0392d3ad';

        if ($sessionId) {
            //echo "[$sessionId]";
            $env  = $slim->environment();
            $app  = ApplicationBase::getInstance();
            $user = $app->getAppModel()->getUserBySessionId($sessionId);

            if (!empty($user)) {
                //echo '<pre>'; print_r($user); echo '</pre>'; 
                $env['jotapp.user'] = $user;
            }

        }

        $this->next->call();
    }
}

?>
