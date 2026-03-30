Production deployment notes
==========================

This file contains minimal steps and safe instructions for deploying the AEPS app to production.

1. Copy `.env.production` to the server as `.env` and fill production secrets.

2. Generate and set `APP_KEY` on the server (do not commit it):

   ```bash
   php artisan key:generate --show
   # copy the output and paste into APP_KEY in .env on the server
   ```

3. Install dependencies and build on the server (run as deploy user):

   ```bash
   composer install --no-dev --prefer-dist --optimize-autoloader
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan storage:link
   ```

4. Configure process manager for queue workers (example: `deploy/supervisor_aeps.conf`).

5. Use a secrets manager for credentials (Vault / Cloud secrets). Do not store secrets in the repo.

6. Add monitoring (Sentry/Datadog) and alerting for errors and queue failures.

Sentry setup (optional):

 - Install the Sentry DSN into your production `.env` as `SENTRY_DSN`.
 - Optionally run `php artisan sentry:publish --dsn="<your_dsn>" --with-send-default-pii` on the server to configure defaults.
 - Logs with level `error` and above will be sent to Sentry if `SENTRY_DSN` is set.
