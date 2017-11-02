<?php
namespace Test\Affiliate\Block\Adminhtml\Member\Edit;
 
use \Magento\Backend\Block\Widget\Form\Generic;
 
class Form extends Generic
{
 
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
 
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('member_form');
        $this->setTitle(__('Member Information'));
    }
 
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Maxime\Jobs\Model\Department $model */
        $model = $this->_coreRegistry->registry('affiliates_member');
 
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post']]
        );
 
        $form->setHtmlIdPrefix('member_');
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );
 
        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }
 
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Member Name'), 'title' => __('Member Name'), 'required' => true]
        );
 
        // $fieldset->addField(
        //     'description',
        //     'textarea',
        //     ['name' => 'description', 'label' => __('Department Description'), 'title' => __('Department Description'), 'required' => true]
        // );

        // Status - Dropdown
        if (!$model->getId()) {
            $model->setStatus('enabled'); // Enable status when adding a Job
        }
        $statuses =  array('enable' =>'enable' ,'disable' => 'disable' );
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'), 'required' => true, 'values' => $statuses]
        );



        $fieldset->addField(
                'image',
                'image',
            [
                'title' => __('Image'),
                'label' => __('Image'),
                'name' => 'image',
                'note' => 'Allow image type: jpg, jpeg, gif, png',
           ]
        );




 
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}