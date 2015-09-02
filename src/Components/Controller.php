<?php
namespace Components;


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
     * @param string $url
     */
    public function redirect($url) {
        return $this->getKernel()->app->redirect($url);
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