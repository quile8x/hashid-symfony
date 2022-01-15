<?php

declare(strict_types=1);

namespace Techgrid\HashIdBundle\ParametersProcessor\Factory;

use Techgrid\HashIdBundle\Annotation\Hash;
use Techgrid\HashIdBundle\AnnotationProvider\AnnotationProvider;
use Techgrid\HashIdBundle\Exception\InvalidControllerException;
use Techgrid\HashIdBundle\Exception\MissingClassOrMethodException;
use Techgrid\HashIdBundle\ParametersProcessor\ParametersProcessorInterface;
use Symfony\Component\Routing\Route;

class EncodeParametersProcessorFactory extends AbstractParametersProcessorFactory
{
    /**
     * @var ParametersProcessorInterface
     */
    protected $encodeParametersProcessor;

    public function __construct(
        AnnotationProvider $annotationProvider,
        ParametersProcessorInterface $noOpParametersProcessor,
        ParametersProcessorInterface $encodeParametersProcessor
    ) {
        parent::__construct($annotationProvider, $noOpParametersProcessor);
        $this->encodeParametersProcessor = $encodeParametersProcessor;
    }

    public function createRouteEncodeParametersProcessor(Route $route)
    {
        $controller = $route->getDefault('_controller');
        try {
            /** @var Hash $annotation */
            $annotation = $this->getAnnotationProvider()->getFromString($controller, Hash::class);
        } catch (InvalidControllerException | MissingClassOrMethodException $e) {
            $annotation = null;
        }

        return null !== $annotation
            ? $this->getEncodeParametersProcessor()->setParametersToProcess($annotation->getParameters())
            : $this->getNoOpParametersProcessor();
    }

    protected function getEncodeParametersProcessor(): ParametersProcessorInterface
    {
        return $this->encodeParametersProcessor;
    }
}
