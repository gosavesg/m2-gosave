<?php

declare(strict_types=1);
/**
 * GoSave_Banner
 *
 * @category  XML
 * @package   GoSave\Banner
 * @author    https://gosave.com.sg
 * @copyright 2023 Copyright GoSave Pvt Ltd, https://gosave.com.sg/
 * @license   https://gosave.com.sg/ Private
 */


namespace GoSave\Banner\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class ImageUploader
{
    /**
     * @param \Magento\Framework\Filesystem\Directory\WriteInterface $mediaDirectory
     */
    private $mediaDirectory;

    /**
     * @param UploaderFactory $uploaderFactory
     */
    private $uploaderFactory;

    /**
     * @param StoreManagerInterface $storeManager
     */
    private $storeManager;

    /**
     * @param string $localDirectory
     */
    const LOCAL_DIRECTORY_PATH = 'banner/images';

    /**
     * @param array $allowedExtensions
     */
    private $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];

    public function __construct(
        Filesystem            $filesystem,
        UploaderFactory       $uploaderFactory,
        StoreManagerInterface $storeManager,
    ) {
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
    }

    public function saveFile($fileId)
    {
        $localDir = self::LOCAL_DIRECTORY_PATH;
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions($this->allowedExtensions);
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(true);
        $uploader->setAllowCreateFolders(true);
        $result = $uploader->save($this->mediaDirectory->getAbsolutePath($localDir));
        if (!$result) {
            throw new LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }
        $result['url'] = $this->storeManager
            ->getStore()
            ->getBaseUrl(
                UrlInterface::URL_TYPE_MEDIA
            ) . $localDir . $result['file'];
        $result['name'] = ltrim($result['file'], '/');
        return $result;
    }
}
