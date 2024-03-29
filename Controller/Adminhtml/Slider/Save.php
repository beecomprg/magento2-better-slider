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
namespace Beecom\BetterSlider\Controller\Adminhtml\Slider;

class Save extends \Beecom\BetterSlider\Controller\Adminhtml\Slider
{

    /**
     * JS helper
     *
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;

    /**
     * constructor
     *
     * @param \Magento\Backend\Helper\Js $jsHelper
     * @param \Beecom\BetterSlider\Model\SliderFactory $sliderFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Helper\Js $jsHelper,
        \Beecom\BetterSlider\Model\SliderFactory $sliderFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->jsHelper       = $jsHelper;
        parent::__construct($sliderFactory, $registry, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('slider');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $slider = $this->initSlider();
            //TODO FIXME test json string syntax here
            $slider->setData($data);
            $banners = $this->getRequest()->getPost('banners', -1);
            if ($banners != -1) {
                $slider->setBannersData($this->jsHelper->decodeGridSerializedInput($banners));
            }
            $this->_eventManager->dispatch(
                'beecom_betterslider_slider_prepare_save',
                [
                    'slider' => $slider,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $slider->save();
                $this->messageManager->addSuccess(__('The Slider has been saved.'));
                $this->_session->setBeecomBetterSliderSliderData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'beecom_betterslider/*/edit',
                        [
                            'slider_id' => $slider->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('beecom_betterslider/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Slider.'));
            }
            $this->_getSession()->setBeecomBetterSliderSliderData($data);
            $resultRedirect->setPath(
                'beecom_betterslider/*/edit',
                [
                    'slider_id' => $slider->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('beecom_betterslider/*/');
        return $resultRedirect;
    }
}
