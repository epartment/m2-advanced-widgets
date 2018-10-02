<?php

namespace Epartment\Widgets\Block;

class Widget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    /**
     * @var \Epartment\Widgets\Model\Widget
     */
    private $widget;
    /**
     * @var \Epartment\Widgets\Model\Source\Widget\TypeFactory
     */
    private $widgetTypeFactory;
    /**
     * @var \Epartment\Widgets\Model\WidgetFactory
     */
    private $widgetFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Epartment\Widgets\Model\WidgetFactory $widgetFactory,
        \Epartment\Widgets\Model\Source\Widget\TypeFactory $widgetTypeFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->widgetTypeFactory = $widgetTypeFactory;
        $this->widgetFactory = $widgetFactory;
    }

    public function toHtml()
    {
        if (get_class($this) === self::class) {
            $this->widget = $this->widgetFactory->create()->load($this->getData('widget_id'));

            $widgetRegistrationParams = $this->widgetTypeFactory->create()->getRegisteredWidgetByType($this->widget->getData('type'));

            $widgetData = json_decode($this->widget->getData('configuration'), true);

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $widgetBlock = $objectManager->create($widgetRegistrationParams['block'], ['data' => $widgetData]);

            return $widgetBlock->toHtml();
        } else {
            return parent::toHtml();
        }
    }
}