<?php

namespace Techgrid\HashIdBundle\ParametersProcessor;

class Decode extends AbstractParametersProcessor
{
    protected function processValue($value)
    {
        return $this->getConverter()->decode($value);
    }
}
