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

use Gosave\Banner\Model\BannerFactory as BannerModelFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Gosave\Banner\Api\BannerRepositoryInterface;
use Gosave\Banner\Model\ResourceModel\BannerFactory as BannerResourceFactory;
use Gosave\Banner\Model\Banner as BannerModel;

/**
 * Class BannerRepository
 * Gosave\Banner\Model
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var \Gosave\Banner\Model\ResourceModel\Banner
     */
    protected $bannerResource;

    /**
     * @var BannerModel
     */
    protected $bannerModel;

    /**
     * @var array
     */
    private $sources = [];

    /**
     * BannerRepository constructor.
     *
     * @param BannerResourceFactory $bannerResourceFactory
     * @param BannerModelFactory $bannerModelFactory
     */
    public function __construct(
        BannerResourceFactory $bannerResourceFactory,
        BannerModelFactory $bannerModelFactory
    ) {
        $this->bannerResource = $bannerResourceFactory->create();
        $this->bannerModel = $bannerModelFactory->create();
    } //end __construct()

    /**
     * {@inheritDoc}
     */
    public function save(BannerModel $banner)
    {
        if ($banner->getId()) {
            $banner = $this->getById($banner->getId())->addData($banner->getData());
        }
        try {
            $this->bannerResource->save($banner);
            unset($this->sources[$banner->getId()]);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Unable to save banner %1', $banner->getId()));
        }

        return $banner;
    } //end save()

    /**
     * {@inheritDoc}
     */
    public function getById($id)
    {
        if (!isset($this->sources[$id])) {
            $this->bannerResource->load($this->bannerModel, $id);
            if (!$this->bannerModel->getId()) {
                throw new NoSuchEntityException(__('Banner with specified id "%1" not found.', $id));
            }
            $this->sources[$id] = $this->bannerModel;
        }

        return $this->sources[$id];
    } //end getById()


    /**
     * {@inheritDoc}
     */
    public function deleteById($id)
    {
        $this->bannerResource->load($this->bannerModel, $id);
        if (!$this->bannerModel->getId()) {
            throw new NoSuchEntityException(__('Banner with specified id "%1" not found.', $id));
        }
        $this->bannerResource->delete($this->bannerModel);
        unset($this->sources[$id]);
    } //end getById()
}//end class
