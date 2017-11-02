<?php

namespace Test\Affiliate\Api;
use Magento\Framework\Api\SearchCriteriaInterface;

use Test\Affiliate\Api\Data\Db\MemberInterface;


interface MemberRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Test\Affiliate\Api\Data\MemberSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * 
     * @return \Test\Affiliate\Api\Data\MemberInterface[]
     */

    public function getLists();

    
}
