<?php

namespace Test\Affiliate\Api\Data;
 
use Magento\Framework\Api\SearchResultsInterface;
 
/**
 * Interface for preorder Complete search results.
 * @api
 */
interface MemberSearchResultInterface extends SearchResultsInterface
{
      /**
     * @return \Test\Affiliate\Api\Data\MemberInterface[]
     */
    public function getItems();
 
    /**
     * @param \Test\Affiliate\Api\Data\MemberInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}