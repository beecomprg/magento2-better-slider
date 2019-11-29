<?php
/**
 * Beecom_BetterSlider extension
 *                     NOTICE OF LICENSE
 *
 *                     This source file is subject to the Beecom License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.beecom.io/LICENSE.txt
 *
 *                     @category  Beecom
 *                     @package   Beecom_BetterSlider
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.beecom.io/LICENSE.txt
 */
namespace Beecom\BetterSlider\Model\Banner;

use Beecom\BetterSlider\Helper\Image as ImageHelper;

class Image
{
    protected $imageHelper;

    /**
     * Image factory
     * 
     * @var \Magento\Framework\Image\Factory
     */
    protected $imageFactory;

    /**
     * constructor
     *
     * @param ImageHelper $imageHelper
     * @param \Magento\Framework\Image\Factory $imageFactory
     */
    public function __construct(
        ImageHelper $imageHelper,
        \Magento\Framework\Image\Factory $imageFactory
        
    )
    {
        $this->imageHelper  = $imageHelper;
        $this->imageFactory = $imageFactory;
    }

    /**
     * get images base url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->imageHelper->getBaseUrl();
    }
    
    /**
     * get base image dir
     *
     * @return string
     */
    public function getBaseDir()
    {
        return $this->imageHelper->getBaseDir();
    }

    public function getImageFileDimension($filename) {
        
        if (file_exists($filename)) {
            $image = $this->imageFactory->create($filename);
            return [
                'width' => $image->getOriginalWidth(),
                'height' => $image->getOriginalHeight()
            ];
        }

        return null;
    }
}
