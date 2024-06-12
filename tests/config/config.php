<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container): void {
    $parameters = $container->parameters();

    $parameters->set('env(DB_ENGINE)', 'pdo_sqlite');
    $parameters->set('env(DB_HOST)', 'localhost');
    $parameters->set('env(DB_NAME)', 'core_test');
    $parameters->set('env(DB_USER)', 'root');
    $parameters->set('env(DB_PASSWD)', '');
    $parameters->set('env(DB_MEMORY)', 'true');
    $parameters->set('kernel.secret', 'test_secret');
    $parameters->set('locale', 'en');

    $services = $container->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load('EightMarq\CoreBundle\EventListener\\', '../../src/EventListener/*');
    $services->load('EightMarq\CoreBundle\Tests\Services\\', '../Services/*');

    $container->extension('doctrine', [
        'dbal' => [
            'dbname' => '%env(DB_NAME)%',
            'host' => '%env(DB_HOST)%',
            'user' => '%env(DB_USER)%',
            'password' => '%env(DB_PASSWD)%',
            'driver' => '%env(DB_ENGINE)%',
            'memory' => '%env(bool:DB_MEMORY)%',
        ],
        'orm' => [
            'auto_mapping' => true,
            'mappings' => [
                [
                    'name' => 'CoreBundle',
                    'type' => 'attribute',
                    'prefix' => 'EightMarq\CoreBundle\Tests\Fixtures\Entity\\',
                    'dir' => __DIR__.'/../Fixtures/Entity',
                    'is_bundle' => false,
                ],
            ],
        ],
    ]);
};
