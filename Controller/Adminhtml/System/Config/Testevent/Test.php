<?php
/**
 * Adminhtml Controller to fire test bugsnag event
 *
 * @author     joshcarter <josh@webtise.com>
 */
namespace Webtise\BugSnag\Controller\Adminhtml\System\Config\Testevent;

class Test extends \Magento\Backend\App\Action
{
    /**
     * Dispatch Event for BugSnag Test Event
     */
    public function execute()
    {
        $apiKey = $this->getRequest()->getParam('apiKey');
        $releaseStage = $this->getRequest()->getParam('releaseStage');
        $this->_eventManager->dispatch('bugsnag_test_event', [
            'api_key' => $apiKey,
            'release_stage' => $releaseStage
        ]);
        return;
    }
}