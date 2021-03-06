<?php

namespace Techgrid\HashIdBundle\DependencyInjection\Compiler;

use Hashids\Hashids;
use Techgrid\HashIdBundle\ParametersProcessor\Converter\HashidsConverter;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class HashidsConverterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!class_exists(Hashids::class)) {
            return;
        }

        $this->registerHashidsService($container);
        $this->registerHashidsConverter($container);
        $this->setConverterAsDefault($container);
    }

    protected function registerHashidsService(ContainerBuilder $container): void
    {
        $hashidsDefinition = new Definition(
            Hashids::class,
            [
                $container->getParameter('techgrid_hash_id.converter.hashids.salt'),
                $container->getParameter('techgrid_hash_id.converter.hashids.min_hash_length'),
                $container->getParameter('techgrid_hash_id.converter.hashids.alphabet'),
            ]
        );
        $hashidsDefinition->setPublic(false);

        $container->addDefinitions(['techgrid_hash_id.hashids' => $hashidsDefinition]);
    }

    protected function registerHashidsConverter(ContainerBuilder $container): void
    {
        $hashidsConverterDefinition = new Definition(
            HashidsConverter::class,
            [
                new Reference('techgrid_hash_id.hashids'),
            ]
        );

        $container->addDefinitions(['techgrid_hash_id.converter.hashids' => $hashidsConverterDefinition]);
    }

    protected function setConverterAsDefault(ContainerBuilder $container): void
    {
        $converterServiceId = 'techgrid_hash_id.converter';
        if (!$container->hasAlias($converterServiceId)) {
            $converterServiceAlias = new Alias('techgrid_hash_id.converter.hashids');
            $container->addAliases([$converterServiceId => $converterServiceAlias]);
        }
    }
}
