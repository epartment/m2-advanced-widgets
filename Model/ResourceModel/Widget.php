<?php

namespace Epartment\Widgets\Model\ResourceModel;

class Widget extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('epartment_widgets', 'id');
    }
}