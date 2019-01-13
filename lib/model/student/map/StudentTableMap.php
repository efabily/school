<?php


/**
 * This class defines the structure of the 'sch_student' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:08 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class StudentTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.StudentTableMap';

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
		$this->setName('sch_student');
		$this->setPhpName('Student');
		$this->setClassname('Student');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_STATE', 'IdState', 'INTEGER', true, null, null);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', true, 100, null);
		$this->addColumn('FATHER_NAME', 'FatherName', 'VARCHAR', true, 100, null);
		$this->addColumn('MOTHER_NAME', 'MotherName', 'VARCHAR', true, 100, null);
		$this->addColumn('RUDE', 'Rude', 'VARCHAR', true, 100, null);
		$this->addColumn('CODIGO', 'Codigo', 'CHAR', true, 30, null);
		$this->addColumn('BIRTH_DATE', 'BirthDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 100, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('PERSON_ID', 'PersonId', 'INTEGER', 'sch_person', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Person', 'Person', RelationMap::MANY_TO_ONE, array('person_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Contract', 'Contract', RelationMap::ONE_TO_MANY, array('id' => 'student_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('StudentTutor', 'StudentTutor', RelationMap::ONE_TO_MANY, array('id' => 'student_id', ), 'CASCADE', 'RESTRICT');
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

} // StudentTableMap