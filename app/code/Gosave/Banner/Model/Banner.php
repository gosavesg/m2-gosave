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

namespace GoSave\Banner\Model;

use Magento\Framework\Model\AbstractModel;
use GoSave\Banner\Model\ResourceModel\Banner as ResourceModel;

/**
 * Class Banner
 * GoSave\Banner\Model
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
