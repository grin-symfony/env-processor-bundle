<?php

namespace GS\EnvProcessor\DependencyInjection;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\Filesystem\{
    Path
};
use Symfony\Contracts\Translation\TranslatorInterface;

class RTrimVarProcessor extends AbstractWithParamsVarProcessor
{
    /* You can already use this env processor name */
    public const ENV_PROCESSOR_NAME = 'r_trim_with_param';

    public const ENV_PROCESSOR_TYPES = [
        'string',
        'float',
        'int',
    ];

    protected function get(
        string $prefix,
        string $nameWithoutParameters,
        \Closure $getEnv,
        array $parameters,
    ): mixed {

        $val = $getEnv($nameWithoutParameters);

        $rtrimmed = (\count($parameters) > 0)
            ? \rtrim($val, $parameters[0])
            : \rtrim($val)
        ;

        return $rtrimmed;
    }
}
