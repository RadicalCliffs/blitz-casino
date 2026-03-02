# Railway Deployment Guide

## Quick Deploy to Railway

1. **Connect Repository**: Link your GitHub repository to Railway
2. **Environment Variables**: Set these in Railway dashboard:
   - `APP_KEY` - Generate with `php artisan key:generate --show`
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `DB_CONNECTION=mysql`
   - `DB_HOST` - Railway MySQL host
   - `DB_PORT=3306`
   - `DB_DATABASE` - Your database name
   - `DB_USERNAME` - Database username
   - `DB_PASSWORD` - Database password
   - `REDIS_HOST` - Railway Redis host (if using Redis)
   - `REDIS_PASSWORD` - Redis password
   - `REDIS_PORT=6379`

3. **Add Services**:
   - MySQL database
   - Redis (optional but recommended)

4. **Deploy**: Railway will automatically build and deploy using the `nixpacks.toml` configuration

## Post-Deployment

After first deployment, run migrations:
```bash
# In Railway shell or via CLI
php artisan migrate --force
```

## Node.js Game Server

The Node.js game server needs to run separately. In Railway:
1. Add a new service
2. Point to the same repository
3. Use custom start command: `node server/server.js`
4. Set environment variable: `PORT=2083` (or any available port)

## Configuration Files

- `nixpacks.toml` - Build and runtime configuration for Railway
- `Procfile` - Defines how to start the web process
- `composer.json` - PHP dependencies and version requirements

## Troubleshooting

### Build fails with PHP version error
- Make sure composer.json has valid PHP version constraint
- Current requirement: `>=7.2.5 <8.4` (supports PHP 7.2.5+ through 8.3.x)

### App not loading
- Check environment variables are set
- Verify database connection
- Check logs in Railway dashboard

### Static assets not loading
- Run `npm run production` locally and commit built assets
- Or ensure build phase in nixpacks.toml completes successfully
