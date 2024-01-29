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
namespace Catgento\AdminActivity\Api;

/**
 * Interface LoginRepositoryInterface
 * @package Catgento\AdminActivity\Api
 */
interface LoginRepositoryInterface
{
    /**
     * Set login data
     * @param $status
     * @param $type
     * @return mixed
     */
    public function addLog($status, $type);

    /**
     * Get all admin activity data before date
     * @param $endDate
     * @return mixed
     */
    public function getListBeforeDate($endDate);

    /**
     * Set login user
     * @param $user
     * @return mixed
     */
    public function setUser($user);
}
