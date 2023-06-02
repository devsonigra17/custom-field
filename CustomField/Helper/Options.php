<?php

namespace Dev\CustomField\Helper;

use Magento\Framework\Option\ArrayInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Options extends AbstractHelper implements ArrayInterface
{
    const XML_CONFIG_PATH = 'custom_field/drop_down_value/drop_down_field';
    public $_storeManager;

    public function getConfig()
    {
        $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH,ScopeInterface::SCOPE_STORE); // For Store
        $configArray = explode(",",$configValue);
        return $configArray;
    }
    public function toOptionArray()
    {
        $array = $this->getConfig();
        // print_r($array);exit;
        foreach($array as $value)
        {
            
        
        $options[] = [
                'value' => $value,
                'label' => $value
        ];
        
    }

        return $options;
    }
}