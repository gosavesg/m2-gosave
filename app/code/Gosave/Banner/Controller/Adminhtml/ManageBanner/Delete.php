<?php

declare(strict_types=1);
/**
 * Gosave_Banner
 *
 * PHP Version 8.x
 *
 * @category  PHP
 * @package   Gosave\Banner
 * @author    https://Gosave.com.sg
 * @copyright 2023 Copyright Gosave Pvt Ltd, https://Gosave.com.sg/
 * @license   https://Gosave.com.sg/ Private
 */

namespace Gosave\Banner\Controller\Adminhtml\ManageBanner;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use Gosave\Banner\Api\BannerRepositoryInterface as BannerRepository;

/**
 * Class Delete
 * Gosave\Banner\Controller\Adminhtml\ManageBanner\Delete
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
