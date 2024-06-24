<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Book;
use App\Policies\BookPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
