<?php


/**
 * This class defines the structure of the 'sch_movement_cashbox_transfer' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:30 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class MovementCashboxTransferTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.MovementCashboxTransferTableMap';

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
		$this->setName('sch_movement_cashbox_transfer');
		$this->setPhpName('MovementCashboxTransfer');
		$this->setClassname('MovementCashboxTransfer');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('MOVEMENT_CASHBOX_ID', 'MovementCashboxId', 'INTEGER', 'sch_movement_cashbox', 'ID', true, null, null);
		$this->addForeignKey('TRANSFER_ID', 'TransferId', 'INTEGER', 'sch_transfer', 'ID', true, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('MovementCashbox', 'MovementCashbox', RelationMap::MANY_TO_ONE, array('movement_cashbox_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Transfer', 'Transfer', RelationMap::MANY_TO_ONE, array('transfer_id' => 'id', ), 'CASCADE', 'RESTRICT');
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

} // MovementCashboxTransferTableMap
