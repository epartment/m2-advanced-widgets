<?php

namespace Epartment\Widgets\Model\ResourceModel;

class Widget extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('epartment_widgets', 'id');
    }
}