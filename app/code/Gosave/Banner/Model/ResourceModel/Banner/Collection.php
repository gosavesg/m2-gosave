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

namespace Gosave\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Gosave\Banner\Model\Banner;
use Gosave\Banner\Model\ResourceModel\Banner as ResourceModel;

/**
 * Class Collection
 * Gosave\Banner\Model\ResourceModel\Banner
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
