<?php

namespace Epartment\Widgets\Block\Adminhtml\Widgets\Edit;

class DeleteButton extends GenericButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        if ($this->getId()) {
            return [
                'label' => __('Delete widget'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this widget?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 80
            ];
        }

        return [];
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getId()]);
    }
}