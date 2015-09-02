<?php
namespace Components;

use Models\ClientQuery;
use Models\CodeQuery;
use Models\TokenQuery;
use Models\Token;
use Models\Code;
use OAuth2\Storage\AccessTokenInterface;
use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\AuthorizationCodeInterface;

class PropelStorage implements AccessTokenInterface, ClientCredentialsInterface, AuthorizationCodeInterface {

    private function getClient($client_id) {
        return ClientQuery::create()->findOneByClientId($client_id);
    }

    public function getAccessToken($oauth_token) {
        $token = TokenQuery::create()->findOneByToken($oauth_token);
        if ($token) {
            return [
                'expires' => $token->getExpires(),
                'client_id' => $token->getClientId(),
                'user_id' => NULL,
                'scope' => $token->getScope(),
                'id_token' => $token->getId()
            ];
        }
        return NULL;
    }

    public function setAccessToken($oauth_token, $client_id, $user_id, $expires, $scope = null) {
        $token = new Token();
        $token->setToken($oauth_token)
            ->setClientId($client_id)
            ->setExpires($expires)
            ->setScope($scope)
            ->save();
    }

    public function checkClientCredentials($client_id, $client_secret = null) {
        $client = $this->getClient($client_id);
        if ($client) {
            return $client_secret == $client->getClientSecret();
        }
        return NULL;
    }

    public function isPublicClient($client_id) {
        $client = $this->getClient($client_id);
        return $client ? boolval($client->getClientSecret()) : false;
    }

    public function getAuthorizationCode($code) {
        $code = CodeQuery::create()->findOneByCode($code);
        if ($code) {
            return [
                "client_id" => $code->getClientId(),
                "user_id" => NULL,
                "expires" => $code->getExpires(),
                "redirect_uri" => $code->getRedirectUri(),
                "scope" => $code->getScope()
            ];
        }
        return NULL;
    }

    public function setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = null) {
        $acode = new Code;
        $acode->setCode($code)
            ->setClientId($client_id)
            ->setRedirectUri($redirect_uri)
            ->setExpires($expires)
            ->setScope($scope)
            ->save();
    }

    public function expireAuthorizationCode($code) {
        $code = CodeQuery::create()->findOneByCode($code);
        if ($code) {
            $code->delete();
        }
    }

    public function getClientDetails($client_id) {
        $client = $this->getClient($client_id);
        if ($client) {
            $details = [
                "redirect_uri" => $client->getRedirectUri(),
                "client_id" => $client->getClientId(),
                "grant_types" => $client->getGrantTypes(),
                "user_id" => NULL,
                "scope" => $client->getScope()
            ];
            return $details;
        }
        return NULL;
    }

    public function getClientScope($client_id) {
        $client = $this->getClient($client_id);
        if ($client) {
            return $client->getScope();
        }
    }

    public function checkRestrictedGrantType($client_id, $grant_type) {
        $client = $this->getClient($client_id);
        if ($client) {
            $grantTypes = explode(' ', $client->getGrantTypes());
            return in_array($grant_type, (array)$grantTypes);
        }
        return NULL;
    }

}