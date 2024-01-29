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
namespace Catgento\AdminActivity\Api\Activity;

/**
 * Interface ModelInterface
 * @package Catgento\AdminActivity\Api\Activity
 */
interface ModelInterface
{
    /**
     * Get old data
     * @param $model
     * @return mixed
     */
    public function getOldData($model);

    /**
     * Get edit data
     * @param $model
     * @return mixed
     */
    public function getEditData($model, $fieldArray);
}
