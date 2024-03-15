<?php

declare(strict_types=1);

namespace FriendsOfHyva\CrawlerSession\Model;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class Logger extends \Monolog\Logger
{
    public function __construct()
    {
        parent::__construct('CrawlerSession', $this->initHandlers());
    }

    private function initHandlers(): array
    {
        return [
            (new StreamHandler(BP . '/var/log/crawler-session.log'))
                ->setFormatter(new LineFormatter("%datetime%: %message%\n", "Y-m-d H:i:s"))
        ];
    }
}