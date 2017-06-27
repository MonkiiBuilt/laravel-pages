# laravel-pages
Basic page system for Laravel 5.4.*

## Installation instructions

1. Add ```"monkiibuilt/laravel-pages": "dev-master",``` to the require array in composer.json
2. Update the respositories array in ```composer.json``` to include an entry for this packages repo:
```
"repositories": [
    // ...
    {
        "type": "package",
        "package": {
            "name": "MonkiiBuilt/laravel-pages",
            "version": "dev-master",
            "source": {
                "url": "https://github.com/MonkiiBuilt/laravel-pages.git",
                "type": "git",
                "reference": "master"
            },
            "autoload": {
                "classmap": [""]
            }
        }
    }
]
```

3. Then, update `config/app.php` by adding an entry for the service provider.
   
```php
'providers' => [
   // ...
   MonkiiBuilt\LaravelPages\ServiceProvider::class,
];
```

4. Run ```php artisan vendor:publish```

5. Run ```php artisan migrate```

6. Make sure you've followed all the installation instructions for [eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable)
