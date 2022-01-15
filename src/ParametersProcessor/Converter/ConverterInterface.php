<?php

declare(strict_types=1);

namespace Techgrid\HashIdBundle\ParametersProcessor\Converter;

interface ConverterInterface
{
    public function encode($value): string;

    public function decode($value);
}
