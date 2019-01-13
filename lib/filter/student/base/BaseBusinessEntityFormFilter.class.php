<?php

/**
 * BusinessEntity filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBusinessEntityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'           => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'name'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'server_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'connection'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'night_audit_hour'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'night_audit_overtime' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_state'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'name'                 => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
      'server_name'          => new sfValidatorPass(array('required' => false)),
      'connection'           => new sfValidatorPass(array('required' => false)),
      'night_audit_hour'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'night_audit_overtime' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('business_entity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BusinessEntity';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'id_state'             => 'Number',
      'deleted_by'           => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'name'                 => 'Text',
      'description'          => 'Text',
      'server_name'          => 'Text',
      'connection'           => 'Text',
      'night_audit_hour'     => 'Number',
      'night_audit_overtime' => 'Number',
    );
  }
}
