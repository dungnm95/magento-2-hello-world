<?php

namespace Excellence\Hello\Cron;
use \Psr\Log\LoggerInterface;


class Test
{
    protected $logger;


    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Cron Works');
    }

}