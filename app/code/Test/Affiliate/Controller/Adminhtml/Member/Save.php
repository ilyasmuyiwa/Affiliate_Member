<?php
namespace Test\Affiliate\Controller\Adminhtml\Member;
 
use Magento\Backend\App\Action;



class Save extends Action
{
    
    protected $_model;
 
 protected $adapterFactory;

protected $uploader;

protected $filesystem;
    

    protected $timezoneInterface;




public function __construct(Action\Context $context,\Magento\Framework\Image\AdapterFactory $adapterFactory,\Magento\MediaStorage\Model\File\UploaderFactory $uploader,\Magento\Framework\Filesystem $filesystem,
    \Test\Affiliate\Model\Member $model)
{
$this->adapterFactory = $adapterFactory;
$this->uploader = $uploader;
$this->filesystem = $filesystem;
$this->_model = $model;
parent::__construct($context);
}


    // public function __construct(
    //     Action\Context $context,
    //     \Magento\Framework\Image\AdapterFactory $adapterFactory,
    //     \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
    //     \Test\Affiliate\Model\Member $model
    // ) {
    //     parent::__construct($context);
    //     $this->_model = $model;
    // }
 
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Test_Affiliate::member_save');
    }
 
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {




$data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
/*
* Save image upload
*/
try {
$base_media_path = '/affiliate_members/images';
$uploader = $this->uploader->create(
['fileId' => 'image']
);
$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
$imageAdapter = $this->adapterFactory->create();
$uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
$uploader->setAllowRenameFiles(true);
$uploader->setFilesDispersion(true);
$mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
$result = $uploader->save(
$mediaDirectory->getAbsolutePath($base_media_path)
);
$data['image'] = $base_media_path.$result['file'];
//die($data['image']);
} catch (\Exception $e) {
if ($e->getCode() == 0) {
$this->messageManager->addError($e->getMessage());
}
}
} else {
if (isset($data['image']) && isset($data['image']['value'])) {
if (isset($data['image']['delete'])) {
$data['image'] = '';
$data['delete_image'] = true;
} elseif (isset($data['image']['value'])) {
$data['image'] = $data['image']['value'];
} else {
$data['image'] = null;
}
}

}










       // $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        //$resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Maxime\Jobs\Model\Department $model */
            $model = $this->_model;
 
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
 
            $model->setData($data);
 
            $this->_eventManager->dispatch(
                'affiliates_member_prepare_save',
                ['member' => $model, 'request' => $this->getRequest()]
            );
 
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Member saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the member'));
            }
 
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}