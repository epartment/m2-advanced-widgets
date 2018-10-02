<?php

namespace Epartment\Widgets\Model;

class Widget extends \Magento\Framework\Model\AbstractModel implements \Epartment\Widgets\Api\Data\WidgetInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'epartment_widgets_widget';
    protected $_cacheTag = 'epartment_widgets_widget';
    protected $_eventPrefix = 'epartment_widgets_widget';

    protected function _construct()
    {
        $this->_init('Epartment\Widgets\Model\ResourceModel\Widget');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}