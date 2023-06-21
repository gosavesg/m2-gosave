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

namespace Gosave\Banner\Ui\Component\Listing\Column\Banner;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\UrlInterface;
use Gosave\Banner\Model\ImageUploader;

class Thumbnail extends Column
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface      $context,
        UiComponentFactory    $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array                 $components = [],
        array                 $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        $fieldName = $this->getData('name');
        foreach ($dataSource['data']['items'] as &$item) {
            $imageUrl = $this->getImageUrl($item[$fieldName]);
            $item[$fieldName . '_src'] = $imageUrl;
            $item[$fieldName . '_orig_src'] = $imageUrl;
        }
        return $dataSource;
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
        return $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $localDir . DIRECTORY_SEPARATOR . $image;
    }
}
