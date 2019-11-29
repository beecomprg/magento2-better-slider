<?php
/**
 * Beecom_BetterSlider extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Beecom
 * @package        Beecom_BetterSlider
 * @copyright      Copyright (c) 2016
 * @author         Sam
 * @license        Beecom License
 */

namespace Beecom\BetterSlider\Block;

use Beecom\BetterSlider\Model\BannerFactory as BannerModelFactory;
use Beecom\BetterSlider\Model\SliderFactory as SliderModelFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Slider extends Template
{
    protected $sliderFactory;
    protected $bannerFactory;

    public function __construct(
        Context $context,
        SliderModelFactory $sliderFactory,
        BannerModelFactory $bannerFactory
    ) {
        $this->sliderFactory = $sliderFactory;
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
    }

    public function getBanners()
    {
        $sliderId = $this->getSliderId();
        $model = $this->sliderFactory->create()->load($sliderId);
        if ($model && $model->getId()) {
            $banners = $model->getSelectedBannersCollection();
            $banners->addFieldToFilter('status', 1);
            return $banners;
        } else {
            return [];
        }
    }

    public function showSlider()
    {
        $sliderId = $this->getSliderId();
        $model = $this->sliderFactory->create()->load($sliderId);
        if ($model && $model->getId()) {
            $status = $model->getStatus();
            if ($status==1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCaptionAlignment()
    {
        $sliderId = $this->getSliderId();
        $model = $this->sliderFactory->create()->load($sliderId);
        $return = $model->getCaptionAlignment();
        return $return;
    }

    public function getOwlConfig()
    {
        $sliderId = $this->getSliderId();
        $items      = ($this->getItems() && $this->getItems() > 1) ? $this->getItems() : 1;
        $model = $this->sliderFactory->create()->load($sliderId);
        $sliderConfig = json_decode($model->getConfigSerialized(), true) ?: [];
        $loop      = ($this->getItems() && $this->getItems() > 1);
        // if count equals number of items.. do not loop
        $loop = (isset($sliderConfig['loop'])) ? !($this->getItems() === (int) $sliderConfig['loop']) : $loop;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->create('\Psr\Log\LoggerInterface');
        $dologu = $items;
        $dologu = var_export($dologu, true);
        $logger->notice($dologu);

        $defaultConfig = [
      "nav" => "true",
      "loop"=> $loop,
      "autoplayTimeout"=>"5000",
      "lazyLoad"=> "true",
      "animateOut"=> "fadeOut",
      "items" => $items
    ];
        $owlCarouselJsonConfig['owlcarousel'] = array_merge($defaultConfig, $sliderConfig);
        return json_encode($owlCarouselJsonConfig);
    }
}
