<?php

namespace Test\Affiliate\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;


use Test\Affiliate\Api\Data\MemberInterface;
use Test\Affiliate\Api\Data\MemberSearchResultInterface;
use Test\Affiliate\Api\Data\MemberSearchResultInterfaceFactory;
use Test\Affiliate\Api\MemberRepositoryInterface;
use Test\Affiliate\Model\ResourceModel\Member\CollectionFactory as MemberCollectionFactory;
use Test\Affiliate\Model\ResourceModel\Member\Collection;



class MemberRepository implements MemberRepositoryInterface
{
    /**
     * @var Member
     */
    private $memberFactory;
 
    /**
     * @var MemberCollectionFactory
     */
    private $memberCollectionFactory;
 
    /**
     * @var MemberSearchResultInterfaceFactory
     */
    private $searchResultFactory;
 
    public function __construct(
        Member $memberFactory,
        MemberCollectionFactory $memberCollectionFactory,
        MemberSearchResultInterfaceFactory $memberSearchResultInterfaceFactory
    ) {
        $this->memberFactory = $memberFactory;
        $this->memberCollectionFactory = $memberCollectionFactory;
        $this->searchResultFactory = $memberSearchResultInterfaceFactory;

    }


 
    // ... getById, save and delete methods listed above ...
 
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
    	
    		// if($searchCriteria = null) {
    		// 	die('null found');
    		// }

        $collection = $this->memberCollectionFactory->create();
 
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
 
        $collection->load();
 
        return $this->buildSearchResult($searchCriteria, $collection);
    }

    public function getLists()
    {
    	

        return $this->memberCollectionFactory->create()->getItems();
    }
 
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
 
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }
 
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
 
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();
 
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
 
        return $searchResults;
    }
}