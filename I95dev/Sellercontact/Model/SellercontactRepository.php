<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Model;

use I95dev\Sellercontact\Api\SellercontactRepositoryInterface;
use I95dev\Sellercontact\Api\Data\SellercontactInterfaceFactory;
use I95dev\Sellercontact\Api\Data\SellercontactSearchResultsInterfaceFactory;
use I95dev\Sellercontact\Model\ResourceModel\Sellercontact as ResourceSellercontact;
use I95dev\Sellercontact\Model\ResourceModel\Sellercontact\CollectionFactory as SellercontactCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class SellercontactRepository implements SellercontactRepositoryInterface
{

    private $collectionProcessor;

    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;

    protected $sellercontactCollectionFactory;

    protected $sellercontactFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $dataSellercontactFactory;

    private $storeManager;


    /**
     * @param ResourceSellercontact $resource
     * @param SellercontactFactory $sellercontactFactory
     * @param SellercontactInterfaceFactory $dataSellercontactFactory
     * @param SellercontactCollectionFactory $sellercontactCollectionFactory
     * @param SellercontactSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceSellercontact $resource,
        SellercontactFactory $sellercontactFactory,
        SellercontactInterfaceFactory $dataSellercontactFactory,
        SellercontactCollectionFactory $sellercontactCollectionFactory,
        SellercontactSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->sellercontactFactory = $sellercontactFactory;
        $this->sellercontactCollectionFactory = $sellercontactCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSellercontactFactory = $dataSellercontactFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
    ) {
        /* if (empty($sellercontact->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $sellercontact->setStoreId($storeId);
        } */

        $sellercontactData = $this->extensibleDataObjectConverter->toNestedArray(
            $sellercontact,
            [],
            \I95dev\Sellercontact\Api\Data\SellercontactInterface::class
        );

        $sellercontactModel = $this-sellercontactFactory->create()->setData($sellercontactData);

        try {
            $this->resource->save($sellercontactModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sellercontact: %1',
                $exception->getMessage()
            ));
        }
        return $sellercontactModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($sellercontactId)
    {
        $sellercontact = $this->sellercontactFactory->create();
        $this->resource->load($sellercontact, $sellercontactId);
        if (!$sellercontact->getId()) {
            throw new NoSuchEntityException(__('Sellercontact with id "%1" does not exist.', $sellercontactId));
        }
        return $sellercontact->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sellercontactCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \I95dev\Sellercontact\Api\Data\SellercontactInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
    ) {
        try {
            $sellercontactModel = $this->sellercontactFactory->create();
            $this->resource->load($sellercontactModel, $sellercontact->getSellercontactId());
            $this->resource->delete($sellercontactModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Sellercontact: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sellercontactId)
    {
        return $this->delete($this->get($sellercontactId));
    }
}

