<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

abstract class Form
{
	abstract public function getPostId(): int|string;

	/** @return array<string> */
	abstract public function getNewPost(): array;

	/** @return array<string> */
	abstract public function getFieldGroups(): array;

	/** @return array<string> */
	abstract public function getFields(): array;

	public function getId(): string
	{
		return 'acf-form';
	}

	public function getPostTitle(): bool
	{
		return false;
	}

	public function getPostContent(): bool
	{
		return false;
	}

	public function getForm(): bool
	{
		return true;
	}

	/** @return array<string> */
	public function getFormAtrributes(): array
	{
		return [];
	}

	public function getReturn(): string
	{
		return '';
	}

	public function getHtmlBeforeFields(): string
	{
		return '';
	}

	public function getHtmlAfterFields(): string
	{
		return '';
	}

	public function getSubmitValue(): string
	{
		return __('update', 'acf');
	}

	public function getUpdatedMessage(): string
	{
		return __('updated', 'acf');
	}

	public function getLabelPlacement(): string
	{
		return 'left';
	}

	public function getInstructionPlacement(): string
	{
		// 'label' or 'field'
		return 'field';
	}

	public function getFieldEl(): string
	{
		// 'div' , 'tr', 'td', 'ul', 'ol'  or  'dl'
		return 'div';
	}

	public function getUploader(): string
	{
		// 'wp' or 'basic'
		return 'wp';
	}

	public function getHoneyPot(): bool
	{
		return true;
	}

	public function getHtmlUpdatedMessage(): string
	{
		// The HTML used to render the updated message
		return '<div id="message" class="updated"><p>%s</p></div>';
	}

	public function getHtmlSubmitButton(): string
	{
		return '<input type="submit" class="acf-button button button-primary button-large" value="%s" />';
	}

	public function getHtmlSubmitSpinner(): string
	{
		return '<span class="acf-spinner"></span>';
	}

	public function getKses(): bool
	{
		return true;
	}
}
