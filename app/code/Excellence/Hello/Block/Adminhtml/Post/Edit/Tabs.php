<?phphttps://shop.emiprotechnologies.com/documentation/custom-option-image-for-magento-2
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 09:11
 */
namespace Excellence\Hello\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('excellence_hello_test');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('News Information'));

    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'news_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'Excellence\Hello\Block\Adminhtml\Post\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}