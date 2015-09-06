<?php
namespace Controllers;

use OAuth2\Request;
use OAuth2\Response;
use Components\Controller;

class AuthController extends Controller {

    public $isPublic = true;

    /**
     * @throws \Slim\Exception\Stop
     */
    public function authorize() {
        $request = Request::createFromGlobals();
        $response = new Response();

        if (!$this->getKernel()->oauth->validateAuthorizeRequest($request, $response)) {
            $response->send();
            $this->getKernel()->app->stop();
        }
        $this->getKernel()->app->render('auth_form.php');
    }

    /**
     *
     */
    public function getCode() {
        $request = Request::createFromGlobals();
        $response = new Response();
        $is_authorized = ($this->getKernel()->app->request()->post('authorized') === 'yes');
        $this->getKernel()->oauth->handleAuthorizeRequest($request, $response, $is_authorized);
        if ($is_authorized) {
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=') + 5, 40);
            var_dump($code); die();
            $this->response(['success' => true, 'code' => $code]);
        }
        $response->send();
    }

    /**
     *
     */
    public function token() {
        $this->getKernel()->oauth->handleTokenRequest(Request::createFromGlobals())->send();
    }
}