<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const XML_PATH_ENABLED = 'web/crawler_session/enabled';
    public const XML_PATH_BLACKLIST = 'web/crawler_session/blacklist';
    public const XML_PATH_WHITELIST = 'web/crawler_session/whitelist';
    public const XML_PATH_LOG_DEBUG = 'web/crawler_session/log_enabled';

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function isLogEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_LOG_DEBUG, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getBlacklist(?int $storeId = null): array
    {
        return $this->getList(self::XML_PATH_BLACKLIST, $storeId);
    }

    public function getWhitelist(?int $storeId = null): array
    {
        return $this->getList(self::XML_PATH_WHITELIST, $storeId);
    }

    private function getList(string $path, ?int $storeId): array
    {
        $value = (string)$this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId);

        $list = [];
        foreach (explode("\n", $value) as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            $list[] = $line;
        }

        return $list;
    }
}