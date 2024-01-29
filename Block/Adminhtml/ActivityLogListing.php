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

namespace Catgento\AdminActivity\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Catgento\AdminActivity\Api\ActivityRepositoryInterface;
use Catgento\AdminActivity\Helper\Browser;

/**
 * Class ActivityLogListing
 * @package Catgento\AdminActivity\Block\Adminhtml
 */
class ActivityLogListing extends Template
{
    /**
     * @var ActivityRepositoryInterface
     */
    public $activityRepository;

    /**
     * @var Browser
     */
    public $browser;

    /**
     * Path to template file in theme.
     * @var string
     */
    public $_template = 'Catgento_AdminActivity::log_listing.phtml';

    /**
     * ActivityLogListing constructor.
     * @param Template\Context $context
     * @param ActivityRepositoryInterface $activityRepository
     * @param Browser $browser
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        ActivityRepositoryInterface $activityRepository,
        Browser $browser
    )
    {
        $this->activityRepository = $activityRepository;
        $this->browser = $browser;
        parent::__construct($context);
    }

    /**
     * Get admin activity log listing
     * @return array
     */
    public function getLogListing()
    {
        $id = $this->getRequest()->getParam('id');
        $data = $this->activityRepository->getActivityLog($id);
        return $data->getData();
    }

    /**
     * Get admin activity details
     * @return array
     */
    public function getAdminDetails()
    {
        $id = $this->getRequest()->getParam('id');
        $activity = $this->activityRepository->getActivityById($id);

        $this->browser->reset();
        $this->browser->setUserAgent($activity->getUserAgent());
        $browser = $this->browser->__toString();

        $logData = [];
        $logData['username'] = $activity->getUsername();
        $logData['module'] = $activity->getModule();
        $logData['name'] = $activity->getName();
        $logData['fullaction'] = $activity->getFullaction();
        $logData['browser'] = $browser;
        $logData['date'] = $activity->getUpdatedAt();
        return $logData;
    }

    /**
     * @param $newValue
     * @param $oldValue
     * @return int
     *
     * Legend of return values:
     * 0: Old value was modified
     * 1: Value was created
     * 2: Value was deleted
     */
    public function compareValues($newValue, $oldValue)
    {
        if ($oldValue === '' && $newValue !== null) {
            return 1;
        } else if ($oldValue !== null && $newValue === '') {
            return 2;
        } else {
            return 0;
        }
    }
}