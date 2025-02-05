<?php

namespace App\Providers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\MoleculeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\DraftProductRepositoryInterface;

use App\Repositories\CategoryRepository;
use App\Repositories\MoleculeRepository;
use App\Repositories\UserRepository;
use App\Repositories\DraftProductRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(MoleculeRepositoryInterface::class, MoleculeRepository::class);
        $this->app->bind(DraftProductRepositoryInterface::class, DraftProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
