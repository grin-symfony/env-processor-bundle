<?php

namespace GS\EnvProcessor\DependencyInjection;

use Symfony\Contracts\Translation\TranslatorInterface;

class IsExistsFileVarProcessor extends AbstractEnvProcessor
{
    /* You can already use this env processor name */
    public const ENV_PROCESSOR_NAME = 'is_exists_file';

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

        if (!\file_exists($path) || !\is_file($path)) {
            throw new \Exception($this->trans(
                'exception.file_must_exist',
                [
                    '%path%' => $path,
                ],
            ));
        }

        return $path;
    }
}
