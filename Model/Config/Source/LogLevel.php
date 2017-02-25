<?php
/**
 * Source Model for Log Level System config
 *
 * @author     joshcarter <josh@webtise.com>
 */

namespace Webtise\BugSnag\Model\Config\Source;

class LogLevel implements \Magento\Framework\Option\ArrayInterface
{
	/**
	 * @return array
	 */
	public function toOptionArray()
	{
		return [
			['value' => 100, 'label' => 'DEBUG'],
			['value' => 200, 'label' => 'INFO'],
			['value' => 250, 'label' => 'NOTICE'],
			['value' => 300, 'label' => 'WARNING'],
			['value' => 400, 'label' => 'ERROR'],
			['value' => 500, 'label' => 'CRITICAL'],
			['value' => 550, 'label' => 'ALERT'],
			['value' => 600, 'label' => 'EMERGENCY']
		];
	}
}