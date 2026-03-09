<?php

namespace Omnipay\Aifo\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected string $endpoint = 'https://aifo.pro/pay/';

    public function isSuccessful(): bool
    {
        return false;
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl(): string
    {
        $params = [
            'shop_id' => $this->data['shop_id'] ?? '',
            'pay_id' => $this->data['pay_id'] ?? '',
            'amount' => $this->data['amount'] ?? 0,
            'sign' => $this->data['sign'] ?? '',
        ];

        if (!empty($this->data['desc'])) {
            $params['desc'] = $this->data['desc'];
        }

        return $this->endpoint . '?' . http_build_query($params);
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    public function getRedirectData(): ?array
    {
        return null;
    }
}