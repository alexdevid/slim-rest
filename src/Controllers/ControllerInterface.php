<?php
/**
 * Created by PhpStorm.
 * User: devid
 * Date: 26.08.15
 * Time: 12:25
 */

namespace Controllers;


interface ControllerInterface {
    public function response(array $data);

    public function getKernel();

    public function getRequestData();
}