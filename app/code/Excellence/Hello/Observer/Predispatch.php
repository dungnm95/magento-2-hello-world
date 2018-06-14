<?php


namespace Excellence\Hello\Observer;

use \Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class Predispatch implements ObserverInterface
{

    protected $logger;


    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->logger->warning('ndlhs');
        //exit; un commet this to make sure event works
    }
}