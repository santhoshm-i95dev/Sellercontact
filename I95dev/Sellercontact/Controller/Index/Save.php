<?php

namespace I95dev\Sellercontact\Controller\Index;

use Magento\Framework\App\Action\Context;
use I95dev\Sellercontact\Model\SellercontactFactory; //changes
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Framework\App\Action\Action
{
	/**
     * @var Sellercontact
     */
    protected $_sellercontact;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    public function __construct(
		Context $context,
        SellercontactFactory $sellercontact, //changes
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->_sellercontact = $sellercontact;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }
	public function execute()
    {
    	if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        //$data = $this->getRequest()->getParams();
        $data = $this->validatedParams();

    	$sellercontact = $this->_sellercontact->create();
        $sellercontact->setData($data);
        if($sellercontact->save()){
            $this->messageManager->addSuccessMessage(__('Data Saved Successfully.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('sellercontact');
        return $resultRedirect;
    }
/**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('first_name')) === '') {
            throw new LocalizedException(__('Enter the First Name and try again.'));
        }
		if (trim($request->getParam('last_name')) === '') {
            throw new LocalizedException(__('Enter the Last Name and try again.'));
        }
		if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
		if (trim($request->getParam('phone')) === '') {
            throw new LocalizedException(__('Enter the Phone Number and try again.'));
        }

        return $request->getParams();
    }
}
