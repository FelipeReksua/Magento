<?php
namespace TipoPessoa\Customer\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;

class OptionsTipoPessoa extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var OptionFactory
     */
    protected $optionFactory;

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options=[
            ['label' => 'Selecione', 'value' => ''],
            ['label' => 'Pessoa física', 'value' => '1'],
            ['label' => 'Pessoa jurídica', 'value' => '2']
        ];
        return $this->_options;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}