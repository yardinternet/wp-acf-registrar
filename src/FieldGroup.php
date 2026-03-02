<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

abstract class FieldGroup
{
	abstract public function getTitle(): string;

	/** @return array<string|int , \Extended\ACF\Fields\Field> */
	abstract public function getFields(): array;

	/** @return array<string|int, \Extended\ACF\Location> */
	abstract public function getLocation(): array;

	public function getKey(): string
	{
		return '';
	}

	public function getMenuOrder(): int
	{
		return 0;
	}
	public function getPosition(): string
	{
		// 'acf_after_title', 'normal' or 'side'
		return 'normal';
	}

	public function getStyle(): string
	{
		// 'default' or 'seamless'
		return 'default';
	}

	public function getLabelPlacement(): string
	{
		// 'top' or 'left'
		return 'left';
	}

	public function getInstructionPlacement(): string
	{
		// 'label' or 'field'
		return 'field';
	}

	/** @return array<string> */
	public function getHideOnScreen(): array
	{
		// An array of elements to hide on the screen
		return [];
	}
}
