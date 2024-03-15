<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Model\Service;

use FriendsOfHyva\CrawlerSession\Helper\Config;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

readonly class BlacklistService
{
    public function __construct(
        private Config $config,
        private CrawlerDetect $crawlerDetect
    ) {
    }

    public function isBlacklisted(string $userAgent): bool
    {
        if (in_array($userAgent, $this->config->getBlacklist())
            || $this->crawlerDetect->isCrawler($userAgent)
        ) {
            return true;
        }

        return false;
    }
}