<?php

declare(strict_types=1);
/**
 * GoSave_Banner
 * 
 * PHP Version 8.x
 *
 * @category  PHP
 * @package   GoSave\Banner
 * @author    https://gosave.com.sg
 * @copyright 2023 Copyright GoSave Pvt Ltd, https://gosave.com.sg/
 * @license   https://gosave.com.sg/ Private
 */

namespace GoSave\Banner\Controller\Adminhtml\ManageBanner;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use GoSave\Banner\Api\BannerRepositoryInterface as BannerRepository;

/**
 * Class Delete
 * GoSave\Banner\Controller\Adminhtml\ManageBanner\Delete
 */
class Delete extends Action
{
    /**
     * @var RedirectFactory
     */
    protected $redirectFactory;

    /**
     * @var BannerRepository
     */
    protected $bannerRepository;

    /**
     * Save constructor.
     * @param Context $context Context
     * @param RedirectFactory $redirectFactory Redirect Factory
     * @param BannerRepository $bannerRepository BannerRepository
     */
    public function __construct(
        Context            $context,
        RedirectFactory    $redirectFactory,
        BannerRepository $bannerRepository
    ) {
        $this->redirectFactory = $redirectFactory;
        $this->bannerRepository = $bannerRepository;
        parent::__construct($context);
    } //end __construct()

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \DomainException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id', 0);
        if (!$id) {
            $this->_redirect('*/*/');
        }
        try {
            $this->bannerRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(
                __('Banner deleted successfully!')
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/');
    } //end execute()
}//end class
