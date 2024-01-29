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
namespace Catgento\AdminActivity\Plugin;

use \Catgento\AdminActivity\Helper\Data as Helper;

/**
 * Class Auth
 * @package Catgento\AdminActivity\Plugin
 */
class Auth
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
     * Auth constructor.
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
     * Track admin logout activity
     * @param \Magento\Backend\Model\Auth $auth
     * @param callable $proceed
     * @return mixed
     */
    public function aroundLogout(\Magento\Backend\Model\Auth $auth, callable $proceed)
    {
        $this->benchmark->start(__METHOD__);
        if ($this->helper->isLoginEnable()) {
            $user = $auth->getAuthStorage()->getUser();
            $this->loginRepository->setUser($user)->addLogoutLog();
        }
        $result = $proceed();
        $this->benchmark->end(__METHOD__);
        return $result;
    }
}
