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
namespace Beecom\BetterSlider\Model;

use Beecom\BetterSlider\Helper\Image;

/**
 * @method Banner setName($name)
 * @method Banner setUploadFile($uploadFile)
 * @method Banner setUrl($url)
 * @method Banner setType($type)
 * @method Banner setStatus($status)
 * @method mixed getName()
 * // @method mixed getUploadFile()
 * @method mixed getUrl()
 * @method mixed getType()
 * @method mixed getStatus()
 * @method Banner setCreatedAt(\string $createdAt)
 * @method string getCreatedAt()
 * @method Banner setUpdatedAt(\string $updatedAt)
 * @method string getUpdatedAt()
 * @method Banner setSlidersData(array $data)
 * @method array getSlidersData()
 * @method Banner setIsChangedSliderList(\bool $flag)
 * @method bool getIsChangedSliderList()
 * @method Banner setAffectedSliderIds(array $ids)
 * @method bool getAffectedSliderIds()
 */
class Banner extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'beecom_betterslider_banner';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'beecom_betterslider_banner';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'beecom_betterslider_banner';

    /**
     * Slider Collection
     *
     * @var \Beecom\BetterSlider\Model\ResourceModel\Slider\Collection
     */
    protected $sliderCollection;

    /**
     * Slider Collection Factory
     *
     * @var \Beecom\BetterSlider\Model\ResourceModel\Slider\CollectionFactory
     */

    protected $imageModel;

    protected $imageHelper;

    /**
     * constructor
     *
     * @param \Beecom\BetterSlider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Beecom\BetterSlider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        Image $imageHelper,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->sliderCollectionFactory = $sliderCollectionFactory;
        $this->imageHelper = $imageHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Beecom\BetterSlider\Model\ResourceModel\Banner');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * get entity default values
     *
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        $values['type'] = '';
        return $values;
    }
    /**
     * @return array|mixed
     */
    public function getSlidersPosition()
    {
        if (!$this->getId()) {
            return [];
        }
        $array = $this->getData('sliders_position');
        if (is_null($array)) {
            $array = $this->getResource()->getSlidersPosition($this);
            $this->setData('sliders_position', $array);
        }
        return $array;
    }

    /**
     * @return \Beecom\BetterSlider\Model\ResourceModel\Slider\Collection
     */
    public function getSelectedSlidersCollection()
    {
        if (is_null($this->sliderCollection)) {
            $collection = $this->sliderCollectionFactory->create();
            $collection->join(
                'beecom_betterslider_banner_slider',
                'main_table.slider_id=beecom_betterslider_banner_slider.slider_id AND beecom_betterslider_banner_slider.banner_id=' . $this->getId(),
                ['position']
            );
            $collection->addFieldToFilter('status', 1);

            $this->sliderCollection = $collection;
        }
        return $this->sliderCollection;
    }

    /**
     * get full banner url
     * @return string
     */
    // public function getBannerImageUrl()
    // {
    //     return $this->imageHelper->getMediaUrl($this->getUploadFile());

    // }

    public function getBannerDesktopLargeUrl()
    {
        return $this->imageHelper->getMediaUrl($this->getUploadFileDesktopLarge());
    }

    public function getBannerDesktopSmallerUrl()
    {
        return $this->imageHelper->getMediaUrl($this->getUploadFileDesktopSmaller());
    }

    public function getBannerTabletLargeUrl()
    {
        return $this->imageHelper->getMediaUrl($this->getUploadFileTabletLarge());
    }

    public function getBannerTabletSmallerUrl()
    {
        return $this->imageHelper->getMediaUrl($this->getUploadFileTabletSmaller());
    }

    public function getBannerPhoneUrl()
    {
        return $this->imageHelper->getMediaUrl($this->getUploadFilePhone());
    }
}
