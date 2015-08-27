<?php
/**
 * Created by PhpStorm.
 * User: devid
 * Date: 26.08.15
 * Time: 11:59
 */

namespace Controllers;


class Controller implements ControllerInterface {

    /**
     * @param array $data
     */
    public function response(array $data) {
        $this->getKernel()->app->contentType("application/json");
        echo json_encode($data);
        $this->getKernel()->app->stop();
    }

    /**
     * @param string $key
     * @return array|mixed|null
     */
    public function getRequestData($key = NULL) {
        $request = $this->getKernel()->app->request();

        if ($request->isPost()) {
            return $request->post($key);
        }
        if ($request->isPatch()) {
            return $request->patch($key);
        }
        if ($request->isPut()) {
            return $request->put($key);
        }

        return NULL;
    }

    /**
     * @return \Kernel
     */
    public function getKernel() {
        return \Kernel::getInstance();
    }
}