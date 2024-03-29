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
namespace Beecom\BetterSlider\Block\Adminhtml\Slider\Edit\Tab;

class Slider extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Status options
     *
     * @var \Beecom\BetterSlider\Model\Slider\Source\Status
     */
    protected $statusOptions;
    protected $alignOptions;

    /**
     * constructor
     *
     * @param \Beecom\BetterSlider\Model\Slider\Source\Status $statusOptions
     * @param \Beecom\BetterSlider\Model\Slider\Source\Align $alignOptions
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Beecom\BetterSlider\Model\Slider\Source\Status $statusOptions,
        \Beecom\BetterSlider\Model\Slider\Source\Align $alignOptions,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->statusOptions = $statusOptions;
        $this->alignOptions = $alignOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Beecom\BetterSlider\Model\Slider $slider */
        $slider = $this->_coreRegistry->registry('beecom_betterslider_slider');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('slider_');
        $form->setFieldNameSuffix('slider');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Slider Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        if ($slider->getId()) {
            $fieldset->addField(
                'slider_id',
                'hidden',
                ['name' => 'slider_id']
            );
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name'  => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'description',
            'textarea',
            [
                'name'  => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => array_merge(['' => ''], $this->statusOptions->toOptionArray()),
            ]
        );
        $fieldset->addField(
            'config_serialized',
            'textarea',
            [
                'name'  => 'config_serialized',
                'label' => __('Config'),
                'title' => __('Config'),
            ]
        );
        $fieldset->addField(
            'caption_alignment',
            'select',
            [
                'name'  => 'caption_alignment',
                'label' => __('Caption Alignment'),
                'title' => __('Caption Alignment'),
                'values' => array_merge(['' => ''], $this->alignOptions->toOptionArray()),
            ]
        );

        $sliderData = $this->_session->getData('beecom_betterslider_slider_data', true);
        if ($sliderData) {
            $slider->addData($sliderData);
        } else {
            if (!$slider->getId()) {
                $slider->addData($slider->getDefaultValues());
            }
        }
        $form->addValues($slider->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Slider');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
