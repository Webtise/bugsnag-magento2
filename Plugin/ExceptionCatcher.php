<?php
/**
 * Created by PhpStorm.
 * User: joshcarter
 * Date: 11/04/2017
 * Time: 14:31
 */
namespace Webtise\BugSnag\Plugin;

use Magento\Framework\App\Http;
use Magento\Framework\App\Bootstrap;
use Webtise\BugSnag\Helper\Config;
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
        $client = new Client($this->config->getConfiguration(), null, Client::makeGuzzle());
        $client->notifyException($exception);
        return [$bootstrap, $exception];
    }
}