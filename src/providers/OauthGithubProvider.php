<?php
namespace craftx\oauth\providers;

use League\OAuth2\Client\Provider\Github;

class OauthGithubProvider
{
    /**
     * @var OauthStorageInterface
     */
    private $storage;

    public static function make(array $options, OauthStorageInterface $storage = null)
    {
        $github = new Github($options);

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
}
