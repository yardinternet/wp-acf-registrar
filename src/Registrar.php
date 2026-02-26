<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

class Registrar
{
	/** @var array<class-string<FieldGroup>> */
	private array $fieldGroups = [];

	/** @var array<class-string<Form>> */
	private array $forms = [];

	/** @var array<class-string<OptionPage>> */
	private array $optionPages = [];

	public function __construct()
	{
	}

	public function register(): void
	{
		add_action('acf/init', $this->registerFieldGroups(...));
		add_action('acf/init', $this->registerForms(...));
		add_action('acf/init', $this->registerOptionPage(...));
	}

	/** @param array<class-string<FieldGroup>> $fieldGroups */
	public function addFieldGroups(array $fieldGroups): self
	{
		foreach ($fieldGroups as $fieldGroup) {
			$this->addFieldGroup($fieldGroup);
		}

		return $this;
	}

	public function addFieldGroup(string $fieldGroup): self
	{
		if (! is_a($fieldGroup, FieldGroup::class, true)) {
			throw new \RuntimeException(sprintf('The class "%s" must extend %s.', $fieldGroup, FieldGroup::class));
		}

		$this->fieldGroups[] = $fieldGroup;

		return $this;
	}

	/** @param array<class-string<Form>> $forms */
	public function addForms(array $forms): self
	{
		foreach ($forms as $form) {
			$this->addForm($form);
		}

		return $this;
	}

	public function addForm(string $form): self
	{
		if (! is_a($form, Form::class, true)) {
			throw new \RuntimeException(sprintf('The class "%s" must extend %s.', $form, Form::class));
		}

		$this->forms[] = $form;

		return $this;
	}

	/** @param array<class-string<OptionPage>> $optionPages */
	public function addOptionPages(array $optionPages): self
	{
		foreach ($optionPages as $optionPage) {
			$this->addOptionPage($optionPage);
		}

		return $this;
	}

	public function addOptionPage(string $optionPage): self
	{
		if (! is_a($optionPage, OptionPage::class, true)) {
			throw new \RuntimeException(sprintf('The class "%s" must extend %s.', $optionPage, OptionPage::class));
		}
		$this->optionPages[] = $optionPage;

		return $this;
	}

	public function registerFieldGroups(): void
	{
		foreach ($this->fieldGroups as $group) {
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
		foreach ($this->forms as $form) {
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
				'form_attributes' => $form->getFormAttributes(),
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

	public function registerOptionPage(): void
	{
		foreach ($this->optionPages as $optionPage) {
			$optionPage = new $optionPage();
			$settings = [
				'page_title' => $optionPage->getPageTitle(),
				'menu_title' => $optionPage->getMenuTitle(),
				'menu_slug' => $optionPage->getMenuSlug(),
				'post_id' => $optionPage->getPostId(),
				'capability' => $optionPage->getCapability(),
				'parent_slug' => $optionPage->getParentSlug(),
				'position' => $optionPage->getPosition(),
				'icon_url' => $optionPage->getIconUrl(),
				'redirect' => $optionPage->getRedirect(),
				'autoload' => $optionPage->getAutoload(),
				'update_button' => $optionPage->getUpdateButton(),
				'updated_message' => $optionPage->getUpdatedMessage(),
			];

			acf_add_options_page($settings);
		}
	}
}
