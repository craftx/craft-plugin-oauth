<?php
namespace craftx\oauth\controllers;

use craft\web\Controller;

use craftx\oauth\Oauth;

/**
 * Class OauthAuthenticationController
 *
 * @package craftx\oauth\controllers
 */
class OauthAuthenticationController extends Controller
{
    protected $allowAnonymous = true;

    public function actionGithub()
    {
        Oauth::getInstance()->api->github();
    }

    public function actionGithubConsume()
    {
        Oauth::getInstance()->api->githubConsume();
    }
}
