<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

abstract class Form
{
	abstract public function getId(): string;

	public function getPostId(): int|string|false
	{
		return false;
	}

	/** @return array<string>|false
	 *	 @see https://developer.wordpress.org/reference/functions/wp_insert_post/ */
	public function getNewPost(): array|false
	{
		return false;
	}

	/** @return array<string>|false */
	public function getFieldGroups(): array|false
	{
		return false;
	}

	/** @return array<string>|false */
	public function getFields(): array|false
	{
		return false;
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
	public function getFormAttributes(): array
	{
		return [];
	}

	public function getReturn(): string
	{
		return add_query_arg('updated', 'true', acf_get_current_url());
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
