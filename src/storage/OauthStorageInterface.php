<?php
namespace craftx\oauth\storage;

/**
 * Interface OauthStorageInterface
 *
 * @package craftx\oauth\storage
 */
interface OauthStorageInterface
{
    public function get($key, $default = null);

    public function set($key, $value = null);
}
