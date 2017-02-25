<?php
/**
 * Adminhtml Test Event button block
 *
 * @author     joshcarter <josh@webtise.com>
 */
namespace Webtise\BugSnag\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;

class TestEvent extends Field
{
    /**
     * Test Event Button Label
     *
     * @var string
     */
    protected $_testButtonLabel = 'Fire Test Event';

    /**
     * API Key config path
     */
    const XML_PATH_API_KEY = 'bugsnag/settings/apikey';

    /**
     * Set Test Event Button Label
     *
     * @param string $testButtonLabel
     * @return \Webtise\BugSnag\Block\Adminhtml\System\Config\TestEvent
     */
    public function setTestButtonLabel($testButtonLabel)
    {
        $this->_testButtonLabel = $testButtonLabel;
        return $this;
    }

    /**
     * Set template for class
     *
     * @return \Webtise\BugSnag\Block\Adminhtml\System\Config\TestEvent
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('system/config/testevent.phtml');
        }
        return $this;
    }

    /**
     * Render button
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Get button content
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $originalData = $element->getOriginalData();
        $buttonLabel = !empty($originalData['button_label']) ? $originalData['button_label'] : $this->_testButtonLabel;
        $this->addData(
            [
                'button_label'  => __($buttonLabel),
                'html_id'       => $element->getHtmlId(),
                'ajax_url'      => $this->_urlBuilder->getUrl('bugsnag/system_config_testevent/test')
            ]
        );
        return $this->_toHtml();
    }

}