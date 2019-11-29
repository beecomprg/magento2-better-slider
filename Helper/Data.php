<?php
namespace Beecom\BetterSlider\Helper;



class Data extends \Magento\Framework\App\Helper\AbstractHelper
{


    /**
     * @param null $store_id
     * @return bool
     */
    public function isEnabled($store_id = null)
    {
        //if ($store_id == null && $this->getStoreId() > 0) {
        //    $store_id = $this->getStoreId();
        //}

        return $this->scopeConfig->isSetFlag(
            'beecom_betterslider/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store_id
        );
    }


    /**
     * Get system config
     *
     * @param String path
     * @param \Magento\Store\Model\ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigValue($path, $store_id = null)
    {
        //return value from core config
        return $this->getScopeConfigValue($path,$store_id);
    }

    public function getImageSizeConfig($path, $store_id = null)
    {
        //return value from core config
        return $this->getScopeConfigValue("beecom_betterslider/image_size/{$path}",$store_id);
    }


    private function getScopeConfigValue($path, $store_id = null)
    {
        //use global store id
        //if ($store_id === null && $this->getStoreId() > 0) {
        //    $store_id = $this->getStoreId();
        //}

        //return value from core config
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store_id
        );
    }

    public function getBannerNameText($banner_name) {
        return "Banner '".$banner_name."' ";
    }


    public function checkImgPhone($imgDims) {
        $return = array('save'=>0,'message'=>'Phone image: Unknown Error');

        $requestedWidth = $this->getImageSizeConfig('phone_width');
        $requestedHeight = $this->getImageSizeConfig('phone_height');

        if (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Phone image: Both image dimensions do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Phone image: Image height do not match.');
            return $return;
        }
        elseif (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Phone image: Image width do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>1,'message'=>'Phone image: Image dimensions are correct.');
            return $return;
        }
        else
        {
            return $return; 
        }
    }



    public function checkImgTabletLarge($imgDims) {
        $return = array('save'=>0,'message'=>'Tablet Large image: Unknown Error');

        $requestedWidth = $this->getImageSizeConfig('tablet_large_width');
        $requestedHeight = $this->getImageSizeConfig('tablet_large_height');

        if (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Large image: Both image dimensions do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Large image: Image height do not match.');
            return $return;
        }
        elseif (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Large image: Image width do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>1,'message'=>'Tablet Large image: Image dimensions are correct.');
            return $return;
        }
        else
        {
            return $return; 
        }
    }

    public function checkImgTabletSmaller($imgDims) {
        $return = array('save'=>0,'message'=>'Tablet Smaller image: Unknown Error');

        $requestedWidth = $this->getImageSizeConfig('tablet_smaller_width');
        $requestedHeight = $this->getImageSizeConfig('tablet_smaller_height');

        if (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Smaller image: Both image dimensions do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Smaller image: Image height do not match.');
            return $return;
        }
        elseif (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Tablet Smaller image: Image width do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>1,'message'=>'Tablet Smaller image: Image dimensions are correct.');
            return $return;
        }
        else
        {
            return $return; 
        }
    }


    public function checkImgDesktopLarge($imgDims) {
        $return = array('save'=>0,'message'=>'Desktop Large image: Unknown Error');

        $requestedWidth = $this->getImageSizeConfig('desktop_large_width');
        $requestedHeight = $this->getImageSizeConfig('desktop_large_height');

        if (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Large image: Both image dimensions do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Large image: Image height do not match.');
            return $return;
        }
        elseif (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Large image: Image width do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>1,'message'=>'Desktop Large image: Image dimensions are correct.');
            return $return;
        }
        else
        {
            return $return; 
        }
    }


    public function checkImgDesktopSmaller($imgDims) {
        $return = array('save'=>0,'message'=>'Desktop Smaller image: Unknown Error');

        $requestedWidth = $this->getImageSizeConfig('desktop_smaller_width');
        $requestedHeight = $this->getImageSizeConfig('desktop_smaller_height');

        if (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Smaller image: Both image dimensions do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] != $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Smaller image: Image height do not match.');
            return $return;
        }
        elseif (($imgDims['width'] != $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>0,'message'=>'Desktop Smaller image: Image width do not match.');
            return $return;
        }
        elseif (($imgDims['width'] == $requestedWidth ) && ($imgDims['height'] == $requestedHeight)) {
            $return = array('save'=>1,'message'=>'Desktop Smaller image: Image dimensions are correct.');
            return $return;
        }
        else
        {
            return $return; 
        }
    }




}
