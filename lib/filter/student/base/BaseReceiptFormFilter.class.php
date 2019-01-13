<?php

/**
 * Receipt filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseReceiptFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'total'                  => new sfWidgetFormFilterInput(),
      'total_net'              => new sfWidgetFormFilterInput(),
      'night_audit_id'         => new sfWidgetFormPropelChoice(array('model' => 'NightAudit', 'add_empty' => true)),
      'discount'               => new sfWidgetFormFilterInput(),
      'service'                => new sfWidgetFormFilterInput(),
      'canceled'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'printed'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comment'                => new sfWidgetFormFilterInput(),
      'name'                   => new sfWidgetFormFilterInput(),
      'nit'                    => new sfWidgetFormFilterInput(),
      'telefon'                => new sfWidgetFormFilterInput(),
      'additional_information' => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'deleted_by'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'total'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_net'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'night_audit_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'NightAudit', 'column' => 'id')),
      'discount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'service'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'canceled'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'printed'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comment'                => new sfValidatorPass(array('required' => false)),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'nit'                    => new sfValidatorPass(array('required' => false)),
      'telefon'                => new sfValidatorPass(array('required' => false)),
      'additional_information' => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_by'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('receipt_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Receipt';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'total'                  => 'Number',
      'total_net'              => 'Number',
      'night_audit_id'         => 'ForeignKey',
      'discount'               => 'Number',
      'service'                => 'Number',
      'canceled'               => 'Boolean',
      'printed'                => 'Boolean',
      'comment'                => 'Text',
      'name'                   => 'Text',
      'nit'                    => 'Text',
      'telefon'                => 'Text',
      'additional_information' => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'deleted_by'             => 'Number',
    );
  }
}
