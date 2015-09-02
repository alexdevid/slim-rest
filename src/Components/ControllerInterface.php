<?php
namespace Components;


interface ControllerInterface {
    public function response(array $data);

    public function redirect($url);

    public function getKernel();

    public function getRequestData();
}