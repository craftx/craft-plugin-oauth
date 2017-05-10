<?php
namespace craftx\oauth\services;

use craftx\oauth\providers\OauthGithubProvider;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Token\AccessToken;

use Craft;
use craft\base\Component;

use function craftx\oauth\oauth;

/**
 * Class OauthService
 *
 * @package Craft
 */
class OauthService extends Component
{
    public function github()
    {
        (new Github(oauth()->settings->getGithubProviderOptions()))->

        $code         = Craft::$app->getRequest()->getQueryParam('code');
        $state        = Craft::$app->getRequest()->getQueryParam('state');
        $sessionState = Craft::$app->getSession()->get('craftx.oauth.state');

        if (empty($code))
        {
            $authorizationUrl = $provider->getAuthorizationUrl(['scope' => ['user', 'repo']]);

            Craft::$app->getSession()->set('craftx.oauth.state', $provider->getState());

            Craft::$app->getResponse()->redirect($authorizationUrl);
            Craft::$app->end();
        }

        // Sanity check against possible CSRF attack
        if (empty($state) || $state !== $sessionState)
        {
            Craft::$app->getSession()->remove('craftx.oauth.state');

            throw new \Exception(Craft::t('oauth', 'Invalid State'));
        }

        $token = $provider->getAccessToken('authorization_code', ['code' => $code]);

        Craft::$app->getSession()->set('craftx.oauth.token', $token->getToken());
        Craft::$app->getResponse()->redirect('/actions/oauth/authentication/github-consume');
        Craft::$app->end();
    }

    public function githubConsume()
    {
        $token = new AccessToken(['access_token' => Craft::$app->getSession()->get('craftx.oauth.token')]);

        $provider = new Github([
            'clientId' => 'ebe93156f5f810852f77',
            'clientSecret' => 'd7f33e80087a4514780cb94a888d20166cd277d2',
            'redirectUri' => 'http://craft3.dev/actions/oauth/authentication/github'
        ]);

        $user = $provider->getResourceOwner($token);

        Craft::dd((string) $provider->getAuthenticatedRequest('GET', 'user/repos', $token)->getBody());
    }
}
