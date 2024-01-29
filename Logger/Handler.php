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
namespace Catgento\AdminActivity\Logger;

/**
 * Class Handler
 * @package Catgento\AdminActivity\Logger
 */
class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    public $loggerType = \Catgento\AdminActivity\Logger\Logger::INFO;

    /**
     * File name
     * @var string
     */
    public $fileName = '/var/log/adminactivity.log';
}
