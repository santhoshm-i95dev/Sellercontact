<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Model;

use I95dev\Sellercontact\Api\Data\SellercontactInterface;
use I95dev\Sellercontact\Api\Data\SellercontactInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Sellercontact extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'i95dev_sellercontact';
    protected $dataObjectHelper;

    protected $sellercontactDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param SellercontactInterfaceFactory $sellercontactDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \I95dev\Sellercontact\Model\ResourceModel\Sellercontact $resource
     * @param \I95dev\Sellercontact\Model\ResourceModel\Sellercontact\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        SellercontactInterfaceFactory $sellercontactDataFactory,
        DataObjectHelper $dataObjectHelper,
        \I95dev\Sellercontact\Model\ResourceModel\Sellercontact $resource,
        \I95dev\Sellercontact\Model\ResourceModel\Sellercontact\Collection $resourceCollection,
        array $data = []
    ) {
        $this->sellercontactDataFactory = $sellercontactDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve sellercontact model with sellercontact data
     * @return SellercontactInterface
     */
    public function getDataModel()
    {
        $sellercontactData = $this->getData();

        $sellercontactDataObject = $this->sellercontactDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $sellercontactDataObject,
            $sellercontactData,
            SellercontactInterface::class
        );

        return $sellercontactDataObject;
    }
}

