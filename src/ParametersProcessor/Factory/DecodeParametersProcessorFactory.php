<?php

declare(strict_types=1);

namespace Techgrid\HashIdBundle\ParametersProcessor\Factory;

use Techgrid\HashIdBundle\Annotation\Hash;
use Techgrid\HashIdBundle\AnnotationProvider\AnnotationProvider;
use Techgrid\HashIdBundle\Exception\InvalidControllerException;
use Techgrid\HashIdBundle\Exception\MissingClassOrMethodException;
use Techgrid\HashIdBundle\ParametersProcessor\ParametersProcessorInterface;

class DecodeParametersProcessorFactory extends AbstractParametersProcessorFactory
{
    /**
     * @var ParametersProcessorInterface
     */
    protected $decodeParametersProcessor;

    public function __construct(
        AnnotationProvider $annotationProvider,
        ParametersProcessorInterface $noOpParametersProcessor,
        ParametersProcessorInterface $decodeParametersProcessor
    ) {
        parent::__construct($annotationProvider, $noOpParametersProcessor);
        $this->decodeParametersProcessor = $decodeParametersProcessor;
    }

    protected function getDecodeParametersProcessor(): ParametersProcessorInterface
    {
        return $this->decodeParametersProcessor;
    }

    /**
     * @param object $controller
     */
    public function createControllerDecodeParametersProcessor($controller, string $method): ParametersProcessorInterface
    {
        try {
            /** @var Hash $annotation */
            $annotation = $this->getAnnotationProvider()->getFromObject(
                $controller,
                $method,
                Hash::class
            );
        } catch (InvalidControllerException | MissingClassOrMethodException $e) {
            $annotation = null;
        }

        return null !== $annotation
            ? $this->getDecodeParametersProcessor()->setParametersToProcess($annotation->getParameters())
            : $this->getNoOpParametersProcessor();
    }
}
