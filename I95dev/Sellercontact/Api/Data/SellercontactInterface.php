<?php
declare(strict_types=1);

namespace I95dev\Sellercontact\Api\Data;

interface SellercontactInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
	const ID = 'id';
    const FIRST_NAME = 'first_name';
	const LAST_NAME = 'last_name';
    const CREATED_AT = 'created_at';
    const EMAIL = 'email';
    const PHONE = 'phone';


    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setId($id);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \I95dev\Sellercontact\Api\Data\SellercontactExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \I95dev\Sellercontact\Api\Data\SellercontactExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \I95dev\Sellercontact\Api\Data\SellercontactExtensionInterface $extensionAttributes
    );

    /**
     * Get first_name
     * @return string|null
     */
    public function getFirstName();

    /**
     * Set first_name
     * @param string $firstName
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setFirstName($firstName);

	/**
     * Get last_name
     * @return string|null
     */
    public function getLastName();

    /**
     * Set last_name
     * @param string $lastName
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setLastName($lastName);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setEmail($email);

	/**
     * Get phone
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     * @param string $phone
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setPhone($phone);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \I95dev\Sellercontact\Api\Data\SellercontactInterface
     */
    public function setCreatedAt($createdAt);
}

