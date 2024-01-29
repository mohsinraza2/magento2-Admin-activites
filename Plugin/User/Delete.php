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
namespace Catgento\AdminActivity\Plugin\User;

/**
 * Class Delete
 * @package Catgento\AdminActivity\Plugin\User
 */
class Delete
{
    /**
     * @var \Catgento\AdminActivity\Helper\Benchmark
     */
    public $benchmark;

    /**
     * Delete constructor.
     * @param \Catgento\AdminActivity\Helper\Benchmark $benchmark
     */
    public function __construct(
        \Catgento\AdminActivity\Helper\Benchmark $benchmark
    ) {
        $this->benchmark = $benchmark;
    }
    /**
     * @param \Magento\User\Model\ResourceModel\User $user
     * @param callable $proceed
     * @param $object
     * @return mixed
     */
    public function aroundDelete(\Magento\User\Model\ResourceModel\User $user, callable $proceed, $object)
    {
        $this->benchmark->start(__METHOD__);
        $object->load($object->getId());

        $result = $proceed($object);
        $object->afterDelete();

        $this->benchmark->end(__METHOD__);
        return $result;
    }
}
