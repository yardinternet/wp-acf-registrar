<?php

declare(strict_types=1);

namespace Yard\Acf;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Yard\Acf\Console\AcfCommand;

class AcfServiceProvider extends PackageServiceProvider
{
	public function configurePackage(Package $package): void
	{
		$package
			->name('acf')
			->hasConfigFile();
	}

	public function packageRegistered(): void
	{
		$this->app->singleton(Acf::class, fn () => new Acf($this->app));
	}

	public function packageBooted(): void
	{
		$this->app->make(Acf::class);
	}
}
