<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

abstract class FieldGroup
{
	abstract public function getTitle(): string;

	/** @return array<string, \Extended\ACF\Fields\Field> */
	abstract public function getFields(): array;

	/** @return array<string, \Extended\ACF\Location> */
	abstract public function getLocation(): array;
}
