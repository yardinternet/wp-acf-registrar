# ACF Registrar

[![Code Style](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/format-php.yml/badge.svg?no-cache)](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/format-php.yml)
[![PHPStan](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/phpstan.yml/badge.svg?no-cache)](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/phpstan.yml)
[![Tests](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/run-tests.yml/badge.svg?no-cache)](https://github.com/yardinternet/wp-acf-registrar/actions/workflows/run-tests.yml)

## Features

- [x] Register ACF Field groups
- [x] Register ACF Forms
- [x] Register ACF Option Pages

## Installation

This package can be installed using composer

```shell
composer require yard/acf-registrar
```

# Usage

To use this package in a standard WordPress plugin, you can use the `Registrar` to register hooks.

main file:

```php
/**
 * Plugin Name: My Plugin
 */

require __DIR__ . '/vendor/autoload.php';

$fieldGroups$ = [
    \Plugin\FieldGroupClass::class,
    \Plugin\AnotherFieldGroupClass::class,
];

$registrar = new \Yard\Acf\Registrar();
$registrar->addFieldGroups($fieldGroups);
$registrar->addForm(\Plugin\FormClass::class);
$registrar->addOptionPage(\Plugin\OptionPageClass::class);
$registrar->register();
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

`getId()` is required to define the form id, additional methods can be used to overwrite the given defaults.

```php
<?php

declare(strict_types=1);

namespace App\Forms;

use Yard\Acf\Registrar\Form;

class Person extends Form
{
    public function getId(): string
    {
        return 'form-id';
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

## Option page Usage

Extend `Yard\Acf\Registrar\OptionPage` to define a option page.
Add the class to `config/acf-registrar` under the `option_pages` key.

`getPageTitle()` is required to define the option page dashboard name and page title, additional methods can be used to overwrite the given defaults.

```php
<?php

declare(strict_types=1);

namespace App\OptionPages;

use Yard\Acf\Registrar\OptionPage;

class PersonOptions extends OptionPage
{
    public function getPageTitle(): string
    {
        return 'Option page example';
    }

    public function getCapability(): string
    {
        return 'edit_posts';
    }

}
```

Option pages require the registration of 1 or more fieldgroups that are linked to the option page via:

```php
<?php
public function getLocation(): array
    {
        return [
            Location::where('option_page', '==', 'acf-options-option-page-example'),
        ];
    }
```

## About us

[![banner](https://raw.githubusercontent.com/yardinternet/.github/refs/heads/main/profile/assets/small-banner-github.svg)](https://www.yard.nl/werken-bij/)
