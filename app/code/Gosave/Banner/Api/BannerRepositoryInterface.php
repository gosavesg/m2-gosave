<?php

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

namespace GoSave\Banner\Api;

use GoSave\Banner\Model\Banner;

/**
 * Interface BannerRepositoryInterface
 * GoSave\Banner\Api
 */
interface BannerRepositoryInterface
{
    /**
     * Save model set data
     *
     * @param Banner $Banner
     * @return Banner
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(Banner $Banner);

    /**
     * Get model data by Model id
     *
     * @param int $id Model Id
     * @return Banner
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Delete model by source id
     *
     * @param int $id Model Id
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException|\Exception
     */
    public function deleteById($id);
}//end interface
