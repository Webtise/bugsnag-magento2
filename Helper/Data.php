<?php
/**
 * Webtise\BugSnag Helper Data
 *
 * @author     joshcarter <josh@webtise.com>
 */
namespace Webtise\BugSnag\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * Enabled/Disabled config path
     */
    const XML_PATH_ENABLED = 'bugsnag/settings/enable';

    /**
     * API Key config path
     */
    const XML_PATH_API_KEY = 'bugsnag/settings/apikey';

    /**
     * Severity config path
     */
    const XML_PATH_RELEASE_STAGE = 'bugsnag/settings/release_stage';

    /**
     * Log Level config path
     */
    const XML_PATH_LOG_LEVEL = 'bugsnag/settings/loglevel';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Data constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
        $this->scopeConfig = $context->getScopeConfig();
    }

    /**
     * Return Config value for enabled
     *
     * @return mixed
     */
    public function getIsEnabled()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return Config value for API Key
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return Config value for enabled
     *
     * @return mixed
     */
    public function getReleaseStage()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_RELEASE_STAGE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return Config value for MonoLog Log Level to send to BugSnag
     *
     * @return mixed
     */
    public function getLogLevel()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_LOG_LEVEL, ScopeInterface::SCOPE_STORE);
    }

}