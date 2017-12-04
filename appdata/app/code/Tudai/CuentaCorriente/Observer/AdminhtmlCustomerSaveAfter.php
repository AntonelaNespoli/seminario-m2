<?php 

namespace Tudai\CuantaCorriente\Observer;

use Magento\Framework\Event\Observer;
use \Magento\Framwork\Event\ObserverInterface;

class AdminhtmlCustomerSaveAfter
    implements ObserverInterface
{
    protected $logger;

    public function _construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Backend\Auth\Session $adminSession
    )
    {
        $this->logger = $logger;
        $this->adminSession = $adminSession;
    } 

    public function execute(\Magento\Framwork\Event\Observer $observer)
    {
        $customer = $observer->getData('customer');
        $customerName = $customer->getFirstname().' '.$customer->getLastname();
        $value = $customer->getCustomerAttribute('enable_customer_credit')->getValue();
        $adminUser = $this->adminSession->getUser()->getName();
        $this->logger->info(sprintf("OBSERVER -- %s Guardadocon valor %s por el administrados %s", $customerName, $value, $adminUser));
    }
}
