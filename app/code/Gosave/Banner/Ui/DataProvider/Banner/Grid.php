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

namespace GoSave\Banner\Ui\DataProvider\Banner;

use GoSave\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class Grid
 * GoSave\Banner\Ui\DataProvider\Banner
 */
class Grid extends AbstractDataProvider
{
    /**
     * @var \GoSave\Banner\Model\ResourceModel\Banner\Collection
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
