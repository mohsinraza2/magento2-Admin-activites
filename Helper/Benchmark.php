<?php
/**
 * Catgento
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customise this module for your needs.
 *
 * @category   Catgento
 * @package    Catgento_AdminActivity
 */
namespace Catgento\AdminActivity\Helper;

use Catgento\AdminActivity\Helper\Data as Helper;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Benchmark
 * @package Catgento\AdminActivity\Helper
 */
class Benchmark extends AbstractHelper
{
    /**
     * @var \Catgento\AdminActivity\Logger\Logger
     */
    public $logger;

    /**
     * @var String[] Start time of execution
     */
    public $startTime;

    /**
     * @var String[] End time of execution
     */
    public $endTime;
    /**
     * @var Data
     */
    private $helper;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Catgento\AdminActivity\Logger\Logger $logger
     * @param Data $helper
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Catgento\AdminActivity\Logger\Logger $logger,
        Helper $helper
    ) {
        $this->logger = $logger;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * log info about start time in millisecond
     * @param $method
     * @return void
     */
    public function start($method)
    {
        $this->reset($method);
        if ($this->helper->getConfigValue('BENCHMARK_ENABLE')) {
            $this->startTime[$method] = round(microtime(true) * 1000);
            $this->logger->info("Method: ". $method);
            $this->logger->info("Start time: ". $this->startTime[$method]);
            \Magento\Framework\Profiler::start($method);
        }
    }

    /**
     * log info about end time and time diiference in millisecond
     * @param $method
     * @return void
     */
    public function end($method)
    {
        if ($this->helper->getConfigValue('BENCHMARK_ENABLE')) {
            $this->endTime[$method] = round(microtime(true) * 1000);
            $difference = $this->endTime[$method] - $this->startTime[$method];
            if ($difference) {
                $this->logger->info("Method: ". $method);
                $this->logger->info("Ends time: ". $this->endTime[$method]);
                $this->logger->info("Time difference in millisecond: ". $difference);
            }
            \Magento\Framework\Profiler::stop($method);
        }
    }

    /**
     * Reset start time and end time
     * @param $method
     * @return void
     */
    public function reset($method)
    {
        $this->startTime[$method] = 0;
        $this->endTime[$method] = 0;
    }
}
