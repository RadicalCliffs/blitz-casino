# PHP Compatibility Notes

## Supported PHP Versions

This application requires PHP **8.2.x only** (PHP 8.3+ is not supported).

The `composer.json` file explicitly declares support for PHP `>=8.2 <8.3` to ensure compatibility with modern deployment platforms like Railway.app while avoiding Laravel 7 compatibility issues with PHP 8.3+.

## Why PHP 8.2.x?

Laravel 7, while powerful, was released before PHP 8.3 and has compatibility issues with PHP 8.3's stricter type checking. To maintain a balance between modern PHP features and stability, this project requires:

- **Modern Platform Support**: Railway and other modern deployment platforms optimize for PHP 8.2
- **Security**: PHP 7.x and 8.0/8.1 are end-of-life and no longer receive security updates
- **Performance**: PHP 8.2 offers significant performance improvements over older versions
- **Dependency Compatibility**: The locked dependencies require PHP 8.2
- **Stability**: Laravel 7 is fully compatible with PHP 8.2 without modifications

**Current Recommendation:** Use PHP 8.2 for production deployments.

### Solutions

#### Use PHP 8.2 (Required)
```bash
# Install PHP 8.2
sudo apt-get install php8.2-cli php8.2-fpm php8.2-mysql php8.2-redis php8.2-xml php8.2-mbstring php8.2-curl

# Use PHP 8.2
php8.2 artisan serve
```

#### Use Docker with PHP 8.2
```bash
# Use official PHP 8.2 Docker image
docker run -it --rm -v $(pwd):/app -w /app php:8.2-cli php artisan serve
```

**Note:** PHP 8.3+ is not supported due to Laravel 7 compatibility issues with stricter type checking.

### Production Deployment

The application works in production environments where:
- PHP 8.2.x handles web requests via PHP-FPM
- The Node.js server handles game logic
- Assets are pre-built with `npm run production`

### Current Status

✅ **Web Application**: Works with PHP-FPM 8.2.x  
✅ **Node.js Game Server**: Fully functional  
✅ **Asset Building**: Works perfectly  
✅ **Database**: Compatible  
✅ **Artisan Commands**: Fully functional on PHP 8.2.x
❌ **PHP 8.3+**: Not supported due to Laravel 7 type compatibility issues

### For Development

Development requirements:
1. PHP 8.2.x (PHP 8.3+ not supported)
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
