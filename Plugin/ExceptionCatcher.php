<?php
/**
 * Plugin to catch any uncaught exceptions
 *
 * @author Josh Carter <josh@interjar.com>
 */
namespace Interjar\BugSnag\Plugin;

use Magento\Framework\App\Http;
use Magento\Framework\App\Bootstrap;
use Interjar\BugSnag\Helper\Config;
use Bugsnag\Client;

class ExceptionCatcher
{

    /**
     * Bugsnag Config Helper, used to create Bugsnag\Configuration Instance
     *
     * @var Config
     */
    protected $config;

    /**
     * ExceptionCatcher constructor
     *
     * @param Config $config
     */
    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
    }

    /**
     * Catch any exceptions and notify an instance of \Bugsnag\Client
     *
     * @param Http $subject
     * @param Bootstrap $bootstrap
     * @param \Exception $exception
     *
     * @return array
     */
    public function beforeCatchException(
        Http $subject,
        Bootstrap $bootstrap,
        \Exception $exception
    )
    {
        if($this->config->getConfiguration()) {
            $client = new Client($this->config->getConfiguration(), null, Client::makeGuzzle());
            $client->notifyException($exception);
        }
        return [$bootstrap, $exception];
    }
}