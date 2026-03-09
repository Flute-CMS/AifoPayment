<?php

namespace Omnipay\Aifo\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    protected $request;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;

        if (!isset($this->data['sum']) || !isset($this->data['invoice']) || !isset($this->data['http_auth_signature'])) {
            throw new InvalidResponseException('Missing required callback parameters: sum, invoice, http_auth_signature');
        }

        if (!hash_equals($this->getHttpAuthSignature(), $this->calculateSignature())) {
            throw new InvalidResponseException('Invalid signature in callback');
        }
    }

    public function calculateSignature(): string
    {
        $shopId = (string) $this->request->getShopId();

        $amount = (string) ($this->data['sum'] ?? '0');

        $secretKey = (string) $this->request->getSecretKey();
        $invoiceUid = (string) ($this->data['invoice'] ?? '');
        $signatureType = (int) $this->request->getSignatureType();

        $signString = "{$shopId}:{$amount}:{$secretKey}:{$invoiceUid}";

        $algos = [
            1 => 'md5',
            2 => 'sha256',
            3 => 'sha1',
            4 => 'ripemd160',
            5 => 'sha384',
            6 => 'sha512'
        ];
        $algo = $algos[$signatureType] ?? 'sha256';

        return hash($algo, $signString);
    }

    public function getHttpAuthSignature(): string
    {
        return (string) ($this->data['http_auth_signature'] ?? '');
    }

    public function isSuccessful(): bool
    {
        return true;
    }

    public function getTransactionId(): ?string
    {
        $invoiceUid = $this->data['invoice'] ?? null;
        return $invoiceUid !== null ? (string) $invoiceUid : null;
    }

    public function getTransactionReference(): ?string
    {
        $invoiceUid = $this->data['invoice'] ?? null;
        return $invoiceUid !== null ? (string) $invoiceUid : null;
    }

    public function getAmount(): ?float
    {
        return (float) ($this->data['sum'] ?? 0);
    }
}
