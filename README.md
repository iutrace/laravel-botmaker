# Laravel Botmaker

A Laravel package for integrating with the Botmaker WhatsApp API.

## Requirements

- PHP 8.1 or higher
- Laravel 9.0 or higher (supports Laravel 9, 10, 11, and 12)

## Installation

1. Install the package via Composer:

```bash
composer require iutrace/laravel-botmaker
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="Iutrace\Botmaker\Providers\BotmakerServiceProvider" --tag="config"
```

3. Publish and run the migrations:

```bash
php artisan vendor:publish --provider="Iutrace\Botmaker\Providers\BotmakerServiceProvider" --tag="migrations"
php artisan migrate
```

4. Add the following environment variables to your `.env` file:

```env
BOTMAKER_BASE_URL=https://api.botmaker.com/
BOTMAKER_ACCESS_TOKEN=your-access-token
BOTMAKER_WHATSAPP_NUMBER=your-whatsapp-number
```

## Usage

### Using the Facade

```php
use Iutrace\Botmaker\Facades\Botmaker;

// List all WhatsApp templates
$templates = Botmaker::listWhatsappTemplates();

// Get a specific template
$template = Botmaker::getWhatsappTemplate('template-name');

// Create a new template
$newTemplate = Botmaker::createWhatsappTemplate([
    'name' => 'hello_world',
    'category' => 'MARKETING',
    'locale' => 'en_US',
    'body' => [
        'text' => 'Hello {{1}}!'
    ]
]);

// Delete a template
Botmaker::deleteWhatsappTemplate('template-name');
```

### Using the HasWhatsappTemplates Trait

Add the trait to your Eloquent models to associate WhatsApp templates:

```php
use Iutrace\Botmaker\Traits\HasWhatsappTemplates;

class User extends Authenticatable
{
    use HasWhatsappTemplates;
    
    // ... your model code
}
```

Then you can use:

```php
$user = User::find(1);
$templates = $user->whatsappTemplates;
```

### Events

The package dispatches the following events:

- `Iutrace\Botmaker\Events\WhatsappTemplate\Created`
- `Iutrace\Botmaker\Events\WhatsappTemplate\Updated`
- `Iutrace\Botmaker\Events\WhatsappTemplate\Deleted`

### Commands

Update WhatsApp template states:

```bash
php artisan botmaker:update-whatsapp-templates
```

## Upgrading from Laravel 8

If you're upgrading from Laravel 8, please note the following breaking changes:

1. **PHP Version**: Minimum PHP version is now 8.1
2. **Laravel Version**: Minimum Laravel version is now 9.0
3. **Migration Format**: Migrations now use anonymous classes (Laravel 9+ format)
4. **Type Hints**: All methods now use proper return type hints

### Upgrade Steps

1. Update your `composer.json` to require this package version:

```bash
composer require iutrace/laravel-botmaker:^2.0
```

2. If you've published the migrations previously, you may need to republish them:

```bash
php artisan vendor:publish --provider="Iutrace\Botmaker\Providers\BotmakerServiceProvider" --tag="migrations" --force
```

3. Run any new migrations:

```bash
php artisan migrate
```

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Installation

You can install the package via Composer:

```bash
composer require iutrace/laravel-botmaker
```