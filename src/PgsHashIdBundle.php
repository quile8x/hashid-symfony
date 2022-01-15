<?php

namespace Techgrid\HashIdBundle;

use Techgrid\HashIdBundle\DependencyInjection\Compiler\EventSubscriberCompilerPass;
use Techgrid\HashIdBundle\DependencyInjection\Compiler\HashidsConverterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TechgridHashIdBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new HashidsConverterCompilerPass());
        $container->addCompilerPass(new EventSubscriberCompilerPass());
    }
}
