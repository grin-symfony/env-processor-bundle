<?php

namespace GS\EnvProcessor\DependencyInjection;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\Filesystem\{
    Path
};
use Symfony\Contracts\Translation\TranslatorInterface;

/*
    Usage:
    parameters:
        these_chars: '/\'

    services:
        _defaults:
            bind:
                $path1: '%env(<THIS_ENV_PROCESSOR_NAME>:parameter1:ENV_PATH)%'
                $path2: '%env(<THIS_ENV_PROCESSOR_NAME>:parameter1:parameter2:ENV_PATH)%'
                $path3: '%env(<THIS_ENV_PROCESSOR_NAME>::p1:ENV_PATH)%' null, and p1
                $path4: '%env(<THIS_ENV_PROCESSOR_NAME>::ENV_PATH)%' # default behaviour
*/
abstract class AbstractWithParamsVarProcessor extends AbstractEnvProcessor
{
    public const COUNT_OF_PARAMETERS = 1;

    public function __construct(
        TranslatorInterface $t,
        //
        protected readonly ContainerInterface $parameterBag,
    ) {
        parent::__construct(
            t: $t,
        );
    }


    //###> ABSTRACT ###

    abstract protected function get(
        string $prefix,
        string $nameWithoutParameters,
        \Closure $getEnv,
        array $parameters,
    ): mixed;

    //###< ABSTRACT ###


    public function getEnv(
        string $prefix,
        string $name,
        \Closure $getEnv,
    ): mixed {
        $parameters = [];

        for ($i = 0; static::COUNT_OF_PARAMETERS > $i; ++$i) {
            $parameters[] = $this->getParameter(
                $prefix,
                $name,
            );

            $name = $this->getNameWithoutFirstEl($name);
        }

        return $this->get(
            $prefix,
            $name,
            $getEnv,
            $parameters,
        );
    }


    //###> HELPER ###

    private function getNameWithoutFirstEl(
        string $name,
    ): string {
        //###> check parameter name
        $i = \strpos($name, ':');
        if (false === $i) {
            throw new RuntimeException(\sprintf(
                'Invalid env "' . $prefix . ':%s": a key specifier should be provided.',
                $name,
            ));
        }

        return \substr($name, $i + 1);
    }

    private function getParameter(
        string $prefix,
        string $name,
    ): mixed {
        $i = \strpos($name, ':');

        //###> get parameter
        $parameter = null;
        $parameterName = \substr($name, 0, $i);
        if (!empty($parameterName) && !$this->parameterBag->has($parameterName)) {
            throw new RuntimeException(\sprintf(
                'Invalid env fallback in "' . $prefix . ':%s": parameter "%s" not found.',
                $name,
                $parameterName,
            ));
        }

        if (!empty($parameterName)) {
            $parameter = $this->parameterBag->get($parameterName);
        }

        return $parameter;
    }

    //###< HELPER ###
}
