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
use Catgento\AdminActivity\Api\ActivityRepositoryInterface;

/**
 * Class SaveBefore
 * @package Catgento\AdminActivity\Observer
 */
class SaveBefore implements ObserverInterface
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * @var \Catgento\AdminActivity\Model\Processor
     */
    public $processor;

    /**
     * @var ActivityRepositoryInterface
     */
    public $activityRepository;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * SaveBefore constructor.
     * @param Helper $helper
     * @param \Catgento\AdminActivity\Model\Processor $processor
     * @param ActivityRepositoryInterface $activityRepository
     * @param \Catgento\AdminActivity\Helper\Benchmark $banchmark
     */
    public function __construct(
        Helper $helper,
        \Catgento\AdminActivity\Model\Processor $processor,
        ActivityRepositoryInterface $activityRepository,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->helper = $helper;
        $this->processor = $processor;
        $this->activityRepository = $activityRepository;
        $this->benchmark = $benchmark;
    }

    /**
     * Save before
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
        if ($object->getId() == 0) {
            $object->setCheckIfIsNew(true);
        } else {
            $object->setCheckIfIsNew(false);
            if ($this->processor->validate($object)) {
                $origData = $object->getOrigData();
                if (!empty($origData)) {
                    return $observer;
                }
                $data = $this->activityRepository->getOldData($object);
                foreach ($data->getData() as $key => $value) {
                    $object->setOrigData($key, $value);
                }
            }
        }
        $this->benchmark->end(__METHOD__);
        return $observer;
    }
}
