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
namespace Beecom\BetterSlider\Block\Adminhtml\Banner\Edit\Tab;

use Beecom\BetterSlider\Helper\Data;

class Banner extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Type options
     *
     * @var \Beecom\BetterSlider\Model\Banner\Source\Type
     */
    protected $typeOptions;

    /**
     * Status options
     *
     * @var \Beecom\BetterSlider\Model\Banner\Source\Status
     */
    protected $statusOptions;


    protected $helper;

    /**
     * constructor
     *
     * @param \Beecom\BetterSlider\Model\Banner\Source\Type $typeOptions
     * @param \Beecom\BetterSlider\Model\Banner\Source\Status $statusOptions
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Beecom\BetterSlider\Model\Banner\Source\Type $typeOptions,
        \Beecom\BetterSlider\Model\Banner\Source\Status $statusOptions,
        \Beecom\BetterSlider\Helper\Data $helper,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->typeOptions   = $typeOptions;
        $this->statusOptions = $statusOptions;
        $this->helper = $helper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Beecom\BetterSlider\Model\Banner $banner */
        $banner = $this->_coreRegistry->registry('beecom_betterslider_banner');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('banner_');
        $form->setFieldNameSuffix('banner');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Banner Information'),
                'class'  => 'fieldset-wide'
            ]
        );
        $fieldset->addType('image', 'Beecom\BetterSlider\Block\Adminhtml\Banner\Helper\Image');
        if ($banner->getId()) {
            $fieldset->addField(
                'banner_id',
                'hidden',
                ['name' => 'banner_id']
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
            'caption',
            'text',
            [
                'name'  => 'caption',
                'label' => __('Caption'),
                'title' => __('Caption')
            ]
        );

        $fieldset->addField(
            'caption_text',
            'text',
            [
                'name'  => 'caption_text',
                'label' => __('Caption text'),
                'title' => __('Caption text')
            ]
        );

        // $fieldset->addField(
        //     'upload_file',
        //     'image',
        //     [
        //         'name'  => 'upload_file',
        //         'label' => __('Upload File'),
        //         'title' => __('Upload File'),
        //     ]
        // );

        $fieldset->addField(
            'upload_file_phone',
            'image',
            [
                'name'  => 'upload_file_phone',
                'label' => __('Phone'),
                'title' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('phone_width'),
                $this->helper->getImageSizeConfig('phone_height')
                    ),
                'note' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('phone_width'),
                $this->helper->getImageSizeConfig('phone_height')
                    ),
            ]
        );

        $fieldset->addField(
            'upload_file_tablet_large',
            'image',
            [
                'name'  => 'upload_file_tablet_large',
                'label' => __('Tablet Large'),
                'title' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('tablet_large_width'),
                $this->helper->getImageSizeConfig('tablet_large_height')
                    ),
                'note' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('tablet_large_width'),
                $this->helper->getImageSizeConfig('tablet_large_height')
                    ),
            ]
        );
        $fieldset->addField(
            'upload_file_tablet_smaller',
            'image',
            [
                'name'  => 'upload_file_tablet_smaller',
                'label' => __('Tablet Smaller'),
                'title' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('tablet_smaller_width'),
                $this->helper->getImageSizeConfig('tablet_smaller_height')
                    ),
                'note' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('tablet_smaller_width'),
                $this->helper->getImageSizeConfig('tablet_smaller_height')
                    ),
            ]
        );

        $fieldset->addField(
            'upload_file_desktop_large',
            'image',
            [
                'name'  => 'upload_file_desktop_large',
                'label' => __('Desktop Large'),
                'title' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('desktop_large_width'),
                $this->helper->getImageSizeConfig('desktop_large_height')
                    ),
                'note' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('desktop_large_width'),
                $this->helper->getImageSizeConfig('desktop_large_height')
                    ),

            ]
        );
        $fieldset->addField(
            'upload_file_desktop_smaller',
            'image',
            [
                'name'  => 'upload_file_desktop_smaller',
                'label' => __('Desktop Smaller'),
                 'title' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('desktop_smaller_width'),
                $this->helper->getImageSizeConfig('desktop_smaller_height')
                    ),
                'note' => __('Requested dimensions: Width %1 px x Height %2 px',
                $this->helper->getImageSizeConfig('desktop_smaller_width'),
                $this->helper->getImageSizeConfig('desktop_smaller_height')
                    ),
            ]
        );


        $fieldset->addField(
            'url',
            'text',
            [
                'name'  => 'url',
                'label' => __('Banner Url'),
                'title' => __('Banner Url'),
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'  => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => $this->statusOptions->toOptionArray(),
            ]
        );

        $bannerData = $this->_session->getData('beecom_betterslider_banner_data', true);
        if ($bannerData) {
            $banner->addData($bannerData);
        } else {
            if (!$banner->getId()) {
                $banner->addData($banner->getDefaultValues());
            }
        }
        $form->addValues($banner->getData());
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
        return __('Banner');
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
