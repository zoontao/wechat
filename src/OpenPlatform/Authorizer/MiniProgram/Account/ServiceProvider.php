<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\OpenPlatform\Authorizer\MiniProgram\Account;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['account'] = function ($app) {
            return new Client($app);
        };
    }
}
