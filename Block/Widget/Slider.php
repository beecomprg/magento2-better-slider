<?php

namespace Beecom\BetterSlider\Block\Widget;

use Magento\Widget\Block\BlockInterface;

/**
 * Widget
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Slider extends \Beecom\BetterSlider\Block\Slider implements BlockInterface
{
    protected $_template = "slider.phtml";

    protected function _beforeToHtml()
    {
        if ($this->getData('slider_id')) {
            $this->setSliderId($this->getData('slider_id'));
        }
        return parent::_beforeToHtml();
    }

    public function getOwlConfig()
    {
        $items      = ($this->getItems() && $this->getItems() > 1) ? $this->getItems() : 1;
        $sliderConfig = [];
        $loop      = false;
        $autoplay = $this->getData('autoplay') ?: false;
        if ($autoplay) {
            $loop = true;
        }

        $autoplayTimeout = $this->getData('autoplay_timeout') ?: 5;

        $defaultConfig = [
            'nav' => 'true',
            'loop' => $loop,
            'autoplayTimeout' => $autoplayTimeout * 1000,
            'lazyLoad' => 'true',
            'animateOut' => 'fadeOut',
            'items' => $items,
            'autoplay' => $autoplay
        ];
        $owlCarouselJsonConfig['owlcarousel'] = array_merge($defaultConfig, $sliderConfig);

        return json_encode($owlCarouselJsonConfig);
    }
}
