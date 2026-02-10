<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

abstract class OptionPage
{
	abstract public function getPageTitle(): string;

	final public function getPostId(): string
	{
		return 'options';
	}

	public function getMenuTitle(): string
	{
		return $this->getPageTitle();
	}

	public function getMenuSlug(): string
	{
		return 'acf-options' . acf_slugify($this->getMenuTitle());
	}

	public function getCapability(): string
	{
		return 'edit_posts';
	}

	public function getParentSlug(): string
	{
		return '';
	}

	public function getPosition(): null|int
	{
		return null;
	}

	public function getIconUrl(): string|false
	{
		return false;
	}

	public function getRedirect(): bool
	{
		return true;
	}

	public function getAutoload(): bool
	{
		return false;
	}

	public function getUpdateButton(): string
	{
		return __('Update', 'acf');
	}

	public function getUpdatedMessage(): string
	{
		return __('Options Updated', 'acf');
	}
}
