# Laravel Sqids - Hashids
A Sqids, Hashids bridge for Laravel.

// Encode integers.
`Sqids::encode(4815162342);`

// Decode strings.
`Sqids::decode('1LLb3b4ck');`

// Dependency injection example.
`$hashidsManager->encode(911);`

## Installation
Require this package, with Composer, in the root directory of your project.

`composer require trianity/laravel-sqids`

## Configuration
Laravel Sqids no need any configuration. But you can publish the vendor assets:

`$ php artisan vendor:publish --tag=config-sqids`
This will create a config/sqids.php file in your app that you can modify to set your configuration.

## Usage
Here you can see an example of you may use this package.

// You can alias this in config/app.php.
`use Trianity\Sqids\Facades\Sqids;`

// We're done here - how easy was that, it just works!
`Sqids::encode(4815162342);`

// This example is simple and there are far more methods available.
`Sqids::decode('doyouthinkthatsairyourebreathingnow');`

If you prefer to use dependency injection over facades, then you can inject the manager:

```
use Trianity\Sqids\SqidsFactory;

class Foo
{
    protected $sqids;

    public function __construct(SqidsFactory $sqids)
    {
        $this->sqids = $sqids;
    }

    public function bar(array $id)s
    {
        $this->sqids->encode($ids);
    }
}

App::make('Foo')->bar();
```

For more information on how to use the Sqids\Sqids class, check out the docs at [sqids/sqids](https://github.com/sqids/sqids-php).