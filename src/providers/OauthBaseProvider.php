<?php
namespace craftx\oauth\providers;

use craftx\oauth\storage\OauthStorageInterface;

/**
 * Class OauthBaseProvider
 *
 * @package craftx\oauth\providers
 */
class OauthBaseProvider
{
    /**
     * @var OauthStorageInterface
     */
    protected $storage;
}
