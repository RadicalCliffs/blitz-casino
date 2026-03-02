# PHP Compatibility Notes

## Supported PHP Versions

This application requires PHP **8.2+** (PHP 8.2 through 8.5 are supported).

The `composer.json` file explicitly declares support for PHP `>=8.2 <8.6` to ensure compatibility with modern deployment platforms like Railway.app.

## Why PHP 8.2+?

Laravel 7, while powerful, continues to work with modern PHP versions. To maintain a balance between modern PHP features and stability, this project supports:

- **Modern Platform Support**: Railway and other modern deployment platforms support PHP 8.2+
- **Security**: PHP 7.x and 8.0/8.1 are end-of-life and no longer receive security updates
- **Performance**: PHP 8.2+ offers significant performance improvements over older versions
- **Dependency Compatibility**: The locked dependencies work with PHP 8.2+
- **Stability**: Laravel 7 is compatible with PHP 8.2+ with proper configuration

**Current Recommendation:** Use PHP 8.2+ for production deployments.

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

✅ **Web Application**: Works with PHP-FPM 8.2+  
✅ **Node.js Game Server**: Fully functional  
✅ **Asset Building**: Works perfectly  
✅ **Database**: Compatible  
✅ **Artisan Commands**: Fully functional on PHP 8.2+
✅ **PHP 8.2-8.5**: Supported

### For Development

Development requirements:
1. PHP 8.2+ (PHP 8.2 through 8.5 supported)
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
