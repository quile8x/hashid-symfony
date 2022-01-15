<?php

namespace Techgrid\HashIdBundle\ParametersProcessor;

interface ParametersProcessorInterface
{
    public function process(array $parameters): array;

    public function setParametersToProcess(array $parametersToProcess): self;

    public function getParametersToProcess(): array;

    public function needToProcess(): bool;
}
