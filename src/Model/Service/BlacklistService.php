<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Model\Service;

use FriendsOfHyva\CrawlerSession\Helper\Config;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class BlacklistService
{
    public function __construct(
        private readonly Config $config,
        private readonly CrawlerDetect $crawlerDetect
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