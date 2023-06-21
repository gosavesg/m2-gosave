<?php

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

namespace Gosave\Banner\Api;

use Gosave\Banner\Model\Banner;

/**
 * Interface BannerRepositoryInterface
 * Gosave\Banner\Api
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
