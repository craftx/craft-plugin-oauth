<?php
namespace craftx\oauth\twig;

use craftx\oauth\Oauth;

/**
 * Class OauthTemplateComponent
 *
 * @package craftx\oauth\twig
 */
class OauthTemplateComponent
{
    public function settings()
    {
        return print_r(Oauth::getInstance()->getSettings(), true);
    }
}
