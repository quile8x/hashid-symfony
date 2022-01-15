<?php

declare(strict_types=1);

namespace Techgrid\HashIdBundle\ParametersProcessor\Factory;

use Techgrid\HashIdBundle\AnnotationProvider\AnnotationProvider;
use Techgrid\HashIdBundle\ParametersProcessor\ParametersProcessorInterface;

abstract class AbstractParametersProcessorFactory
{
    /**
     * @var AnnotationProvider
     */
    protected $annotationProvider;

    /**
     * @var ParametersProcessorInterface
     */
    protected $noOpParametersProcessor;

    public function __construct(
        AnnotationProvider $annotationProvider,
        ParametersProcessorInterface $noOpParametersProcessor
    ) {
        $this->annotationProvider = $annotationProvider;
        $this->noOpParametersProcessor = $noOpParametersProcessor;
    }

    protected function getNoOpParametersProcessor(): ParametersProcessorInterface
    {
        return $this->noOpParametersProcessor;
    }

    protected function getAnnotationProvider(): AnnotationProvider
    {
        return $this->annotationProvider;
    }
}
