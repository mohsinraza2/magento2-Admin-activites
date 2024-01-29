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
use \Catgento\AdminActivity\Helper\Data as Helper;

/**
 * Class PostDispatch
 * @package Catgento\AdminActivity\Observer
 */
class PostDispatch implements ObserverInterface
{
    /**
     * @var \Catgento\AdminActivity\Model\Processor
     */
    private $processor;

    /**
     * @var Helper
     */
    public $helper;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * PostDispatch constructor.
     * @param \Catgento\AdminActivity\Model\Processor $processor
     * @param Helper $helper
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        \Catgento\AdminActivity\Model\Processor $processor,
        Helper $helper,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->processor = $processor;
        $this->helper = $helper;
        $this->benchmark = $benchmark;
    }

    /**
     * Post dispatch
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Event\Observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->benchmark->start(__METHOD__);
        if (!$this->helper->isEnable()) {
            return $observer;
        }
        $this->processor->saveLogs();
        $this->benchmark->end(__METHOD__);
    }
}
