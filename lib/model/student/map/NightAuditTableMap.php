<?php


/**
 * This class defines the structure of the 'sch_night_audit' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:16 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class NightAuditTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.NightAuditTableMap';

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
		$this->setName('sch_night_audit');
		$this->setPhpName('NightAudit');
		$this->setClassname('NightAudit');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('DATE', 'Date', 'TIMESTAMP', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('BUSINESS_ENTITY_ID', 'BusinessEntityId', 'INTEGER', 'sch_business_entity', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('BusinessEntity', 'BusinessEntity', RelationMap::MANY_TO_ONE, array('business_entity_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('CashBox', 'CashBox', RelationMap::ONE_TO_MANY, array('id' => 'night_audit_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Receipt', 'Receipt', RelationMap::ONE_TO_MANY, array('id' => 'night_audit_id', ), 'CASCADE', 'RESTRICT');
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

} // NightAuditTableMap
