# Porro connectors

Small, read-only connectors that send one signed report about a site to [Porro](https://porro.dev) on a schedule. They never change the site and never accept commands: Porro never connects into a site.

| Package | For | Install |
|---|---|---|
| [`porro/laravel-connector`](packages/laravel-connector) | Laravel 11–13 | `composer require porro/laravel-connector` then `php artisan porro:connect <site key>` |
| [`porro/filament-connector`](packages/filament-connector) | Filament 3–4 sites | `composer require porro/filament-connector` then `php artisan porro:connect <site key>` |
| [`porro/statamic-connector`](packages/statamic-connector) | Statamic 5–6 sites | `composer require porro/statamic-connector` then `php please porro:connect <site key>` |
| [`porro/php-core`](packages/php-core) | Shared by all of the above | — |

Craft CMS is next.

## What leaves a site

- Framework, CMS, PHP and package versions (names and versions from `composer.lock`; the list is only sent when the lock file changes)
- Whether debug mode is on, as true or false, never the value of any setting
- Scheduler heartbeat, failed jobs in the last 24 hours, pending migrations
- Newest backup date from `spatie/laravel-backup` and check results from `spatie/laravel-health`, if installed

## What never does

Content, entries, uploads, customer or user data, environment values or secrets. Run `php artisan porro:status --json` to see the exact report your site would send.

## How reports are signed

Your site key holds the private half of an Ed25519 key pair; Porro stores only the public half. Each report is signed over `"{timestamp}\n{nonce}\n{sha256 of body}"` and rejected outside a 5-minute window or if the nonce has been seen before. If `ext-sodium` isn't available, `paragonie/sodium_compat` provides it in pure PHP.

## Developing

```bash
composer install
composer test
```

Packages are developed here and split to read-only repositories for Packagist on each release.
