<?php

declare(strict_types=1);

namespace Yard\Acf\Registrar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AcfServiceProvider extends PackageServiceProvider
{
	public function configurePackage(Package $package): void
	{
		$package
			->name('acf-registrar')
			->hasConfigFile();
	}

	public function packageRegistered(): void
	{
		$this->app->singleton(Registrar::class, fn () => new Registrar($this->app));
	}

	public function packageBooted(): void
	{
		$this->app->make(Registrar::class);
	}
}
