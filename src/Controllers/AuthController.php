<?php
namespace Controllers;

use OAuth2\Request;
use OAuth2\Response;
use Components\Controller;

class AuthController extends Controller {

    /**
     * @throws \Slim\Exception\Stop
     */
    public function getAuthorize() {
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
    public function postAuthorize() {
        $request = Request::createFromGlobals();
        $response = new Response();
        $is_authorized = ($this->getKernel()->app->request()->post('authorized') === 'yes');
        $this->getKernel()->oauth->handleAuthorizeRequest($request, $response, $is_authorized);
        if ($is_authorized) {
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=') + 5, 40);
            $this->response(['success' => true, 'code' => $code]);
        }
        $response->send();
    }

    /**
     *
     */
    public function postToken() {
        $this->getKernel()->oauth->handleTokenRequest(Request::createFromGlobals())->send();
    }

    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     */
    public function getRegister($client_id, $client_secret, $redirect_uri = '/') {
        $storage = $this->getKernel()->oauth->getStorage('user_credentials');
        $storage->setClientDetails($client_id, $client_secret, $redirect_uri);
        $this->redirect('/authorize?client_id=' . $client_id . '&response_type=code&state=xz');
    }
}