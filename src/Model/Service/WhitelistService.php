<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Model\Service;

use FriendsOfHyva\CrawlerSession\Helper\Config;

readonly class WhitelistService
{
    public function __construct(
        private Config $config
    ) {
    }

    public function isWhitelisted(string $userAgent): bool
    {
        if (in_array($userAgent, $this->config->getWhitelist())) {
            return true;
        }

        return false;
    }
}