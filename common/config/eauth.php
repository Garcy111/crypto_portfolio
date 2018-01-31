<?php
return [
    'class' => 'nodge\eauth\EAuth',
    'popup' => true, // Use the popup window instead of redirecting.
    'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
    'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
    'httpClient' => [
        // uncomment this to use streams in safe_mode
        //'useStreamsFallback' => true,
    ],
    'services' => [ // You can change the providers and their classes.
        'vkontakte' => [
            // register your app here: https://vk.com/editapp?act=create&site=1
            'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
            'clientId' => '6343730',
            'clientSecret' => 'AbG6KcH5iqlBNEDFPUe4',
        ],
        // 'twitter' => [
        //     // register your app here: https://dev.twitter.com/apps/new
        //     'class' => 'nodge\eauth\services\TwitterOAuth1Service',
        //     'key' => 'ZtD4Y5qIo4ntDZA1f50RTBnOO',
        //     'secret' => 'wv0psUCXFA9TFeUrM8yWS2ve9T3Ch6jjXZPPieBywElUofmY28',
        // ],
        // 'facebook' => [
        //     // register your app here: https://developers.facebook.com/apps/
        //     'class' => 'nodge\eauth\services\FacebookOAuth2Service',
        //     'clientId' => '468590710017582',
        //     'clientSecret' => '0731cf1497b073b27571539da593dddf',
        // ],
        //  'google' => [
        //     // register your app here: https://code.google.com/apis/console/
        //     'class' => 'nodge\eauth\services\GoogleOAuth2Service',
        //     'clientId' => '...',
        //     'clientSecret' => '...',
        //     'title' => 'Google',
        // ],
        // 'mailru' => [
        //     // register your app here: http://api.mail.ru/sites/my/add
        //     'class' => 'nodge\eauth\services\MailruOAuth2Service',
        //     'clientId' => '742705',
        //     'clientSecret' => 'a6119afab6a8e8260e41d010fdccd3e9',
        // ],
        //  'yandex' => [
        //     // register your app here: https://oauth.yandex.ru/client/my
        //     'class' => 'nodge\eauth\services\YandexOAuth2Service',
        //     'clientId' => 'f5f18ea1807a48a888afd3f74dc16141',
        //     'clientSecret' => '7bb4edd8a59b411f8e7f16253ce363f8',
        //     'title' => 'Yandex',
        // ],
        // 'yahoo' => [
        //     'class' => 'nodge\eauth\services\YahooOpenIDService',
        //     //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
        // ],
        // 'linkedin' => [
        //     // register your app here: https://www.linkedin.com/secure/developer
        //     'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
        //     'key' => '...',
        //     'secret' => '...',
        //     'title' => 'LinkedIn (OAuth1)',
        // ],
        // 'linkedin_oauth2' => [
        //     // register your app here: https://www.linkedin.com/secure/developer
        //     'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
        //     'clientId' => '...',
        //     'clientSecret' => '...',
        //     'title' => 'LinkedIn (OAuth2)',
        // ],
        // 'github' => [
        //     // register your app here: https://github.com/settings/applications
        //     'class' => 'nodge\eauth\services\GitHubOAuth2Service',
        //     'clientId' => '...',
        //     'clientSecret' => '...',
        // ],
        // 'live' => [
        //     // register your app here: https://account.live.com/developers/applications/index
        //     'class' => 'nodge\eauth\services\LiveOAuth2Service',
        //     'clientId' => '...',
        //     'clientSecret' => '...',
        // ],
        // 'steam' => [
        //     'class' => 'nodge\eauth\services\SteamOpenIDService',
        //     //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
        //     'apiKey' => '...', // Optional. You can get it here: https://steamcommunity.com/dev/apikey
        // ],
        // 'instagram' => [
        //     // register your app here: https://instagram.com/developer/register/
        //     'class' => 'nodge\eauth\services\InstagramOAuth2Service',
        //     'clientId' => '1b6b41a0693e44768450f7d59c9abdbf',
        //     'clientSecret' => 'c2bcacefaed0406391db674aff2c98b7',
        // ],
        // 'odnoklassniki' => [
        //     // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
        //     // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
        //     'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
        //     'clientId' => '...',
        //     'clientSecret' => '...',
        //     'clientPublic' => '...',
        //     'title' => 'Odnoklas.',
        //     ],
    ],
];