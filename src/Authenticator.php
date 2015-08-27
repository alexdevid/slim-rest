<?php

/**
 * Created by PhpStorm.
 * User: devid
 * Date: 26.08.15
 * Time: 15:39
 */
class Authenticator {

    const KEY_NAME_DEFAULT = 'key';
    const KEY_SECRET_DEFAULT = 'keysecret';

    private $keyName;
    private $keySecret;

    public function __construct(array $securityConfig) {
        $this->keyName = isset($securityConfig['key_name']) ? $securityConfig['key_name'] : self::KEY_NAME_DEFAULT;
        $this->keySecret = isset($securityConfig['key_value']) ? $securityConfig['key_value'] : self::KEY_SECRET_DEFAULT;
    }

    public function authorize() {
        $authKey = Kernel::getInstance()->app->request()->get($this->keyName);
        if ($authKey) {
            if ($authKey == $this->keySecret) {
                return true;
            } else {
                throw new \Exception('Access forbidden', 403);
            }
        }
        throw new \Exception('Unauthorized', 401);
    }
}