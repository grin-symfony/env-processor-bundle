<?php

namespace GS\EnvProcessor\DependencyInjection;

use Symfony\Contracts\Translation\TranslatorInterface;

class IsExistsPathVarProcessor extends AbstractEnvProcessor
{
    /* You can already use this env processor name */
    public const ENV_PROCESSOR_NAME = 'is_exists_path';

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
        $path = $getEnv($name);

        if (!\file_exists($path)) {
            throw new \Exception($this->trans(
                'exception.must_exist',
                [
                    '%path%' => $path,
                ],
            ));
        }

        return $path;
    }
}
