<?php

namespace GS\EnvProcessor\DependencyInjection;

use Symfony\Component\Filesystem\{
    Path
};
use Symfony\Contracts\Translation\TranslatorInterface;

class IsAbsolutePathVarProcessor extends AbstractEnvProcessor
{
    /* You can already use this env processor name */
    public const ENV_PROCESSOR_NAME = 'is_absolute_path';

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
        $path   = $getEnv($name);

        if (!Path::isAbsolute($path)) {
            throw new \Exception($this->trans(
                'exception.must_be_absolute',
                [
                    '%path%' => $path,
                ],
            ));
        }

        return $path;
    }
}
