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
namespace Catgento\AdminActivity\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class LoadAfter
 * @package Catgento\AdminActivity\Observer
 */
class LoadAfter implements ObserverInterface
{
    /**
     * @var \Catgento\AdminActivity\Model\Processor
     */
    private $processor;

    /**
     * @var \Catgento\AdminActivity\Helper\Data
     */
    public $helper;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * LoadAfter constructor.
     * @param \Catgento\AdminActivity\Model\Processor $processor
     * @param \Catgento\AdminActivity\Helper\Data $helper
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        \Catgento\AdminActivity\Model\Processor $processor,
        \Catgento\AdminActivity\Helper\Data $helper,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->processor = $processor;
        $this->helper = $helper;
        $this->benchmark = $benchmark;
    }

    /**
     * Delete after
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Event\Observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->benchmark->start(__METHOD__);
        if (!$this->helper->isEnable()) {
            return $observer;
        }
        $object = $observer->getEvent()->getObject();
        $this->processor->modelLoadAfter($object);
        $this->benchmark->end(__METHOD__);
    }
}
