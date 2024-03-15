<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Model\Service;

use FriendsOfHyva\CrawlerSession\Model\Logger;

class LogService
{
    private bool $alreadyLogged = false;

    public function __construct(
        private readonly Logger $logger,
    ) {
    }

    public function log(string $userAgent): void
    {
        if (!$this->alreadyLogged) {
            $this->logger->debug($userAgent);
            $this->alreadyLogged = true;
        }
    }
}