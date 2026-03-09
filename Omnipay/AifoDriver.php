<?php

namespace Flute\Modules\AifoPayment\Omnipay;

use Flute\Core\Modules\Payments\Drivers\AbstractOmnipayDriver;

class AifoDriver extends AbstractOmnipayDriver
{
    public ?string $adapter = 'Aifo';
    public ?string $name = 'AIFO.PRO';
    public ?string $settingsView = 'flute-aifopayment::settings';

    public function getValidationRules(): array
    {
        return [
            'settings__shop_id' => ['required', 'integer'],
            'settings__secret_key' => ['required', 'string', 'max-str-len:255'],
            'settings__signature_type' => ['required', 'integer', 'min:1', 'max:6'],
        ];
    }
}
