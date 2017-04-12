<?php
/**
 * Client for BugSnag
 * Extending from bugsnag-php (https://github.com/bugsnag/bugsnag-php)
 *
 * @author Josh Carter <josh@webtise.com>
 */
namespace Webtise\BugSnag\Bugsnag;

use Bugsnag\Client as BugSnag_Client;
use Webtise\BugSnag\Helper\Config;

class Client extends BugSnag_Client
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * Client constructor
     * Get API KEY from env.php and create instance of BugSnag_Client
     *
     * @param Config $config
     */
    public function __construct(
        Config $config
    )
    {
        $this->config = $config->getConfiguration();
        if($this->config) {
            parent::__construct($this->config, null, parent::makeGuzzle());
        }
    }

}