<?php

namespace Epartment\Widgets\Model\Widget;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Epartment\Widgets\Model\ResourceModel\Widget\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData = null;

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Epartment\Widgets\Model\ResourceModel\Widget\CollectionFactory $widgetCollectionFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $widgetCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        parent::getData();

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var \Epartment\Widgets\Model\Widget $widget */
        foreach ($items as $widget) {
            $this->loadedData[$widget->getId()] = array_merge([
                'id' => $widget->getId(),
                'name' => $widget->getData('name'),
                'type' => $widget->getData('type'),
                $widget->getData('type') => json_decode($widget->getData('configuration'), true)
            ], $this->getWidgetData($widget));
        }

        $data = $this->dataPersistor->get('widget');
        if (!empty($data)) {
            $widget = $this->collection->getNewEmptyItem();
            $widget->setData($data);
            $this->loadedData[$widget->getId()] = array_merge([
                'id' => $widget->getId(),
                'name' => $widget->getData('name'),
                'type' => $widget->getData('type'),
                $widget->getData('type') => json_decode($widget->getData('configuration'), true)
            ], $this->getWidgetData($widget));
            $this->dataPersistor->clear('widget');
        }

        return $this->loadedData;
    }

    public function getWidgetData($widget)
    {
        return ($widget->getData('configuration') !== null) ? json_decode($widget->getData('configuration'), true) : [];
    }
}