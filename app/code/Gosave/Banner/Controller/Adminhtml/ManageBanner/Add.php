<?php

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

/**
 * Class Add
 * Gosave\Banner\Controller\Adminhtml\ManageBanner
 */
class Add extends AppAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction constructor.
     * @param Context        $context              Context
     * @param PageFactory    $resultPageFactory    Result Page
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    } //end __construct()

    /**
     * Create new banner
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Gosave_Banner::gsmenu');
        $resultPage->getConfig()->getTitle()->prepend(__('Banner'));
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Banner'));
        return $resultPage;
    } //end execute()
}//end class
