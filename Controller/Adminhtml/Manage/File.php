<?php

namespace Epartment\Widgets\Controller\Adminhtml\Manage;

class File extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Epartment\Widgets\Model\WidgetFactory
     */
    private $widgetFactory;

    /**
     * @var \Epartment\Widgets\Model\Widget\FileProcessor
     */
    private $fileProcessor;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Epartment\Widgets\Model\Widget\FileProcessor $fileProcessor,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->fileProcessor = $fileProcessor;
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        try {
            $fileData = $this->flattenFileUpload();

            $result = $this->fileProcessor->saveFileToDir($fileData);

        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode(), 'exception' => $e];
        }
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }

    public function flattenFileUpload()
    {
        $fileData = $this->array_flat($_FILES);

        return [
            'name' => $fileData[array_keys($fileData)[0]],
            'type' => $fileData[array_keys($fileData)[1]],
            'tmp_name' => $fileData[array_keys($fileData)[2]],
            'error' => $fileData[array_keys($fileData)[3]],
            'size' => $fileData[array_keys($fileData)[4]],
        ];
    }

    public function array_flat($array, $prefix = '')
    {
        try {
            $result = array();

            foreach ($array as $key => $value) {
                $new_key = $prefix . (empty($prefix) ? '' : '.') . $key;

                if (is_array($value)) {
                    $result = array_merge($result, $this->array_flat($value, $new_key));
                } else {
                    $result[$new_key] = $value;
                }
            }

            return $result;
        } catch (\Exception $e) {
            return null;
        }
    }
}