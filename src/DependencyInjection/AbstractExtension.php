<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

abstract class AbstractExtension extends Extension implements PrependExtensionInterface
{
    protected array $targetEntities = [];

    /**
     * Allow an extension to prepend the extension configurations.
     */
    public function prepend(ContainerBuilder $container): void
    {
        $configs = $container->getExtensionConfig('doctrine');

        $config = reset($configs);

        $config['orm']['resolve_target_entities'] = array_merge(
            $config['orm']['resolve_target_entities'] ?? [],
            $this->targetEntities
        );

        $container->prependExtensionConfig('doctrine', $config);
    }
}
