<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\OpenPlatform\Component;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['component'] = function ($app) {
            return new Client($app);
        };
    }
}
