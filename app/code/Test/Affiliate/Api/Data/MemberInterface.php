<?php

namespace Test\Affiliate\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface MemberInterface   extends ExtensibleDataInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getStatus();


    /**
     * @param string $name
     * @return void
     */

    public function setName($name);


     /**
     * @param string $status
     * @return void
     */

    public function setStatus($status);


     /**
     * @return \Test\Affiliate\Api\Data\MemberExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Test\Affiliate\Api\Data\MemberExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(MemberExtensionInterface $extensionAttributes);


}
