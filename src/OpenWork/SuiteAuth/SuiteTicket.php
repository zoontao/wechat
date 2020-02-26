<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\OpenWork\SuiteAuth;

use WeChat\Kernel\Exceptions\RuntimeException;
use WeChat\Kernel\Traits\InteractsWithCache;
use WeChat\OpenWork\Application;

/**
 * SuiteTicket.
 *
 * @author xiaomin <keacefull@gmail.com>
 */
class SuiteTicket
{
    use InteractsWithCache;

    /**
     * @var Application
     */
    protected $app;

    /**
     * SuiteTicket constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $ticket
     *
     * @return $this
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function setTicket(string $ticket)
    {
        $this->getCache()->set($this->getCacheKey(), $ticket, 1800);

        if (!$this->getCache()->has($this->getCacheKey())) {
            throw new RuntimeException('Failed to cache suite ticket.');
        }

        return $this;
    }

    /**
     * @return string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getTicket(): string
    {
        if ($cached = $this->getCache()->get($this->getCacheKey())) {
            return $cached;
        }

        throw new RuntimeException('Credential "suite_ticket" does not exist in cache.');
    }

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        return 'wechat.open_work.suite_ticket.'.$this->app['config']['suite_id'];
    }
}
