<?php

namespace Epartment\Widgets\Model\ResourceModel\Widget;

use Epartment\Widgets\Model\Widget;
use Epartment\Widgets\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            Widget::class,
            \Epartment\Widgets\Model\ResourceModel\Widget::class
        );
    }
}