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

use GoSave\Banner\Model\BannerFactory as BannerModelFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use GoSave\Banner\Api\BannerRepositoryInterface;
use GoSave\Banner\Model\ResourceModel\BannerFactory as BannerResourceFactory;
use GoSave\Banner\Model\Banner as BannerModel;

/**
 * Class BannerRepository
 * GoSave\Banner\Model
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var \GoSave\Banner\Model\ResourceModel\Banner
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
