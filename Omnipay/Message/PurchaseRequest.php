<?php

namespace Omnipay\Aifo\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
    protected string $endpoint = 'https://aifo.pro/pay/';

    public function getData(): array
    {
        $this->validate('amount', 'transactionId', 'returnUrl', 'notifyUrl');

        if (!$this->getShopId()) {
            throw new InvalidRequestException('Shop ID is required');
        }
        if (!$this->getSecretKey()) {
            throw new InvalidRequestException('Secret Key is required');
        }
        if (!$this->getSignatureType()) {
            throw new InvalidRequestException('Signature Type is required');
        }

        $shopId = (string) $this->getShopId();
        $amount = (float) $this->getAmount();
        $transactionId = (string) $this->getTransactionId();
        $secretKey = (string) $this->getSecretKey();
        $signatureType = (int) $this->getSignatureType();

        $sign = $this->createSignature($shopId, $amount, $secretKey, $transactionId, $signatureType);

        return [
            'shop_id' => $shopId,
            'amount' => number_format($amount, 2, '.', ''), // Отправляем в форму тоже отформатированную сумму
            'pay_id' => $transactionId,
            'sign' => $sign,
            'desc' => $this->getDescription(),
        ];
    }

    public function sendData($data): ResponseInterface
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}