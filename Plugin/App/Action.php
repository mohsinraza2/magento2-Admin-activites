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
namespace Catgento\AdminActivity\Plugin\App;

/**
 * Class Action
 * @package Catgento\AdminActivity\Plugin\App
 */
class Action
{
    /**
     * @var \Catgento\AdminActivity\Model\Processor
     */
    public $processor;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * Action constructor.
     * @param \Catgento\AdminActivity\Model\Processor $processor
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        \Catgento\AdminActivity\Model\Processor $processor,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->processor = $processor;
        $this->benchmark = $benchmark;
    }

    /**
     * Get before dispatch data
     * @param \Magento\Framework\Interception\InterceptorInterface $controller
     * @return void
     */
    public function beforeDispatch(\Magento\Backend\App\AbstractAction $controller)
    {
        $this->benchmark->start(__METHOD__);
        $actionName = $controller->getRequest()->getActionName();
        $fullActionName = $controller->getRequest()->getFullActionName();

        $this->processor->init($fullActionName, $actionName);
        $this->processor->addPageVisitLog($controller->getRequest()->getModuleName());
        $this->benchmark->end(__METHOD__);
    }
}
