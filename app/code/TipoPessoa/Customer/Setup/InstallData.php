<?php
namespace TipoPessoa\Customer\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Customer\Model\Customer;

class InstallData implements InstallDataInterface
{
	private $eavSetup;
	private $eavConfig;
	private $attributeResource;

	public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig, Attribute $attributeResource)
	{
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

		//TIPO PESSOA
        $eavSetup->removeAttribute(Customer::ENTITY, "tipo_pessoa");

		$eavSetup->addAttribute(
			Customer::ENTITY,
			'tipo_pessoa',
			[
				'type' => 'int',
				'label' => 'Tipo de cadastro',
				'input' => 'select',
				'required' => true,
				'position' => 26,
				'sort_order' => 26,
				'source' => 'TipoPessoa\Customer\Source\OptionsTipoPessoa',
				'user_defined' => true,
				'system' => false,
			]
		);

		$tipo_pessoa = $this->eavConfig->getAttribute(
			Customer::ENTITY,
			'tipo_pessoa'
		);

		$tipo_pessoa->setData('attribute_set_id', $attributeSetId);
        $tipo_pessoa->setData('attribute_group_id', $attributeGroupId);

		$tipo_pessoa->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);

		// $tipo_pessoa->save();
		$this->attributeResource->save($tipo_pessoa);


		//INSCRIÇÃO ESTADUAL
		$eavSetup->removeAttribute(Customer::ENTITY, "inscricao_estadual");

		$eavSetup->addAttribute(
			Customer::ENTITY,
			'inscricao_estadual',
			[
				'type' => 'varchar',
				'label' => 'Inscrição estadual',
				'input' => 'text',
				'required' => false,
				'position' => 27,
				'sort_order' => 27,
				'visible' => true,
				'user_defined' => true,
				'system' => false,
			]
		);

		$inscricao_estadual = $this->eavConfig->getAttribute(
			Customer::ENTITY,
			'inscricao_estadual'
		);

		$inscricao_estadual->setData('attribute_set_id', $attributeSetId);
        $inscricao_estadual->setData('attribute_group_id', $attributeGroupId);

		$inscricao_estadual->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);

		// $inscricao_estadual->save();
		$this->attributeResource->save($inscricao_estadual);


		//TIPO COMPRA
		$eavSetup->removeAttribute(Customer::ENTITY, "tipo_compra");

		$eavSetup->addAttribute(
			Customer::ENTITY,
			'tipo_compra',
			[
				'type' => 'int',
				'label' => 'Tipo de compra',
				'input' => 'select',
				'required' => false,
				'position' => 28,
				'sort_order' => 28,
				'source' => 'TipoPessoa\Customer\Source\OptionsTipoCompra',
				'user_defined' => true,
				'system' => false,
			]
		);

		$tipo_compra = $this->eavConfig->getAttribute(
			Customer::ENTITY,
			'tipo_compra'
		);

		$tipo_compra->setData('attribute_set_id', $attributeSetId);
        $tipo_compra->setData('attribute_group_id', $attributeGroupId);

		$tipo_compra->setData(
			'used_in_forms',
			['adminhtml_customer', 'customer_account_edit', 'customer_account_create']
		);

		// $tipo_compra->save();
		$this->attributeResource->save($tipo_compra);

		$setup->endSetup();
	}
}
