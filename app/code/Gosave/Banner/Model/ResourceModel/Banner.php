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

namespace GoSave\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Banner
 * GoSave\Banner\Model\ResourceModel
 */
class Banner extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('gs_banner', 'id');
    } //end _construct()
}//end class
