<?php
/**
 * Catgento
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 *
 * @category   Catgento
 * @package    Catgento_AdminActivity
 */
namespace Catgento\AdminActivity\Block\Adminhtml;

/**
 * Class Selector
 * @package Catgento\AdminActivity\Block\Adminhtml
 */
class Selector extends \Magento\Backend\Block\Template
{
    /**
     * Revert Activity Log action URL
     * @return string
     */
    public function getRevertUrl()
    {
        return $this->getUrl('adminactivity/activity/revert');
    }
}
