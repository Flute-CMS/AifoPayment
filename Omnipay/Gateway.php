<?php

namespace Omnipay\Aifo;

use Omnipay\Common\AbstractGateway;
use Omnipay\Aifo\Traits\Parametrable;

class Gateway extends AbstractGateway
{
    use Parametrable;

    public function getName(): string
    {
        return 'AIFO.PRO';
    }

    public function getDefaultParameters(): array
    {
        return [
            'shopId' => null,
            'secretKey' => '',
            'signatureType' => 2,
        ];
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\\Aifo\\Message\\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\\Aifo\\Message\\CompletePurchaseRequest', $parameters);
    }
}
