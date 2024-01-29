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
 * Class LoginFailed
 * @package Catgento\AdminActivity\Observer
 */
class LoginFailed implements ObserverInterface
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * @var \Magento\User\Model\User
     */
    public $user;

    /**
     * @var \Catgento\AdminActivity\Api\LoginRepositoryInterface
     */
    public $loginRepository;

    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * LoginFailed constructor.
     * @param Helper $helper
     * @param \Magento\User\Model\User $user
     * @param \Catgento\AdminActivity\Api\LoginRepositoryInterface $loginRepository
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        Helper $helper,
        \Magento\User\Model\User $user,
        \Catgento\AdminActivity\Api\LoginRepositoryInterface $loginRepository,
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->helper = $helper;
        $this->user = $user;
        $this->loginRepository = $loginRepository;
        $this->benchmark = $benchmark;
    }

    /**
     * Login failed
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->benchmark->start(__METHOD__);
        if (!$this->helper->isLoginEnable()) {
            return $observer;
        }

        $user = null;
        if ($observer->getUserName()) {
            $user = $this->user->loadByUsername($observer->getUserName());
        }

        $this->loginRepository
            ->setUser($user)
            ->addFailedLog($observer->getException()->getMessage());
        $this->benchmark->end(__METHOD__);
    }
}
