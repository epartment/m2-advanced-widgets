<?php

namespace Epartment\Widgets\Block\Adminhtml\Widgets\Edit;

class GenericButton
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    private $urlBuilder;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getId()
    {
        $widget = $this->registry->registry('widget');
        return $widget ? $widget->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}