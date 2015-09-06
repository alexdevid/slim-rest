<?php
namespace Components;


class Controller implements ControllerInterface {

    public $isPublic = false;

    /**
     * @param array $data
     * @param integer $status
     * @return string
     */
    public function response(array $data, $status = 200) {
        $this->getKernel()->app->response()->setStatus($status);
        $this->getKernel()->app->contentType("application/json");
        return json_encode($data);
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