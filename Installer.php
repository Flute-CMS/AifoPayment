<?php

namespace Flute\Modules\AifoPayment;

class Installer extends \Flute\Core\Support\AbstractModuleInstaller
{
    public function install(\Flute\Core\ModulesManager\ModuleInformation &$module): bool
    {
        if (!file_exists(path('public/assets/img/payments/aifo.webp'))) {
            copy(module_path('AifoPayment', 'Resources/assets/img/logo.webp'), path('public/assets/img/payments/aifo.webp'));
        }

        return true;
    }

    public function uninstall(\Flute\Core\ModulesManager\ModuleInformation &$module): bool
    {
        $logoPath = path('public/assets/img/payments/aifo.webp');
        if (file_exists($logoPath)) {
            @unlink($logoPath);
        }
        return true;
    }
}
