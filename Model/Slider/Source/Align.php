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
namespace Beecom\BetterSlider\Model\Slider\Source;

class Align implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => 'caption-align-center-middle',
                'label' => __('Center - Middle')
            ],
            [
                'value' => 'caption-align-center-top',
                'label' => __('Center - Top')
            ],
            [
                'value' => 'caption-align-right-top',
                'label' => __('Right - Top')
            ],
            [
                'value' => 'caption-align-right-middle',
                'label' => __('Right - Middle')
            ],
            [
                'value' => 'caption-align-right-bottom',
                'label' => __('Right - Bottom')
            ],
            [
                'value' => 'caption-align-center-bottom',
                'label' => __('Center - Bottom')
            ],
            [
                'value' => 'caption-align-left-bottom',
                'label' => __('Left - Bottom')
            ],
            [
                'value' => 'caption-align-left-middle',
                'label' => __('Left - Middle')
            ],
            [
                'value' => 'caption-align-left-top',
                'label' => __('Left - Top')
            ]

        ];
        return $options;
    }
}
