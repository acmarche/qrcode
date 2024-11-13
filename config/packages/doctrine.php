<?php


use Symfony\Config\DoctrineConfig;
use function Symfony\Component\DependencyInjection\Loader\Configurator\Env;

return static function (DoctrineConfig $doctrine) {
    $doctrine->dbal()
        ->connection('qrcode')
        ->url(env('DATABASE_QRCODE_URL')->resolve())
        ->charset('utf8mb4');

    $emMda = $doctrine->orm()->entityManager('qrcode');
    $emMda->connection('qrcode');
    $emMda->mapping('AcMarcheQrCode')
        ->isBundle(false)
        ->type('attribute')
        ->dir('%kernel.project_dir%/src/AcMarche/QrCode/src/Entity')
        ->prefix('AcMarche\QrCode')
        ->alias('AcMarcheQrCode');
};
