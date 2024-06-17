green-symfony/env-rocessor-bundle
========

## Description

This bundle provides the following env-processors names:
| Env Processor's names | Description |
| ------------- | ------------- |
| [gs_env_is_absolute_path](https://github.com/green-symfony/env-processor-bundle/blob/main/src/DependencyInjection/IsAbsolutePathVarProcessor.php) | This path must be absolute |
| [gs_env_is_exists_path](https://github.com/green-symfony/env-processor-bundle/blob/main/src/DependencyInjection/IsExistsPathVarProcessor.php) | This path must exist |
| [gs_env_is_exists_file](https://github.com/green-symfony/env-processor-bundle/blob/main/src/DependencyInjection/IsExistsFileVarProcessor.php) | The path of the existing file |
| [gs_env_normalize_path](https://github.com/green-symfony/env-processor-bundle/blob/main/src/DependencyInjection/NormalizePathEnvVarProcessor.php) | Replaces php's \DIRECTORY_SEPARATOR with "/" |
| [gs_env_r_trim_with_param](https://github.com/green-symfony/env-processor-bundle/blob/main/src/DependencyInjection/RTrimVarProcessor.php) | php's \rtrim() |

## Installation

### Step 1: Download the bundle

[Before git clone](https://github.com/green-symfony/docs/blob/main/docs/bundles_green_symfony%20mkdir.md)

```console
git clone "https://github.com/green-symfony/env-processor-bundle.git"
```

```console
git clone "https://github.com/green-symfony/service-bundle.git"
```

### Step 2: Require the bundle

In your `%kernel.project_dir%/composer.json`

```json
"require": {
	"green-symfony/env-processor-bundle": "VERSION"
},
"repositories": [
	{
		"type": "path",
		"url": "./bundles/green-symfony/env-processor-bundle"
	},
	{
		"type": "path",
		"url": "./bundles/green-symfony/service-bundle"
	}
]
```

Open your console into your main project directory and execute:

```console
composer require "green-symfony/env-processor-bundle"
```

### Step 4: Just use it

Everything has already installed!
You can already use it.

## How to use these Symfony Env Processors?

[Symfony Env Processors Usage](https://github.com/green-symfony/docs/blob/main/docs/symfony%20env-processors%20usage.md)