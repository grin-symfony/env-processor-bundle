<?php

namespace GS\EnvProcessor\DependencyInjection;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Filesystem\Path;

class NormalizePathEnvVarProcessor extends AbstractEnvProcessor
{
    /* You can already use this env processor name */
    public const ENV_PROCESSOR_NAME = 'normalize_path';

    public const ENV_PROCESSOR_TYPES = 'string';

    public function __construct(
        TranslatorInterface $t,
    ) {
        parent::__construct(
            t: $t,
        );
    }


    public function getEnv(
        string $prefix,
        string $name,
        \Closure $getEnv,
    ): mixed {
        $env    = $getEnv($name);

        return Path::normalize($env);
    }
}
