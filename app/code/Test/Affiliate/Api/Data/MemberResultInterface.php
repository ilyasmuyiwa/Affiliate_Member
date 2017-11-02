<?php

namespace Test\Affiliate\Api\Data;
 

 
/**
 * Interface for preorder Complete search results.
 * @api
 */
interface MemberResultInterface 
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