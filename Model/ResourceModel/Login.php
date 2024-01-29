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
namespace Catgento\AdminActivity\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Login
 * @package Catgento\AdminActivity\Model\ResourceModel
 */
class Login extends AbstractDb
{

    /**
     * Initialize resource model
     * @return void
     */
    public function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('catgento_login_activity', 'entity_id');
    }
}
