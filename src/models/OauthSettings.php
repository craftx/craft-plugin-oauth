<?php
namespace craftx\oauth\models;

use Craft;
use craft\base\Model;

class OauthSettings extends Model
{
    public $appClientId = '';
    public $appClientSecret = '';
    public $appCallbackUrl = '';
}
