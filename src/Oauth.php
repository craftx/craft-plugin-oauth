<?php
namespace craftx\oauth;

use Craft;
use craft\base\Plugin;

use craftx\oauth\models\OauthSettings;
use craftx\oauth\twig\OauthTemplateComponent;
use craftx\oauth\twig\OauthTemplateExtension;
use craftx\oauth\controllers\OauthAuthenticationController;
use craftx\oauth\services\OauthService;

/**
 * Class Oauth
 *
 * @package craftx\oauth
 *
 * @property OauthService $service
 */
class Oauth extends Plugin
{
    public $controllerMap = [
        'authentication' => OauthAuthenticationController::class
    ];

    public function init()
    {
        parent::init();

        require dirname(__DIR__, 1) . '/vendor/autoload.php';

        Craft::$app->getView()->getTwig()->addExtension(new OauthTemplateExtension());
    }

    public function createSettingsModel()
    {
        return new OauthSettings();
    }

    public function defineTemplateComponent()
    {
        return OauthTemplateComponent::class;
    }
}
