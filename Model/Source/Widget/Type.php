<?php

namespace Epartment\Widgets\Model\Source\Widget;

class Type implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\Event\Manager
     */
    private $eventManager;

    public function __construct(\Magento\Framework\Event\Manager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function toOptionArray()
    {
        $widgets = $this->getRegisteredWidgets();

        $options = [];
        foreach ($widgets as $widget) {
            $options[] = [
                'value' => $widget['type'],
                'label' => $widget['name']
            ];
        }

        return $options;
    }

    public function getRegisteredWidgets()
    {
        $widgets = [];
        $this->eventManager->dispatch('epa_widgets_collect_widgets', ['availableWidgets' => &$widgets]);

        return $widgets;
    }

    public function getRegisteredWidgetByType($type)
    {
        $widgets = $this->getRegisteredWidgets();

        $matchingWidgets = array_filter($widgets, function ($widget) use ($type) {
            return $widget['type'] === $type;
        });

        if (count($matchingWidgets) == 1) {
            return $matchingWidgets[array_keys($matchingWidgets)[0]];
        }

        return null;
    }
}