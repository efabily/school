<?php

/**
 * Transfer filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTransferFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'     => new sfWidgetFormFilterInput(),
      'deleted_by' => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'comment'    => new sfWidgetFormFilterInput(),
      'type'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'comment'    => new sfValidatorPass(array('required' => false)),
      'type'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('transfer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transfer';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_state'   => 'Number',
      'amount'     => 'Number',
      'deleted_by' => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'comment'    => 'Text',
      'type'       => 'Number',
      'user_id'    => 'ForeignKey',
    );
  }
}
