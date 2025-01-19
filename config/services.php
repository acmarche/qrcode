<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->load('AcMarche\QrCode\\', __DIR__.'/../src/*')
        ->exclude([__DIR__.'/../src/{Entity,Tests}']);
};
