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

	public function registerForms(): void
	{
		$forms = config('acf-registrar.forms', []);

		foreach ($forms as $form) {
			if (! is_a($form, Form::class, true)) {
				throw new \RuntimeException(sprintf('The class "%s" must extend %s.', $form, Form::class));
			}

			/** @var Form $form */
			$form = new $form();

			$settings = [
				'id' => $form->getID(),
				'post_id' => $form->getPostID(),
				'new_post' => $form->getNewPost(),
				'field_groups' => $form->getFieldGroups(),
				'fields' => $form->getFields(),
				'post_title' => $form->getPostTitle(),
				'post_content' => $form->getPostContent(),
				'form' => $form->getForm(),
				'form_attributes' => $form->getFormAtrributes(),
				'return' => $form->getReturn(),
				'html_before_fields' => $form->getHtmlBeforeFields(),
				'html_after_fields' => $form->getHtmlAfterFields(),
				'submit_value' => $form->getSubmitValue(),
				'updated_message' => $form->getUpdatedMessage(),
				'label_placement' => $form->getLabelPlacement(),
				'instruction_placement' => $form->getInstructionPlacement(),
				'field_el' => $form->getFieldEl(),
				'uploader' => $form->getUploader(),
				'honeypot' => $form->getHoneypot(),
				'html_update_message' => $form->getHtmlUpdatedMessage(),
				'html_submit_button' => $form->getHtmlSubmitButton(),
				'html_submit_spinner' => $form->getHtmlSubmitSpinner(),
				'kses' => $form->getKses(),
			];

			acf_register_form($settings);
		}
	}
}
