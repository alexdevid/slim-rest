<?php
/**
 * Created by PhpStorm.
 * User: devid
 * Date: 06.09.15
 * Time: 14:34
 */

namespace Controllers;

use Components\Controller;


class DefaultController extends Controller {

    public function homepage() {
        $this->getKernel()->app->render('homepage.php');
    }
}