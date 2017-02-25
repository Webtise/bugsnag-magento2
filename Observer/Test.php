<?php
/**
 * Observer to fire test event to bugsnag
 *
 * @author     joshcarter <josh@webtise.com>
 */
namespace Webtise\BugSnag\Observer;

use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Validator\Exception;
use Bugsnag\Client;

class Test implements ObserverInterface
{
    /** @var \Bugsnag\Client  */
    protected $client;

    /** @var \Magento\Framework\App\ProductMetadataInterface  */
    protected $productMetadataInterface;

    /**
     * Init constructor.
     * @param ProductMetadataInterface $productMetadataInterface
     */
    public function __construct(
        ProductMetadataInterface $productMetadataInterface
    )
    {
        $this->productMetadataInterface = $productMetadataInterface;
    }

    /**
     * Observer method to fire test event to BugSnag
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     * @throws Exception
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $apiKey = $observer->getData('api_key');
        $releaseStage = $observer->getData('release_stage');

        if (strlen($apiKey) != 32) {
            throw new Exception("Invalid length of the API key");
        }

        $this->client = Client::make($apiKey);
        $this->client->getConfig()->setReleaseStage($releaseStage);
        $this->client->getConfig()->setAppVersion($this->productMetadataInterface->getVersion());
        $this->client->notifyError(
            "BugsnagTest M2",
            "Testing bugsnag M2"
        );
    }
}