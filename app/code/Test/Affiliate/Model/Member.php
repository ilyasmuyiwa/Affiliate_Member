<?php
namespace Test\Affiliate\Model;
 
use \Magento\Framework\Model\AbstractModel;

use Magento\Framework\Model\AbstractExtensibleModel;
use Test\Affiliate\Api\Data\MemberExtensionInterface;
use Test\Affiliate\Api\Data\MemberInterface;
 
class Member extends AbstractExtensibleModel implements MemberInterface
{
    const MEMBER_ID = 'entity_id'; // We define the id fieldname

    const NAME = 'name';
    const STATUS = 'status';
    //const IMAGE_URLS = 'image_urls';

    public function getName()
    {
        return $this->_getData(self::NAME);
    }
 
    public function setName($name)
    {
        $this->setData(self::NAME);
    }
    

    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }
 
    public function setStatus($status)
    {
        $this->setData(self::STATUS);
    }


    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }
 
    public function setExtensionAttributes(MemberExtensionInterface $extensionAttributes)
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }


 
 
    /**
     * Prefix of model events names
     *
     * @var string
     */
   // protected $_eventPrefix = 'affiliate'; // parent value is 'core_abstract'
 
    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'member'; // parent value is 'object'

    protected $_eventPrefix = 'test_affliate_info';
 
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::MEMBER_ID; // parent value is 'id'
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Test\Affiliate\Model\ResourceModel\Member::class);
    }
 
}