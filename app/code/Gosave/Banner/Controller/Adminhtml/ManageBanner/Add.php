<?php

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

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action as AppAction;

/**
 * Class Add
 * GoSave\Banner\Controller\Adminhtml\ManageBanner
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
        $resultPage->setActiveMenu('GoSave_Banner::gsmenu');
        $resultPage->getConfig()->getTitle()->prepend(__('Banner'));
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Banner'));
        return $resultPage;
    } //end execute()
}//end class
