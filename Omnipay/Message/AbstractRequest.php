<?php

namespace Omnipay\Aifo\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Omnipay\Aifo\Traits\Parametrable;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    use Parametrable;

    /**
     * @param string|float $amount Принимаем float или string
     */
    protected function createSignature(string $shopId, $amount, string $key, string $invoiceId, int $signatureType): string
    {
        $amountStr = is_float($amount) ? number_format($amount, 2, '.', '') : (string)$amount;

        $signString = $shopId . ':' . $amountStr . ':' . $key . ':' . $invoiceId;
        
        $algos = [
            1 => 'md5',
            2 => 'sha256',
            3 => 'sha1',
            4 => 'ripemd160',
            5 => 'sha384',
            6 => 'sha512',
        ];

        $algo = $algos[$signatureType] ?? 'sha256';

        return hash($algo, $signString);
    }
}