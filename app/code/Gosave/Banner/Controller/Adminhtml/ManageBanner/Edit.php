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

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action as AppAction;
use Gosave\Banner\Api\BannerRepositoryInterface as BannerRepository;

/**
 * Class Edit
 * Gosave\Banner\Controller\Adminhtml\ManageBanner
 */
class Edit extends AppAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var BannerRepository
     */
    protected $bannerRepository;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Display the list of banners
     *
     * @param Context      $context           Context
     * @param PageFactory  $resultPageFactory PageFactory
     * @param BannerRepository $bannerRepository BannerRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BannerRepository $bannerRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->bannerRepository  = $bannerRepository;
    } //end __construct()

    /**
     * Edit source system
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id', false);
        if ($id) {
            $model = $this->bannerRepository->getById($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('The banner no longer exists.'));
                $this->_redirect('*/*/');
            }
        }
        try {
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('Gosave_Banner::gsmenu');
            $resultPage->getConfig()->getTitle()->prepend(__('Banner'));
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Banner - %1', $model->getName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
            $this->_redirect('*/*/index');
        }

        return $resultPage;
    } //end execute()
}//end class
