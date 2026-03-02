# Blitz Casino - Setup Guide

This guide will help you set up and run Blitz Casino locally and deploy it to production.

## Prerequisites

- **PHP** >= 7.2.5 (PHP 8.x recommended)
- **Composer** (PHP package manager)
- **Node.js** >= 14.x (v24.x recommended)
- **NPM** >= 6.x
- **MySQL** >= 5.7 or MySQL 8.x
- **Redis** server
- **Git**

## Quick Start (Local Development)

### 1. Clone the Repository

```bash
git clone https://github.com/RadicalCliffs/blitz-casino.git
cd blitz-casino
```

### 2. Install Dependencies

Install PHP dependencies:
```bash
composer install
```

Install Node.js dependencies:
```bash
npm install
```

### 3. Configure Environment

Copy the example environment file:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

### 4. Configure Database

Edit the `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blitz_casino
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database:
```bash
mysql -u root -p
CREATE DATABASE blitz_casino;
EXIT;
```

Import the database schema:
```bash
mysql -u your_username -p blitz_casino < database_schema.sql
```

Or run migrations (if available):
```bash
php artisan migrate
```

### 5. Configure Redis

Make sure Redis is running:
```bash
redis-server
```

Update `.env` if needed:
```
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 6. Build Frontend Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run production
```

### 7. Start the Application

**Terminal 1** - Start PHP server:
```bash
php artisan serve
```

**Terminal 2** - Start Node.js game server:
```bash
cd server
node app.js
```

**Terminal 3** - (Optional) Watch for asset changes:
```bash
npm run watch
```

### 8. Access the Application

Open your browser and visit:
```
http://localhost:8000
```

## Production Deployment

### Building for Production

1. Install dependencies (production only):
```bash
composer install --no-dev --optimize-autoloader
npm ci --production
```

2. Build optimized assets:
```bash
npm run production
```

3. Optimize Laravel:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Configuration

Set these in your production `.env`:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Netlify Deployment

If deploying to Netlify (for frontend assets):

1. Add `netlify.toml` configuration (if needed)
2. Set build command: `npm run production`
3. Set publish directory: `public`

### Security Considerations

1. **Never commit `.env` file** - It contains sensitive credentials
2. **Set strong APP_KEY** - Use `php artisan key:generate`
3. **Use HTTPS in production** - Set `SESSION_SECURE_COOKIE=true`
4. **Configure CORS properly** - Only allow trusted domains
5. **Keep dependencies updated** - Regularly run `npm audit` and `composer audit`

## Game Server Configuration

The Node.js game server (`server/app.js`) handles:
- WebSocket connections via Socket.IO
- Real-time game logic
- Random number generation (with optional Chainlink VRF)
- Database interactions via MySQL2

### Chainlink VRF (Optional)

For provably fair randomness, configure Chainlink VRF:

1. Set up a Chainlink VRF subscription
2. Add VRF configuration to `.env`:
```
VRF_ADMIN_WALLET=your_wallet_address
VRF_SUBSCRIPTION_ID=your_subscription_id
VRF_CONSUMER_CONTRACT=your_consumer_contract
VRF_COORDINATOR=coordinator_address
VRF_KEY_HASH_2GWEI=key_hash
VRF_KEY_HASH_30GWEI=key_hash
VRF_ADMIN_SECRET=your_private_key
```

**Note:** Keep VRF_ADMIN_SECRET secure! Never commit it to version control.

## Troubleshooting

### Dependencies Issues

If you encounter dependency issues:
```bash
# Clear npm cache
npm cache clean --force
rm -rf node_modules package-lock.json
npm install

# Clear composer cache
composer clear-cache
rm -rf vendor composer.lock
composer install
```

### Build Errors

If webpack build fails:
```bash
# Clear Laravel Mix cache
rm -rf public/js public/css public/mix-manifest.json
npm run production
```

### Database Connection Issues

- Check MySQL is running: `sudo systemctl status mysql`
- Verify credentials in `.env`
- Check firewall rules
- Ensure database exists

### Redis Connection Issues

- Check Redis is running: `redis-cli ping`
- Should return: `PONG`
- Update REDIS_HOST in `.env` if needed

### PHP Version Issues

If running PHP 8.x with Laravel 7:
- Some deprecation warnings are expected but won't break functionality
- Consider upgrading to Laravel 8+ for better PHP 8.x support

## Available NPM Scripts

- `npm run dev` - Build assets for development
- `npm run watch` - Watch and rebuild on file changes
- `npm run production` - Build optimized assets for production
- `npm run hot` - Hot module replacement for development

## Available Artisan Commands

- `php artisan serve` - Start development server
- `php artisan migrate` - Run database migrations
- `php artisan db:seed` - Seed the database
- `php artisan config:clear` - Clear config cache
- `php artisan cache:clear` - Clear application cache
- `php artisan queue:work` - Process queue jobs

## Support

For issues or questions:
- Check existing GitHub issues
- Review the main README.md
- Check Laravel documentation: https://laravel.com/docs/7.x

## License

MIT License - See LICENSE file for details
