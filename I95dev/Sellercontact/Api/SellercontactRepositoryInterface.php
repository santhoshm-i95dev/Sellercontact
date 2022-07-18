<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SellercontactRepositoryInterface
{

    /**
     * Save Sellercontact
     * @param \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
    );

    /**
     * Retrieve Sellercontact
     * @param string $sellercontactId
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     * @throws \I95dev\Sellercontact\Exception\LocalizedException
     */
    public function get($sellercontactId);

    /**
     * Retrieve Sellercontact matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \I95dev\Sellercontact\Api\Data\SellercontactSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Sellercontact
     * @param \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \I95dev\Sellercontact\Api\Data\SellercontactInterface $sellercontact
    );

    /**
     * Delete Sellercontact by ID
     * @param string $sellercontactId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sellercontactId);
}

