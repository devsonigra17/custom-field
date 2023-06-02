<?php

namespace Dev\CustomField\Plugin\Block\Checkout;

class LayoutProcessor
{
    public function __construct(
        \Dev\CustomField\Helper\Options $options
    ) {
        $this->options = $options;
    }

    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['drop_down'] = $this->processDropDownAddress('shippingAddress');

        return $jsLayout;
    }

    private function processDropDownAddress($dataScopePrefix)
    {
        return [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'drop_down',
                'options' => $this->options->toOptionArray()
                
            ],
            'dataScope' => $dataScopePrefix.'.custom_attributes.drop_down',
            'label' => __('Drop Down'),
            'provider' => 'checkoutProvider',
            'validation' => [
               'required-entry' => true
            ],
            'sortOrder' => 201,
            'visible' => true,
            'imports' => [
                'initialOptions' => 'index = checkoutProvider:dictionaries.drop_down',
                'setOptions' => 'index = checkoutProvider:dictionaries.drop_down'
            ]
        ];
    }
}
