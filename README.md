# acf-registrar

[![Code Style](https://github.com/yardinternet/acf-registrar/actions/workflows/format-php.yml/badge.svg?no-cache)](https://github.com/yardinternet/acf-registrar/actions/workflows/format-php.yml)
[![PHPStan](https://github.com/yardinternet/acf-registrar/actions/workflows/phpstan.yml/badge.svg?no-cache)](https://github.com/yardinternet/acf-registrar/actions/workflows/phpstan.yml)
[![Tests](https://github.com/yardinternet/acf-registrar/actions/workflows/run-tests.yml/badge.svg?no-cache)](https://github.com/yardinternet/acf-registrar/actions/workflows/run-tests.yml)
[![Code Coverage Badge](https://github.com/yardinternet/acf-registrar/blob/badges/coverage.svg)](https://github.com/yardinternet/acf-registrar/actions/workflows/badges.yml)
[![Lines of Code Badge](https://github.com/yardinternet/acf-registrar/blob/badges/lines-of-code.svg)](https://github.com/yardinternet/acf-registrar/actions/workflows/badges.yml)

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [Acorn](https://github.com/roots/acorn) >= 4.0

## Installation

To install this package using Composer, follow these steps:

1. Add the following to the `repositories` section of your `composer.json`:

    ```json
    {
      "type": "vcs",
      "url": "git@github.com:yardinternet/acf-registrar.git"
    }
    ```

2. Install this package with Composer:

    ```sh
    composer require yard/acf-registrar
    ```

3. Run the Acorn WP-CLI command to discover this package:

    ```shell
    wp acorn package:discover
    ```

You can publish the config file with:

```shell
wp acorn vendor:publish --provider="Yard\Acf\Registrar\AcfServiceProvider"
```

## FieldGroup Usage

Extend `Yard\Acf\Registar\FieldGroup` to define a field group.
Add the class to `config/acf-registrar` in the `field_groups` key.
See [Extended ACF](https://github.com/vinkla/extended-acf) for documentation about registering fields.

```php
<?php

declare(strict_types=1);

namespace App\FieldGroups;

use Extended\ACF\Fields\Text;
use Extended\ACF\Location;
use Yard\Acf\Registrar\FieldGroup;

class Person extends FieldGroup
{
    public function getTitle(): string
    {
        return 'Instellingen Persoon';
    }

    public function getFields(): array
    {
        return [
            Text::make('Naam', 'name')
                ->instructions('De naam van de persoon.')
                ->required(true)
                ->placeholder('Voer de naam in'),
        ];
    }

    public function getLocation(): array
    {
        return [
            Location::where('post_type', '==', 'person'),
        ];
    }
}
```

## Forms Usage

Extend `Yard\Acf\Registrar\Forms` to define a front-end form.
Add the class to `config/acf-registrar` under the `forms` key.
See [Extended ACF](https://github.com/vinkla/extended-acf) for documentation about registering fields.

`getId()` is required to define the form id, additional methods can be used to overwrite the given defaults.

```php
<?php

declare(strict_types=1);

namespace App\Forms

use Yard\Acf\Registrar\Form;

class Person extends Form
{
    public function getId(): string
    {
        return 'form-id'
    }

    public function getFields(): array
    {
        return [
            Person::SOME_FIELD,
            Person::MORE_FIELDS
        ];
}

}
```
