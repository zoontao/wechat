<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\Work\Jssdk;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['jssdk'] = function ($app) {
            return new Client($app);
        };
    }
}
