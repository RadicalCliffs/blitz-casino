# PHP Compatibility Notes

## Supported PHP Versions

This application supports PHP versions: **7.2.5 through 7.x, 8.0.x, 8.1.x, and 8.2.x**

The `composer.json` file explicitly declares support for these versions (`^7.2.5|^8.0|^8.1|^8.2`) to ensure compatibility with deployment platforms like Railway.app.

## Known Issues with Laravel 7 on PHP 8.3+

Laravel 7 was released before PHP 8.3 and has some compatibility issues. While the application runs successfully in production (as noted in the README), there are some type hint incompatibilities that cause errors with strict PHP 8.3+.

**Current Recommendation:** Use PHP 8.2 or earlier for best compatibility.

### Solutions

#### Option 1: Use PHP 7.4 or 8.0 (Recommended for Laravel 7)
```bash
# Install PHP 7.4 or 8.0
sudo apt-get install php7.4-cli php7.4-fpm
# Or
sudo apt-get install php8.0-cli php8.0-fpm

# Use specific PHP version
php7.4 artisan serve
# Or
php8.0 artisan serve
```

#### Option 2: Upgrade to Laravel 8 or Later
Laravel 8+ has better PHP 8.x support. However, this requires code changes.

#### Option 3: Use Composer's platform-check Workaround
Add to composer.json:
```json
"config": {
    "platform-check": false
}
```

Then run:
```bash
composer install --ignore-platform-reqs
```

### Production Deployment

The application works fine in production environments where:
- PHP-FPM handles web requests (doesn't use artisan commands)
- The Node.js server handles game logic
- Assets are pre-built with `npm run production`

### Current Status

✅ **Web Application**: Works with PHP-FPM  
✅ **Node.js Game Server**: Fully functional  
✅ **Asset Building**: Works perfectly  
✅ **Database**: Compatible  
⚠️ **Artisan Commands**: May have issues on PHP 8.3+

### For Development

If you encounter artisan errors on PHP 8.3:
1. Use Docker with PHP 8.0
2. Use a VM with PHP 8.0
3. Install PHP 8.0 alongside PHP 8.3
4. Rely on pre-built assets and direct database management

### Netlify Deployment

For Netlify (static site hosting):
1. Build assets locally or in CI: `npm run production`
2. Commit built assets to `public/` directory
3. Deploy `public/` folder to Netlify
4. Backend API/game server needs separate hosting (Node.js)

The Netlify build works because it only needs Node.js for asset compilation, not PHP for runtime.
