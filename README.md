# Blade Ionicons

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faisal50x/blade-ionicons.svg?style=flat-square)](https://packagist.org/packages/faisal50x/blade-ionicons)
[![Build Status](https://img.shields.io/travis/faisal50x/blade-ionicons/master.svg?style=flat-square)](https://travis-ci.org/faisal50x/blade-ionicons)
[![Quality Score](https://img.shields.io/scrutinizer/g/faisal50x/blade-ionicons.svg?style=flat-square)](https://scrutinizer-ci.com/g/faisal50x/blade-ionicons)
[![Total Downloads](https://img.shields.io/packagist/dt/faisal50x/blade-ionicons.svg?style=flat-square)](https://packagist.org/packages/faisal50x/blade-ionicons)

A package to easily make use of [Ionicons](https://ionicons.com) in your Laravel Blade views.

For a full list of available icons see [the SVG directory](./resources/svg). Ionicons are originally developed by [Ionic Framework Team](https://ionicframework.com).

## Requirements

- PHP 7.2 or higher
- Laravel 7.14 or higher
## Installation

You can install the package via composer:

```bash
composer require faisal50x/blade-ionicons
```

## Usage
Icons can be used a self-closing Blade components which will be compiled to SVG icons:

```blade
<x-ionicon-logo-apple/>
```

You can also pass classes to your icon components:

```blade
<x-ionicon-logo-apple class="w-6 h-6 text-gray-500"/>
```

And even use inline styles:

```blade
<x-ionicon-logo-apple style="color: #555"/>
```

### Raw SVG Icons

If you want to use the raw SVG icons as assets, you can publish them using:

```bash
php artisan vendor:publish --tag=blade-ionicons --force
```

Then use them in your views like:

```blade
<img src="{{ asset('vendor/blade-ionicons/logo-apple.svg') }}" width="10" height="10"/>
```

### Blade Icons

Blade ionicons uses Blade Icons under the hood. Please refer to [the Blade Icons readme](https://github.com/blade-ui-kit/blade-icons) for additional functionality.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email foysal20x@gmail.com instead of using the issue tracker.

## Maintainers
Blade Ionicons is developed and maintained by [Faisal Ahmed](https://linkedin.com/in/Faisal50x)

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
