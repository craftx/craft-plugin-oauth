<?php
namespace craftx\oauth\storage;

use Craft;

class OauthStorage implements OauthStorageInterface
{
    public function get($key, $default = null)
    {
        return Craft::$app->getRequest()->getQueryParam($key, $default);
    }
}
