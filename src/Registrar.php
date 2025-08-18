<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

use Illuminate\Contracts\Foundation\Application;

class Registrar
{
	public function __construct(protected Application $app)
	{
		add_action('acf/init', $this->registerFieldGroups(...));
	}

	public function registerFieldGroups(): void
	{
		$fieldGroups = config('acf-registrar.field_groups', []);

		foreach ($fieldGroups as $group) {
			if (! is_a($group, FieldGroup::class, true)) {
				throw new \RuntimeException(sprintf('The class "%s" must extend %s.', $group, FieldGroup::class));
			}

			/** @var FieldGroup $fieldGroup */
			$fieldGroup = new $group();

			$settings = [
				'fields' => $fieldGroup->getFields(),
				'location' => $fieldGroup->getLocation(),
				'title' => $fieldGroup->getTitle(),
				'menu_order' => $fieldGroup->getMenuOrder(),
				'position' => $fieldGroup->getPosition(),
				'style' => $fieldGroup->getStyle(),
				'label_placement' => $fieldGroup->getLabelPlacement(),
				'instruction_placement' => $fieldGroup->getInstructionPlacement(),
				'hide_on_screen' => $fieldGroup->getHideOnScreen(),
			];

			register_extended_field_group($settings);
		}
	}
}
