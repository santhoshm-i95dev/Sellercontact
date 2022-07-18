<?php

namespace I95dev\Sellercontact\Model\ResourceModel;

class Sellercontact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('i95dev_sellercontact', 'id');   //here "i95dev_sellercontact" is table name and "id" is the primary key of custom table
    }
}

