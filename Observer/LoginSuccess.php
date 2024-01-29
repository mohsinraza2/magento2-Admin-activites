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
 * Class LoginSuccess
 * @package Catgento\AdminActivity\Observer
 */
class LoginSuccess implements ObserverInterface
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * @var \Catgento\AdminActivity\Api\LoginRepositoryInterface
     */
    public $loginRepository;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * LoginSuccess constructor.
     * @param Helper $helper
     * @param \Catgento\AdminActivity\Api\LoginRepositoryInterface $loginRepository
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        Helper $helper,
        \Catgento\AdminActivity\Api\LoginRepositoryInterface $loginRepository,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->helper = $helper;
        $this->loginRepository = $loginRepository;
        $this->benchmark = $benchmark;
    }
    
    /**
     * Login success
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->benchmark->start(__METHOD__);
        if (!$this->helper->isLoginEnable()) {
            return $observer;
        }
        
        $this->loginRepository
            ->setUser($observer->getUser())
            ->addSuccessLog();
        $this->benchmark->end(__METHOD__);
    }
}
