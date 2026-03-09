<?php

namespace Flute\Modules\AifoPayment\Listeners;

class PaymentListener
{
    public static function registerAifo()
    {
        app()->getLoader()->addPsr4('Omnipay\\Aifo\\', module_path('AifoPayment', 'Omnipay/'));
        app()->getLoader()->register();
    }
}
