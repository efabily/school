<?php


/**
 * This class defines the structure of the 'sch_contract' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:09 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class ContractTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.ContractTableMap';

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
		$this->setName('sch_contract');
		$this->setPhpName('Contract');
		$this->setClassname('Contract');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_STATE', 'IdState', 'INTEGER', true, null, null);
		$this->addColumn('NRO', 'Nro', 'CHAR', false, 20, null);
		$this->addColumn('AMOUNT', 'Amount', 'FLOAT', false, null, null);
		$this->addColumn('CONTAINER', 'Container', 'LONGVARCHAR', false, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('RECORD_DATE', 'RecordDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('CITY', 'City', 'VARCHAR', true, 100, null);
		$this->addForeignKey('PERIOD_ID', 'PeriodId', 'INTEGER', 'sch_period', 'ID', true, null, null);
		$this->addForeignKey('STUDENT_ID', 'StudentId', 'INTEGER', 'sch_student', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Period', 'Period', RelationMap::MANY_TO_ONE, array('period_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Student', 'Student', RelationMap::MANY_TO_ONE, array('student_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Question', 'Question', RelationMap::ONE_TO_MANY, array('id' => 'contract_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('AttributeContract', 'AttributeContract', RelationMap::ONE_TO_MANY, array('id' => 'contract_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Account', 'Account', RelationMap::ONE_TO_MANY, array('id' => 'contract_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('DiscountContract', 'DiscountContract', RelationMap::ONE_TO_MANY, array('id' => 'contract_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('ContractGrade', 'ContractGrade', RelationMap::ONE_TO_MANY, array('id' => 'contract_id', ), 'CASCADE', 'RESTRICT');
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

} // ContractTableMap