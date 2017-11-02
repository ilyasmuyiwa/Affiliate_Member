<?php
namespace Test\Affiliate\Model\ResourceModel;
 
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
/**
 * Department post mysql resource
 */
class Member extends AbstractDb
{
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('test_affliate_info', 'entity_id');
    }
 
}