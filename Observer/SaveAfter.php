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
 * Class SaveAfter
 * @package Catgento\AdminActivity\Observer
 */
class SaveAfter implements ObserverInterface
{
    /**
     * @var string
     */
    const ACTION_MASSCANCEL = 'massCancel';

    /**
     * @var string
     */
    const SYSTEM_CONFIG = 'adminhtml_system_config_save';

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
     * SaveAfter constructor.
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
     * Save after
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Event\Observer|boolean
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->benchmark->start(__METHOD__);

        if (!$this->helper->isEnable()) {
            return $observer;
        }
        $object = $observer->getEvent()->getObject();
        if ($object->getCheckIfIsNew()) {
            if ($this->processor->initAction==self::SYSTEM_CONFIG) {
                $this->processor->modelEditAfter($object);
            }
            $this->processor->modelAddAfter($object);
        } else {
            if ($this->processor->validate($object)) {
                if ($this->processor->eventConfig['action']==self::ACTION_MASSCANCEL) {
                    $this->processor->modelDeleteAfter($object);
                }
                $this->processor->modelEditAfter($object);
            }
        }
        $this->benchmark->end(__METHOD__);
        return true;
    }
}
