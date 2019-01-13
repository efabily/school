<?php


/**
 * This class defines the structure of the 'sch_payment_type' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:18 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class PaymentTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.PaymentTypeTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('sch_payment_type');
		$this->setPhpName('PaymentType');
		$this->setClassname('PaymentType');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_STATE', 'IdState', 'INTEGER', true, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('USER_NAME', 'UserName', 'BOOLEAN', false, null, null);
		$this->addColumn('NUMBER', 'Number', 'BOOLEAN', false, null, null);
		$this->addColumn('DOCUMENT', 'Document', 'BOOLEAN', false, null, null);
		$this->addColumn('COMMENT', 'Comment', 'BOOLEAN', false, null, null);
		$this->addColumn('ADDRESS', 'Address', 'BOOLEAN', false, null, null);
		$this->addColumn('VALIDITY', 'Validity', 'BOOLEAN', false, null, null);
		$this->addColumn('CVV_CODE', 'CvvCode', 'BOOLEAN', false, null, null);
		$this->addColumn('SALES_CHECK', 'SalesCheck', 'BOOLEAN', false, null, null);
		$this->addColumn('ACCOUNTING_RECORD', 'AccountingRecord', 'BOOLEAN', false, null, null);
		$this->addForeignKey('CURRENCY_ID', 'CurrencyId', 'INTEGER', 'sch_currency', 'ID', true, null, null);
		$this->addForeignKey('FORM_OF_PAYMENT_ID', 'FormOfPaymentId', 'INTEGER', 'sch_form_of_payment', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Currency', 'Currency', RelationMap::MANY_TO_ONE, array('currency_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('FormOfPayment', 'FormOfPayment', RelationMap::MANY_TO_ONE, array('form_of_payment_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('MovementCashbox', 'MovementCashbox', RelationMap::ONE_TO_MANY, array('id' => 'payment_type_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('PaymentTypeBillet', 'PaymentTypeBillet', RelationMap::ONE_TO_MANY, array('id' => 'payment_type_id', ), 'CASCADE', 'RESTRICT');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // PaymentTypeTableMap