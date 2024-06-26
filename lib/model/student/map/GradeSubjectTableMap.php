<?php


/**
 * This class defines the structure of the 'sch_grade_subject' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan 20 11:49:13 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.student.map
 */
class GradeSubjectTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.student.map.GradeSubjectTableMap';

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
		$this->setName('sch_grade_subject');
		$this->setPhpName('GradeSubject');
		$this->setClassname('GradeSubject');
		$this->setPackage('lib.model.student');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_STATE', 'IdState', 'INTEGER', true, null, null);
		$this->addColumn('DELETED_BY', 'DeletedBy', 'INTEGER', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('GRADE_ID', 'GradeId', 'INTEGER', 'sch_grade', 'ID', true, null, null);
		$this->addForeignKey('SUBJECT_ID', 'SubjectId', 'INTEGER', 'sch_subject', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Grade', 'Grade', RelationMap::MANY_TO_ONE, array('grade_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Subject', 'Subject', RelationMap::MANY_TO_ONE, array('subject_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('GradeSubjectPeriod', 'GradeSubjectPeriod', RelationMap::ONE_TO_MANY, array('id' => 'grade_subject_id', ), 'CASCADE', 'RESTRICT');
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

} // GradeSubjectTableMap
