<?php

namespace Epartment\Widgets\Controller\Adminhtml\Manage;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    /**
     * @var \Epartment\Widgets\Model\WidgetFactory
     */
    private $widgetFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Epartment\Widgets\Model\WidgetFactory $widgetFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->widgetFactory = $widgetFactory;
    }

    public function execute()
    {
        $widget = null;
        if ($this->getRequest()->getParam('id')) {
            $widget = $this->widgetFactory->create()->load($this->getRequest()->getParam('id'));
            $widget->delete();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('epa_widgets/manage');

        return $resultRedirect;
    }
}