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
namespace Catgento\AdminActivity\Controller\Adminhtml\Activity;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;

/**
 * Class Revert
 * @package Catgento\AdminActivity\Controller\Adminhtml\Activity
 */
class Revert extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    public $resultJsonFactory;

    /**
     * @var \Catgento\AdminActivity\Model\Processor
     */
    public $processor;

    /**
     * Revert constructor.
     * @param Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Catgento\AdminActivity\Model\Processor $processor
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Catgento\AdminActivity\Model\Processor $processor
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->processor = $processor;
    }

    /**
     * Revert action
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $activityId = $this->getRequest()->getParam('id');
        $result = $this->processor->revertActivity($activityId);
        return $this->resultJsonFactory->create()->setData($result);
    }
}
