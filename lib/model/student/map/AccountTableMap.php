<?php


/**
 * This class defines the structure of the 'sch_account' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:10 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class AccountTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.AccountTableMap';

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
		$this->setName('sch_account');
		$this->setPhpName('Account');
		$this->setClassname('Account');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_STATE', 'IdState', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('NUMBER', 'Number', 'TINYINT', true, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('CONTRACT_ID', 'ContractId', 'INTEGER', 'sch_contract', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Contract', 'Contract', RelationMap::MANY_TO_ONE, array('contract_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Classroom', 'Classroom', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('SaleAccount', 'SaleAccount', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('AccountDeposit', 'AccountDeposit', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
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

} // AccountTableMap
