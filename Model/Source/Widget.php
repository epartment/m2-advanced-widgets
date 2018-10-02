<?php

namespace Epartment\Widgets\Model\Source;

class Widget implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Epartment\Widgets\Model\ResourceModel\Widget\CollectionFactory
     */
    private $widgetCollectionFactory;

    private $_options = null;

    public function __construct(\Epartment\Widgets\Model\ResourceModel\Widget\CollectionFactory $widgetCollectionFactory)
    {
        $this->widgetCollectionFactory = $widgetCollectionFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        if ($this->_options === null) {
            $widgets = $this->widgetCollectionFactory->create()->load();
            $this->_options = [];

            foreach ($widgets as $widget) {
                $this->_options[] = [
                    'value' => $widget->getId(),
                    'label' => $widget->getData('name')
                ];
            }

            array_unshift($this->_options, ['value' => '', 'label' => __('Please select a widget.')]);
        }
        return $this->_options;
    }
}