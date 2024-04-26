# Laravel Sqids - Hashids
A Sqids, Hashids bridge for Laravel.

This package uses the classes created by sqids.org

Generate hashes from numbers, like YouTube or Bitly. Use Sqids (hashids) when you do not want to expose your database ids to the user.

**Sqids** (pronounced "squids") is a small library that lets you generate unique IDs from numbers. It's good for link shortening, fast & URL-safe ID generation and decoding back into numbers for quicker database lookups.

## Features:

+ Encode multiple numbers - generate short IDs from one or several non-negative numbers
+ Quick decoding - easily decode IDs back into numbers
+ Unique IDs - generate unique IDs by shuffling the alphabet once
+ ID padding - provide minimum length to make IDs more uniform
+ URL safe - auto-generated IDs do not contain common profanity
+ Randomized output - Sequential input provides nonconsecutive IDs

## Use-cases

### Good for:

+ Generating IDs for public URLs (eg: link shortening)
+ Generating IDs for internal systems (eg: event tracking)
+ Decoding for quicker database lookups (eg: by primary keys)

### Not good for:

+ Sensitive data (this is not an encryption library)
+ User IDs (can be decoded revealing user count)

### Note

🚧 Because of the algorithm's design, multiple IDs can decode back into the same sequence of numbers. If it's important to your design that IDs are canonical, you have to manually re-encode decoded numbers and check that the generated ID matches.

---

// Encode integers.
`Sqids::encode(4815162342); //result: "kRN2UomKT9MV"`

// Decode strings.
`Sqids::decode('1LLb3b4ck');  //result: array [0 => 111843073722887]`

// Other example.
`$sqids = new SqidsFactory();`
`$sqids->encode(911); //result: "tcOyJwvFCuKy"`


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

// This example is simple:
`Sqids::decode('wellthatsreallyahugething'); //result: [0 => 9223372036854775807]`
`Sqids::encode(9223372036854775807);`

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