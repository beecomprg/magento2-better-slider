<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Beecom\BetterSlider\Helper;

use Beecom\BetterSlider\Model\BannerFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Catalog image helper
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class Image extends AbstractHelper
{
    protected $_width;
    protected $_height;
    protected $storeManager;

    protected $subDir = 'banner_images';
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    public function __construct(
        Context $context,
        BannerFactory $bannerFactory,
        Filesystem $fileSystem,
        StoreManagerInterface $storeManager

    ) {
        $this->fileSystem    = $fileSystem;
        $this->bannerFactory = $bannerFactory;
        $this->storeManager  = $storeManager;
        parent::__construct($context);
    }

    public function getBaseUrl()
    {
        return $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $this->subDir;
    }

    public function getBaseMediaPath()
    {
        return $this->subDir . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getBaseMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $this->subDir;
    }

    public function getMediaUrl($file)
    {
        return $this->getBaseMediaUrl() . '/' . $this->_prepareFile($file);
    }

    /**
     * @param string $file
     * @return string
     */
    public function getMediaPath($file)
    {
        return $this->getBaseMediaPath() . '/' . $this->_prepareFile($file);
    }

    public function getBasedir()
    {
        if (!$this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)->isDirectory($this->subDir)) {
            $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->create($this->subDir);
        }
        return $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath($this->subDir);
    }

    protected function _prepareFile($file)
    {
        return ltrim(str_replace('\\', '/', $file), '/');
    }
}
