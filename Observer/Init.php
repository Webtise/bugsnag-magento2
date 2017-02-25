<?php
/**
 * Observer to initialise bugsnag handler
 *
 * @author     joshcarter <josh@webtise.com>
 */

namespace Webtise\BugSnag\Observer;

use Psr\Log\LoggerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Webtise\BugSnag\Helper\Data;
use MeadSteve\MonoSnag\BugsnagHandler;
use Bugsnag\Client;

class Init implements ObserverInterface
{
    /** @var \Webtise\BugSnag\Helper\Data  */
    protected $helper;

    /** @var \Psr\Log\LoggerInterface  */
    protected $logger;

    /** @var \Magento\Customer\Model\Session  */
    protected $session;

    /** @var \Magento\Customer\Model\Customer  */
    protected $customer;

    /** @var \Bugsnag\Client  */
    protected $client;

    /** @var \Magento\Framework\App\ProductMetadataInterface  */
    protected $productMetadataInterface;

    /**
     * Init constructor.
     * @param LoggerInterface $logger
     * @param Data $helper
     * @param Session $session
     * @param ProductMetadataInterface $productMetadataInterface
     */
    public function __construct(
        LoggerInterface $logger,
        Data $helper,
        Session $session,
        ProductMetadataInterface $productMetadataInterface
    )
    {
        $this->logger = $logger;
        $this->helper = $helper;
        $this->session = $session;
        $this->customer = $this->session->getCustomer();
        $this->productMetadataInterface = $productMetadataInterface;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if($this->helper->getIsEnabled()) {
            $this->client = Client::make($this->helper->getApiKey());
            $this->addFurtherData();
            if($this->session->isLoggedIn()) {
                $this->setUserMetaData();
            }
            $this->logger->pushHandler(
                new BugsnagHandler(
                    $this->client,
                    $this->helper->getLogLevel(),
                    true
                )
            );
        }
    }

    /**
     * Set Further Data to BugSnag Client
     */
    public function addFurtherData()
    {
        $this->setReleaseData();
        $this->setVersion();
        if($this->session->isLoggedIn()) {
            $this->setUserMetaData();
        }
    }

    /**
     * Set Release Stage to BugSnag Client based on mode
     */
    public function setReleaseData()
    {
        $this->client->getConfig()->setReleaseStage($this->helper->getReleaseStage());
    }

    /**
     * Set Release Stage to BugSnag Client based on mode
     */
    public function setVersion()
    {
        $this->client->getConfig()->setAppVersion($this->productMetadataInterface->getVersion());
    }

    /**
     * Set User Data to BugSnag Client if logged in
     */
    public function setUserMetaData()
    {
        $this->client->registerCallback(function ($report) {
            $report->setUser([
                'id' => $this->customer->getId(),
                'name' => $this->customer->getName(),
                'email' => $this->customer->getEmail(),
            ]);
        });
    }
}