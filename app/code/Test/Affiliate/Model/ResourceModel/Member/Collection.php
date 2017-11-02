<?php
namespace Test\Affiliate\Model\ResourceModel\Member;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \Test\Affiliate\Model\Member::MEMBER_ID;
     
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Test\Affiliate\Model\Member', 
            'Test\Affiliate\Model\ResourceModel\Member');
    }
 
}