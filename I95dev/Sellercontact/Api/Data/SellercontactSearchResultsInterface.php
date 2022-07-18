<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Api\Data;

interface SellercontactSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Sellercontact list.
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \I95dev\Sellercontact\Api\Data\SellercontactInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

