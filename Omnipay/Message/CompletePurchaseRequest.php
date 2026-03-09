<?php

namespace Omnipay\Aifo\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        $data = $this->httpRequest->request->all();
        
        if (empty($data)) {
            $content = $this->httpRequest->getContent();
            if (!empty($content)) {
                $json = json_decode($content, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
                    $data = $json;
                }
            }
        }
        
        return $data;
    }

    public function sendData($data): ResponseInterface
    {
        $this->validate('shopId', 'secretKey', 'signatureType');
        
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
