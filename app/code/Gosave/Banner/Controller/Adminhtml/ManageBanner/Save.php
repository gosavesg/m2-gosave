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
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action as AppAction;
use Magento\Framework\Controller\ResultFactory;
use Gosave\Banner\Model\BannerFactory as BannerModel;
use Gosave\Banner\Model\ResourceModel\Banner as BannerResource;

/**
 * Class Save
 * Gosave\Banner\Controller\Adminhtml\ManageBanner
 */
class Save extends AppAction
{
    const EDIT_URL_PATH = 'banner/*/edit';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var BannerModel
     */
    private $bannerModel;

    /**
     * @var BannerResource
     */
    private $bannerResource;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @param Context                $context                Context
     * @param DataPersistorInterface $dataPersistor          DataPersistorInterface
     * @param BannerModel      $bannerModel      BannerModel
     * @param BannerResource   $bannerResource   BannerResource
     * @param ResultFactory          $resultFactory          ResultFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        BannerModel $bannerModel,
        BannerResource $bannerResource,
        ResultFactory $resultFactory
    ) {
        $this->dataPersistor  = $dataPersistor;
        $this->bannerModel    = $bannerModel;
        $this->bannerResource = $bannerResource;
        $this->resultFactory  = $resultFactory;
        parent::__construct($context);
    } //end __construct()

    /**
     * Save banner
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (empty($data)) {
            return $resultRedirect->setPath('*/*/');
        }
        $id = $data['id'] ?? '';
        $saveAndContintue = $this->getRequest()->getParam('back');
        try {
            $image = $data['image'] ?? [];
            unset($data['image']);
            if (!empty($image[0]['name'])) {
                $data['image'] = $image[0]['name'];
            }
            $this->dataPersistor->set('banner_data', $data);
            $Banner = $this->bannerModel->create();
            $Banner->setData($data);
            $this->bannerResource->save($Banner);
            $this->messageManager->addSuccessMessage(
                __('Banner has been saved successfully.')
            );
            $this->dataPersistor->clear('banner_data');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __($e->getMessage())
            );
        }
        if ($id && $saveAndContintue) {
            return $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
        }
        return $resultRedirect->setPath('*/*/');
    } //end execute()
}//end class
