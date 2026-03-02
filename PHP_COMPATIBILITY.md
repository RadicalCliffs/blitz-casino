# PHP Compatibility Notes

## Supported PHP Versions

This application requires PHP **8.2 or later**.

The `composer.json` file explicitly declares support for PHP `^8.2` to ensure compatibility with modern deployment platforms like Railway.app and to maintain security and performance standards.

## Why PHP 8.2+?

Laravel 7, while originally compatible with PHP 7.x, has been configured for this project to run on PHP 8.2+ for the following reasons:

- **Modern Platform Support**: Railway and other modern deployment platforms optimize for PHP 8.2+
- **Security**: PHP 7.x and 8.0/8.1 are end-of-life and no longer receive security updates
- **Performance**: PHP 8.2+ offers significant performance improvements
- **Dependency Compatibility**: The locked dependencies require PHP 8.2+

**Current Recommendation:** Use PHP 8.2 or PHP 8.3 for best compatibility and security.

### Solutions

#### Option 1: Use PHP 8.2+ (Recommended)
```bash
# Install PHP 8.2 or 8.3
sudo apt-get install php8.2-cli php8.2-fpm
# Or
sudo apt-get install php8.3-cli php8.3-fpm

# Use specific PHP version
php8.2 artisan serve
# Or
php8.3 artisan serve
```

#### Option 2: Use Docker with PHP 8.2+
```bash
# Use official PHP 8.2 or 8.3 Docker image
docker run -it --rm -v $(pwd):/app -w /app php:8.2-cli php artisan serve
```

### Production Deployment

The application works in production environments where:
- PHP 8.2+ handles web requests via PHP-FPM
- The Node.js server handles game logic
- Assets are pre-built with `npm run production`

### Current Status

✅ **Web Application**: Works with PHP-FPM 8.2+  
✅ **Node.js Game Server**: Fully functional  
✅ **Asset Building**: Works perfectly  
✅ **Database**: Compatible  
✅ **Artisan Commands**: Fully functional on PHP 8.2+

### For Development

Development requirements:
1. PHP 8.2 or PHP 8.3
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
