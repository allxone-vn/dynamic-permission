<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use League\OAuth2\Client\Provider\Google;
use CodeIgniter\Email\Email;

class Services extends BaseService
{
    public static function googleClient($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('googleClient');
        }

        // Đọc các giá trị từ biến môi trường
        $clientId = getenv('GOOGLE_CLIENT_ID');
        $clientSecret = getenv('GOOGLE_CLIENT_SECRET');
        $redirectUri = getenv('GOOGLE_REDIRECT_URI');

        return new Google([
            'clientId'     => $clientId,
            'clientSecret' => $clientSecret,
            'redirectUri'  => $redirectUri,
        ]);
        
    }
    public static function emailService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('emailService');
        }

        $emailConfig = config('Email'); // Lấy cấu hình từ file Email.php trong Config

        $email = new Email($emailConfig);

        return $email;
    }
}
