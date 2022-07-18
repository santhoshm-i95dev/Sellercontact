<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Controller\Adminhtml\Sellercontact;

class Edit extends \I95dev\Sellercontact\Controller\Adminhtml\Sellercontact
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\I95dev\Sellercontact\Model\Sellercontact::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Sellerform no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('i95dev_sellercontact', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Sellercontact') : __('New Sellerform'),
            $id ? __('Edit Sellercontact') : __('New Sellerform')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sellerforms'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Sellerform %1', $model->getId()) : __('New Sellercontact'));
        return $resultPage;
    }
}

