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
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * Gosave\Banner\Controller\Adminhtml\ManageBanner
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context     $context           Context
     * @param PageFactory $resultPageFactory PageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    } //end __construct()

    /**
     * Index action
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage  = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Gosave_Banner::gsmenu');
        $resultPage->getConfig()->getTitle()->prepend(__('Banners'));
        return $resultPage;
    } //end execute()
}//end class
