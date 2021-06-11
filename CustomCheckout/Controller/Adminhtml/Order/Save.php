<?php
namespace AHT\CustomCheckout\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Helper\AbstractHelper;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;
/**
 * Class Index
 */
class Save extends Action 
{
    /**
     * @var PageFactory
     */

    /**
     * Index constructor.
     *
     * @param Context $context
     */
    protected $resourceConnection;

    public function __construct(Context $context, ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        $date =  ($this->getRequest()->getParam('date_shipping'));
        $note = ($this->getRequest()->getParam('note_shipping'));
        $id = ($this->getRequest()->getParam('order_id'));
        $resultRedirect = $this->resultRedirectFactory->create();
        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName('sales_order');

        $query = "update sales_order as b set delivery_data = '".$date."',delivery_comment = '".$note."' WHERE b.entity_id = ".$id."";
        
        $connection->query($query);
        return $resultRedirect->setPath('*/*/');
    }
}
