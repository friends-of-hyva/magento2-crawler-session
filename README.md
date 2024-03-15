# Magento 2 - Crawler Session

## Prevent the crawler from creating a session!

It's insane how many requests are coming from crawlers & bots nowadays. Every request creates an unnecessary session.
If you block the SEO tools via robots.txt there are still plenty of search engines left. 100 requests per minute is not unusal.
This leads to a lot of sessions which could affect some limits like Redis "max_concurrency".

This module prevents the initiation of a session if a crawler is detected. The detection is based on:  

https://github.com/JayBizzle/Crawler-Detect

## Installation

Install the package via composer:

```bash
composer require friends-of-hyva/magento2-crawler-session

php bin/magento setup:upgrade
```

# Usage

After installation, you need to enable the module:

```
Stores > Configuration > General > Web > Prevent Crawler Session
```

## Configuration

### Enabled

If enabled, the detected crawler will no longer create a session.

### Additional Blacklist

If the provided list from crawlerdetect.io is not enough, you can define your own custom user agents here.

### Whitelist

For situations where you need to allow a user agent that is blacklisted, you can do so here.

### Log

If enabled all blocked user agents are logged to ```var/log/crawler-session.log```.
But this is only intended for temporary debugging purposes. The filesize can get big very fast!