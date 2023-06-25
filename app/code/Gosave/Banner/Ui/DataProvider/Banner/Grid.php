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

use Gosave\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class Grid
 * Gosave\Banner\Ui\DataProvider\Banner
 */
class Grid extends AbstractDataProvider
{
    /**
     * @var \Gosave\Banner\Model\ResourceModel\Banner\Collection
     */
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory CollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    } //end __construct()

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getData()
    {
        $items = [];
        foreach ($this->getCollection() as $order) {
            $items[] = $order->getData();
        }
        $totalSize = $this->getCollection()->getSize();
        return [
            'totalRecords' => $totalSize,
            'items' =>  $items,
        ];
    } //end getData()
}//end class
