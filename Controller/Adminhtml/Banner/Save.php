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
namespace Beecom\BetterSlider\Controller\Adminhtml\Banner;

class Save extends \Beecom\BetterSlider\Controller\Adminhtml\Banner
{
    /**
     * Upload model
     *
     * @var \Beecom\BetterSlider\Model\Upload
     */
    protected $uploadModel;

    /**
     * Image model
     *
     * @var \Beecom\BetterSlider\Model\Banner\Image
     */
    protected $imageModel;

    /**
     * JS helper
     *
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;



    protected $helper;


    protected $messageManager;

    /**
     * constructor
     *
     * @param \Beecom\BetterSlider\Model\Upload $uploadModel
     * @param \Beecom\BetterSlider\Model\Banner\Image $imageModel
     * @param \Magento\Backend\Helper\Js $jsHelper
     * @param \Beecom\BetterSlider\Model\BannerFactory $bannerFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Beecom\BetterSlider\Model\Upload $uploadModel,
        \Beecom\BetterSlider\Model\Banner\Image $imageModel,
        \Magento\Backend\Helper\Js $jsHelper,
        \Beecom\BetterSlider\Helper\Data $helper,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Beecom\BetterSlider\Model\BannerFactory $bannerFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->uploadModel    = $uploadModel;
        $this->imageModel     = $imageModel;
        $this->jsHelper       = $jsHelper;
        $this->helper         = $helper;
        $this->messageManager = $messageManager;

        parent::__construct($bannerFactory, $registry, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('banner');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->filterData($data);
            $banner_name= $data['name'];
            $banner = $this->initBanner();
            $banner->setData($data);

            $upload_dir = $this->imageModel->getBaseDir();

            $uploadFilePhone = $this->uploadModel->uploadFileAndGetName('upload_file_phone', $upload_dir, $data);
            $uploadFileTabletLarge = $this->uploadModel->uploadFileAndGetName('upload_file_tablet_large', $upload_dir, $data);
            $uploadFileTabletSmaller = $this->uploadModel->uploadFileAndGetName('upload_file_tablet_smaller', $upload_dir, $data);
            $uploadFileDesktopLarge = $this->uploadModel->uploadFileAndGetName('upload_file_desktop_large', $upload_dir, $data);
            $uploadFileDesktopSmaller = $this->uploadModel->uploadFileAndGetName('upload_file_desktop_smaller', $upload_dir, $data);

            $ignore_key = [];

            // $banner_name
            // Phone
            if ($uploadFilePhone) {
                $imgPhoneDims = $this->imageModel->getImageFileDimension($upload_dir.$uploadFilePhone);
                $imgPhoneChecked =  $this->helper->checkImgPhone($imgPhoneDims);
                if ($imgPhoneDims ) {
                    if (!$imgPhoneChecked['save']) {
                        $uploadFilePhone = '';
                        $errormessage = $this->helper->getBannerNameText($banner_name).__($imgPhoneChecked['message']);
                        $this->messageManager->addError($errormessage);
                        $ignore_key[] = 'upload_file_phone';
                    }
                    else
                    {
                        // $this->messageManager->addNotice(__($imgPhoneChecked['message']));
                    }
                }
            }
            $banner->setUploadFilePhone($uploadFilePhone);



            // TabletLarge
            if ($uploadFileTabletLarge) {
                $imgTabletLargeDims = $this->imageModel->getImageFileDimension($upload_dir.$uploadFileTabletLarge);
                $imgTabletLargeChecked =  $this->helper->checkImgTabletLarge($imgTabletLargeDims);
                if ($imgTabletLargeDims) {
                    if (!$imgTabletLargeChecked['save']) {
                        $uploadFileTabletLarge = '';
                        $errormessage = $this->helper->getBannerNameText($banner_name).__($imgTabletLargeChecked['message']);
                        $this->messageManager->addError($errormessage);
                        $ignore_key[] = 'upload_file_tablet_large';
                    }
                    else
                    {
                        // $this->messageManager->addNotice(__($imgTabletLargeChecked['message']));
                    }
                }
            }
            $banner->setUploadFileTabletLarge($uploadFileTabletLarge);


            // TabletSmaller
            if ($uploadFileTabletSmaller) {
                $imgTabletSmallerDims = $this->imageModel->getImageFileDimension($upload_dir.$uploadFileTabletSmaller);
                $imgTabletSmallerChecked =  $this->helper->checkImgTabletSmaller($imgTabletSmallerDims);
                if ($imgTabletSmallerDims) {
                    if (!$imgTabletSmallerChecked['save']) {
                        $uploadFileTabletSmaller = '';
                        $errormessage = $this->helper->getBannerNameText($banner_name).__($imgTabletSmallerChecked['message']);
                        $this->messageManager->addError($errormessage);
                        $ignore_key[] = 'upload_file_tablet_smaller';
                    }
                    else
                    {
                        // $this->messageManager->addNotice(__($imgTabletSmallerChecked['message']));
                    }
                }
            }
            $banner->setUploadFileTabletSmaller($uploadFileTabletSmaller);


            // DesktopLarge
            if ($uploadFileDesktopLarge) {
                $imgDesktopLargeDims = $this->imageModel->getImageFileDimension($upload_dir.$uploadFileDesktopLarge);
                $imgDesktopLargeChecked =  $this->helper->checkImgDesktopLarge($imgDesktopLargeDims);
                if ($imgDesktopLargeDims) {
                    if (!$imgDesktopLargeChecked['save']) {
                        $uploadFileDesktopLarge = '';
                        $errormessage = $this->helper->getBannerNameText($banner_name).__($imgDesktopLargeChecked['message']);
                        $this->messageManager->addError($errormessage);
                        $ignore_key[] = 'upload_file_desktop_large';
                    }
                    else
                    {
                        // $this->messageManager->addNotice(__($imgDesktopLargeChecked['message']));
                    }
                }
            }
            $banner->setUploadFileDesktopLarge($uploadFileDesktopLarge);


            // DesktopSmaller
            if ($uploadFileDesktopSmaller) {
                $imgDesktopSmallerDims = $this->imageModel->getImageFileDimension($upload_dir.$uploadFileDesktopSmaller);
                $imgDesktopSmallerChecked =  $this->helper->checkImgDesktopSmaller($imgDesktopSmallerDims);
                if ($imgDesktopSmallerDims) {
                    if (!$imgDesktopSmallerChecked['save']) {
                        $uploadFileDesktopSmaller = '';
                        $errormessage = $this->helper->getBannerNameText($banner_name).__($imgDesktopSmallerChecked['message']);
                        $this->messageManager->addError($errormessage);
                        $ignore_key[] = 'upload_file_desktop_smaller';
                    }
                    else
                    {
                        // $this->messageManager->addNotice(__($imgDesktopSmallerChecked['message']));
                    }
                }
            }
            $banner->setUploadFileDesktopSmaller($uploadFileDesktopSmaller);

            $sliders = $this->getRequest()->getPost('sliders', -1);
            if ($sliders != -1) {
                $banner->setSlidersData($this->jsHelper->decodeGridSerializedInput($sliders));
            }

            $this->_eventManager->dispatch(
                'beecom_betterslider_banner_prepare_save',
                [
                    'banner' => $banner,
                    'request' => $this->getRequest()
                ]
            );

            try {
                // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                // $logger = $objectManager->create('\Psr\Log\LoggerInterface');
                // $logger->critical(var_export($ignore_key, 1));
                // $logger->critical('$data = '. var_export($data, 1));
                // $logger->critical(var_export($banner->getData(), 1));
                // $logger->critical(var_export($banner->getSlidersPosition(), 1));
                // $logger->critical('getSlidersData = '.var_export($banner->getSlidersData(), 1));

                // initial state
                $has_changed = false;


                // we are able to detect changes only and only if sliders data are sent from form
                if (is_array($banner->getSlidersData())) {

                    // new slider data from form
                    $sliders_data_new = array_map(
                                            function($i) {
                                                return $i['position'];
                                            },
                                            ($banner->getSlidersData() ? $banner->getSlidersData() : [])
                                        );

                    // previou slider data from db
                    $sliders_data_old = $banner->getSlidersPosition();

                    // we need to diffs both must be empty if no change
                    $sliders_diff_1 = array_diff_assoc($sliders_data_new, $sliders_data_old);
                    $sliders_diff_2 = array_diff_assoc($sliders_data_old, $sliders_data_new);

                    // $logger->critical(var_export([
                    //     '$sliders_data_old' => $sliders_data_old,
                    //     '$sliders_data_new' => $sliders_data_new,
                    //     '$sliders_diff_1'     => $sliders_diff_1,
                    //     '$sliders_diff_2'     => $sliders_diff_2
                    // ], 1));

                    // if any change then siders diff is not empty
                    if (empty($sliders_diff_1) && empty($sliders_diff_2)) {
                        $ignore_key[] = 'sliders_data';
                        $ignore_key[] = 'sliders_position';
                    } else {
                        // $logger->critical('sliders diffs');
                        $has_changed = true;
                    }
                } else {
                    $ignore_key[] = 'sliders_data';
                    $ignore_key[] = 'sliders_position';
                }

                // no change so far, check all other fields except ignored ones
                if (!$has_changed) {
                    foreach(array_keys($banner->getData()) as $key) {
                        if (in_array($key, $ignore_key)) {
                            // bypass invalid uploads
                            continue;
                        }
                        if ($banner->getData($key) != $banner->getOrigData($key)) {
                            // $logger->critical('diff: ' . var_export($key, 1));
                            $has_changed = true;
                            break;
                        }
                    }
                }

                // fine, we have a change, save it!
                if ($has_changed) {
                    $banner->save();
                    $this->messageManager->addSuccess(__('The Banner has been saved.'));
                } else {
                    $this->messageManager->addNotice(__('No change detected. Banner was not saved.'));
                }

                $this->_session->setBeecomBetterSliderBannerData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'beecom_betterslider/*/edit',
                        [
                            'banner_id' => $banner->getId(),
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
                $this->messageManager->addException($e, __('Something went wrong while saving the Banner.'));
            }
            $this->_getSession()->setBeecomBetterSliderBannerData($data);
            $resultRedirect->setPath(
                'beecom_betterslider/*/edit',
                [
                    'banner_id' => $banner->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('beecom_betterslider/*/');
        return $resultRedirect;
    }

    /**
     * filter values
     *
     * @param array $data
     * @return array
     */
    protected function filterData($data)
    {
        if (isset($data['status'])) {
            if (is_array($data['status'])) {
                $data['status'] = implode(',', $data['status']);
            }
        }
        return $data;
    }
}
