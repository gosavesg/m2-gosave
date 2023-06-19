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

namespace GoSave\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use GoSave\Banner\Model\Banner;
use GoSave\Banner\Model\ResourceModel\Banner as ResourceModel;

/**
 * Class Collection
 * GoSave\Banner\Model\ResourceModel\Banner
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Banner::class,
            ResourceModel::class
        );
    } //end _construct()
}//end class
