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

namespace Gosave\Banner\Ui\DataProvider\Banner;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Gosave\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Gosave\Banner\Model\ImageUploader;
use Magento\Framework\UrlInterface;

/**
 * Class Edit
 * Gosave\Banner\Ui\DataProvider\Banner
 */
class Edit extends AbstractDataProvider
{
    /**
     * @var $loadedData
     */
    protected $loadedData;

    /**
     * @var \Gosave\Banner\Model\ResourceModel\SourceEndpoint\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param string                          $name                          string
     * @param string                          $primaryFieldName              string
     * @param string                          $requestFieldName              string
     * @param CollectionFactory               $collectionFactory             CollectionFactory
     * @param DataPersistorInterface          $dataPersistor                 DataPersistorInterface
     * @param StoreManagerInterface           $storeManager                  StoreManagerInterface
     * @param array                           $meta                          array
     * @param array                           $data                          array
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    } //end __construct()

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $model = $this->collection->setPageSize(1)->getFirstItem();
        $data = $this->dataPersistor->get('banner_data');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
        }
        $data = $model->getData();
        $this->setImageData($data);
        $this->loadedData[$model->getId()] = $data;
        $this->dataPersistor->clear('banner_data');
        return $this->loadedData;
    } //end getData()

    /**
     * Function to set image data
     */
    private function setImageData(&$data)
    {
        if (empty($data['image'])) {
            return;
        }
        $image = $data['image'];
        $data['image'] = [
            [
                'name' => $image,
                'url' => $this->getImageUrl($image)
            ]
        ];
    }

    /**
     * Function to retrieve image URL by given image name
     *
     * @param string $image
     *
     * @return string
     */
    private function getImageUrl($image)
    {
        $localDir = ImageUploader::LOCAL_DIRECTORY_PATH;
        return $this->storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $localDir . DIRECTORY_SEPARATOR . $image;
    }
}//end class
