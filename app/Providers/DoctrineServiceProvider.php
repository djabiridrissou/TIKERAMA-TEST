<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DoctrineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('doctrine', function () {
            return \Doctrine\DBAL\Tools\Console\ConsoleRunner::createHelperSet(
                \Doctrine\DBAL\Connection::create(
                    [
                        'driver' => 'pdo_mysql',
                        'host' => env('DB_HOST', '127.0.0.1'),
                        'port' => env('DB_PORT', '3306'),
                        'dbname' => env('DB_DATABASE', 'forge'),
                        'user' => env('DB_USERNAME', 'forge'),
                        'password' => env('DB_PASSWORD', ''),
                    ]
                )
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Enregistrer le type enum
        Type::addType('enum', 'Doctrine\DBAL\Types\StringType');
        AbstractPlatform::addTypeMapping('enum', 'string');
    }
}
