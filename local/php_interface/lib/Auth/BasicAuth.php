<?php

namespace Auth;

use Helpers\ArrayHelper;

class BasicAuth
{
    public static function check()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            global $USER;
            if (!is_object($USER))
                $USER = new \CUser;
            $result = $USER->Login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], "N");
            if( $result['TYPE']=="ERROR" ) {
                return ['success' => false, 'errors' => implode(', ', array_diff(explode('.<br>', $result['MESSAGE']), ['']))];
            } else {
                return ['success' => true];
            }
        }
        return ['success' => false, 'errors' => ["Логин или пароль не заполнены. Проверьте данные вводимые вами"]];
    }
}