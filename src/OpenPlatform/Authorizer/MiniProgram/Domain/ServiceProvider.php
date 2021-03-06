<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\OpenPlatform\Authorizer\MiniProgram\Domain;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['domain'] = function ($app) {
            return new Client($app);
        };
    }
}
