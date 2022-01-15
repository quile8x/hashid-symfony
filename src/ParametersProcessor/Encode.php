<?php

namespace Techgrid\HashIdBundle\ParametersProcessor;

class Encode extends AbstractParametersProcessor
{
    protected function processValue($value): string
    {
        return $this->getConverter()->encode($value);
    }
}
