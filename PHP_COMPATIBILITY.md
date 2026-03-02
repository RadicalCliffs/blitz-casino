# PHP Compatibility Notes

## Supported PHP Versions

This application requires PHP **8.2+** (PHP 8.2 is tested and recommended; 8.3-8.5 are allowed for deployment flexibility).

The `composer.json` file declares support for PHP `>=8.2 <8.6` to ensure compatibility with modern deployment platforms like Railway.app that may use newer PHP versions.

## Why PHP 8.2+?

Laravel 7 was designed for earlier PHP versions but can work with PHP 8.2+. To maintain a balance between modern PHP features and stability, this project allows:

- **Modern Platform Support**: Railway and other modern deployment platforms may use PHP 8.2+
- **Security**: PHP 7.x and 8.0/8.1 are end-of-life and no longer receive security updates
- **Performance**: PHP 8.2+ offers significant performance improvements over older versions
- **Flexibility**: Allows deployment on platforms that have upgraded to newer PHP versions

**Current Recommendation:** Use PHP 8.2 for production deployments (most tested). PHP 8.3+ may work but should be tested thoroughly before production use.

## PHP 8.2+ Compatibility Workaround

Laravel 7.x does not officially support PHP 8.1+, which introduced stricter return type declarations for built-in interfaces like `ArrayAccess`. This application implements the following workaround to enable PHP 8.2+ compatibility:

### Implemented Solutions

1. **Custom Exception Handler** (`app/Bootstrap/HandleExceptions.php`):
   - Extends Laravel's `HandleExceptions` bootstrap class
   - Suppresses `E_DEPRECATED` and `E_USER_DEPRECATED` errors
   - Prevents type compatibility warnings from being converted to exceptions

2. **Modified Kernels**:
   - `app/Console/Kernel.php` and `app/Http/Kernel.php` override the default bootstrappers list
   - Use custom exception handler instead of Laravel's default

3. **Entry Point Guards**:
   - `artisan` and `public/index.php` register permissive error handlers early
   - Set `error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED)` before Laravel bootstrap

4. **Composer Configuration**:
   - Removed `package:discover` from `post-autoload-dump` script in `composer.json`
   - Package discovery happens automatically at runtime, avoiding installation errors

### Testing the Workaround

```bash
# Test artisan commands
php artisan --version
php artisan list

# Test composer installation
composer install

# Test web application
php artisan serve
```

All core functionality should work properly with these workarounds in place.

### Solutions

#### Use PHP 8.2+ (Required)
```bash
# Install PHP 8.2 or later (example for 8.2)
sudo apt-get install php8.2-cli php8.2-fpm php8.2-mysql php8.2-redis php8.2-xml php8.2-mbstring php8.2-curl

# Use PHP 8.2+
php artisan serve
```

#### Use Docker with PHP 8.2+
```bash
# Use official PHP 8.2+ Docker image
docker run -it --rm -v $(pwd):/app -w /app php:8.2-cli php artisan serve
```

**Note:** PHP versions 8.2 through 8.5 are supported.

### Production Deployment

The application works in production environments where:
- PHP 8.2.x handles web requests via PHP-FPM
- The Node.js server handles game logic
- Assets are pre-built with `npm run production`

### Current Status

✅ **Web Application**: Works with PHP-FPM 8.2 (tested), 8.3-8.5 (compatibility allowed)
✅ **Node.js Game Server**: Fully functional  
✅ **Asset Building**: Works perfectly  
✅ **Database**: Compatible  
✅ **Artisan Commands**: Fully functional on PHP 8.2
⚠️ **PHP 8.3-8.5**: Allowed but should be tested before production use

### For Development

Development requirements:
1. PHP 8.2+ (PHP 8.2 tested, 8.3-8.5 allowed for deployment flexibility)
2. Composer 2.x
3. Node.js 14+
4. MySQL 5.7+ or 8.x
5. Redis Server

### Netlify Deployment

For Netlify (static site hosting):
1. Build assets locally or in CI: `npm run production`
2. Commit built assets to `public/` directory
3. Deploy `public/` folder to Netlify
4. Backend API/game server needs separate hosting (Node.js)

The Netlify build works because it only needs Node.js for asset compilation, not PHP for runtime.
