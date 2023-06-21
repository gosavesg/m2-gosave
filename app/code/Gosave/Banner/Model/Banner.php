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

namespace Gosave\Banner\Model;

use Magento\Framework\Model\AbstractModel;
use Gosave\Banner\Model\ResourceModel\Banner as ResourceModel;

/**
 * Class Banner
 * Gosave\Banner\Model
 */
class Banner extends AbstractModel
{
    /**
     * Errors
     */
    const CACHE_TAG = 'banner';

    /**
     * @var string
     */
    protected $_cacheTag = [self::CACHE_TAG];

    /**
     * @var string
     */
    protected $_eventPrefix = 'banner';

    /**
     * @var string
     */
    protected $_eventObject = 'banner';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    } //end _construct()
}//end class
