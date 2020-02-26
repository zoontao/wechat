<?php

/*
 * This file is part of the overtrue/wechat.

 */

namespace WeChat\Payment\ProfitSharing;

use WeChat\Payment\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author ClouderSky <clouder.flow@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * {@inheritdoc}.
     */
    protected function prepends()
    {
        return [
            'sign_type' => 'HMAC-SHA256',
        ];
    }

    /**
     * Add profit sharing receiver.
     * 服务商代子商户发起添加分账接收方请求.
     * 后续可通过发起分账请求将结算后的钱分到该分账接收方.
     *
     * @param array $receiver 分账接收方对象，json格式
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addReceiver(array $receiver)
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            'receiver' => json_encode(
                $receiver, JSON_UNESCAPED_UNICODE
            ),
        ];

        return $this->request(
            'pay/profitsharingaddreceiver', $params
        );
    }

    /**
     * Delete profit sharing receiver.
     * 服务商代子商户发起删除分账接收方请求.
     * 删除后不支持将结算后的钱分到该分账接收方.
     *
     * @param array $receiver 分账接收方对象，json格式
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteReceiver(array $receiver)
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            'receiver' => json_encode(
                $receiver, JSON_UNESCAPED_UNICODE
            ),
        ];

        return $this->request(
            'pay/profitsharingremovereceiver', $params
        );
    }

    /**
     * Single profit sharing.
     * 请求单次分账.
     *
     * @param string $transactionId 微信支付订单号
     * @param string $outOrderNo    商户系统内部的分账单号
     * @param array  $receivers     分账接收方列表
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function share(
        string $transactionId,
        string $outOrderNo,
        array $receivers
    ) {
        $params = [
            'appid' => $this->app['config']->app_id,
            'transaction_id' => $transactionId,
            'out_order_no' => $outOrderNo,
            'receivers' => json_encode(
                $receivers, JSON_UNESCAPED_UNICODE
            ),
        ];

        return $this->safeRequest(
            'secapi/pay/profitsharing', $params
        );
    }

    /**
     * Multi profit sharing.
     * 请求多次分账.
     *
     * @param string $transactionId 微信支付订单号
     * @param string $outOrderNo    商户系统内部的分账单号
     * @param array  $receivers     分账接收方列表
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function multiShare(
        string $transactionId,
        string $outOrderNo,
        array $receivers
    ) {
        $params = [
            'appid' => $this->app['config']->app_id,
            'transaction_id' => $transactionId,
            'out_order_no' => $outOrderNo,
            'receivers' => json_encode(
                $receivers, JSON_UNESCAPED_UNICODE
            ),
        ];

        return $this->safeRequest(
            'secapi/pay/multiprofitsharing', $params
        );
    }

    /**
     * Finish profit sharing.
     * 完结分账.
     *
     * @param array $params
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function markOrderAsFinished(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;
        $params['sub_appid'] = null;

        return $this->safeRequest(
            'secapi/pay/profitsharingfinish', $params
        );
    }

    /**
     * Query profit sharing result.
     * 查询分账结果.
     *
     * @param string $transactionId 微信支付订单号
     * @param string $outOrderNo    商户系统内部的分账单号
     *
     * @return array|\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function query(
        string $transactionId, string $outOrderNo
    ) {
        $params = [
            'sub_appid' => null,
            'transaction_id' => $transactionId,
            'out_order_no' => $outOrderNo,
        ];

        return $this->request(
            'pay/profitsharingquery', $params
        );
    }
}
