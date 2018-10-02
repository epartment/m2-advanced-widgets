<?php

namespace Epartment\Widgets\Model\ResourceModel\Widget;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Epartment\Widgets\Model\Widget', 'Epartment\Widgets\Model\ResourceModel\Widget');
    }
}