<?php
namespace craftx\oauth\models;

use craft\base\Model;

/**
 * Class OauthSettings
 *
 * @package craftx\oauth\models
 */
class OauthSettings extends Model
{
    public $githubClientId = '';
    public $githubClientSecret = '';
    public $githubRedirectUri = '';

    /**
     * @return array
     */
    public function getGithubProviderOptions()
    {
        return [
            'clientId' => $this->githubClientId,
            'clientSecret' => $this->githubClientSecret,
            'redirectUri' => $this->githubRedirectUri,
        ];
    }
}
