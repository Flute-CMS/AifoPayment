<?php

namespace Flute\Modules\AifoPayment\ServiceProviders;

use Flute\Core\Support\ModuleServiceProvider;
use Flute\Core\Modules\Payments\Events\RegisterPaymentFactoriesEvent;
use Flute\Core\Modules\Payments\Factories\PaymentDriverFactory;
use Flute\Modules\AifoPayment\Omnipay\AifoDriver;
use Flute\Modules\AifoPayment\Listeners\PaymentListener;

class AifoServiceProvider extends ModuleServiceProvider
{
    public array $extensions = [];
    protected ?string $moduleName = 'AifoPayment';

    public function boot(\DI\Container $container): void
    {
        $this->bootstrapModule();
        $this->loadViews('Resources/views', 'flute-aifopayment');
        app(PaymentDriverFactory::class)->register('Aifo', AifoDriver::class);
        events()->addDeferredListener(RegisterPaymentFactoriesEvent::NAME, [PaymentListener::class, 'registerAifo']);
    }

    public function register(\DI\Container $container): void {}
}
