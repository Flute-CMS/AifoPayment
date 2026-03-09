<?php

namespace Omnipay\Aifo\Traits;

trait Parametrable
{
    public function setShopId($value)
    {
        return $this->setParameter('shopId', $value);
    }

    public function getShopId()
    {
        return $this->getParameter('shopId');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSignatureType($value)
    {
        return $this->setParameter('signatureType', $value);
    }

    public function getSignatureType()
    {
        return $this->getParameter('signatureType');
    }
}
