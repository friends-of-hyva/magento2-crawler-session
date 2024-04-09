<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Plugin\Magento\Framework\Session;

use FriendsOfHyva\CrawlerSession\Model\Service\LogService;
use Magento\Framework\Session\SessionManager;
use Magento\Framework\App\Request\Http as HttpRequest;
use FriendsOfHyva\CrawlerSession\Helper\Config;
use FriendsOfHyva\CrawlerSession\Model\Service\BlacklistService;
use FriendsOfHyva\CrawlerSession\Model\Service\WhitelistService;

class SessionManagerPlugin
{
    public function __construct(
        private readonly Config $config,
        private readonly HttpRequest $httpRequest,
        private readonly BlacklistService $blacklistService,
        private readonly WhitelistService $whitelistService,
        private readonly LogService $logService,
    ) {
    }

    public function aroundStart(SessionManager $subject, callable $proceed)
    {
        $userAgent = $this->httpRequest->getServer('HTTP_USER_AGENT', '');

        if ($this->config->isEnabled() &&
            !$this->whitelistService->isWhitelisted($userAgent) &&
            $this->blacklistService->isBlacklisted($userAgent)
        ) {
            if ($this->config->isLogEnabled()) {
                $this->logService->log($userAgent);
            }

            return $subject;
        }

        return $proceed();
    }
}