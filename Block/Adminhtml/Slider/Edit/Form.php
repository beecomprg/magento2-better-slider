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
namespace Beecom\BetterSlider\Block\Adminhtml\Slider\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
