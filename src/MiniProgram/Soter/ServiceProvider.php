<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\MiniProgram\Soter;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author her-cat <hxhsoft@foxmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['soter'] = function ($app) {
            return new Client($app);
        };
    }
}
