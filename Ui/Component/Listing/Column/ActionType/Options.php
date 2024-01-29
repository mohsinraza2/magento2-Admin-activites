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
namespace Catgento\AdminActivity\Ui\Component\Listing\Column\ActionType;

/**
 * Class Options
 * @package Catgento\AdminActivity\Ui\Component\Listing\Column\ActionType
 */
class Options implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Catgento\AdminActivity\Helper\Data
     */
    public $helper;

    /**
     * Options constructor.
     * @param \Catgento\AdminActivity\Helper\Data $helper
     */
    public function __construct(\Catgento\AdminActivity\Helper\Data $helper)
    {
        $this->helper = $helper;
    }

    /**
     * List all option to get in filter
     * @return array
     */
    public function toOptionArray()
    {
        $data = [];
        $lableList = $this->helper->getAllActions();
        foreach ($lableList as $key => $value) {
            $data[] = ['value'=> $key,'label'=> __($value)];
        }
        return $data;
    }
}
