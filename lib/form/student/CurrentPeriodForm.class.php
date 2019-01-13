<?php

/**
 * BusinessEntity form.
 *
 * @package    basic
 * @subpackage form
 * @author     Yassel Diaz Gomez
 */
class CurrentPeriodForm extends sfForm
{
  protected
    $user = null;

  /**
   * Constructor.
   *
   * @param sfUser A sfUser instance
   * @param array  An array of options
   * @param string A CSRF secret (false to disable CSRF protection, null to use the global CSRF secret)
   *
   * @see sfForm
   */

  public function __construct(sfUser $user, $options = array(), $CSRFSecret = null)
  {
    $this->user = $user;
    $this->default = $options['default'];

    if (!isset($options['period']))
    {
      throw new RuntimeException(sprintf('%s requires a "business_entity" option.', get_class($this)));
    }

    parent::__construct(array('period' => $options['default']), $options, $CSRFSecret);
  }

  /**
   * @see sfForm
   */
  public function configure()
  {
    $this->setWidgets(array(
      'period' => new sfWidgetFormChoice(
              array('choices' => $this->options['period'], 'default' => $this->options['default']),
              array()
             )
    ));
    
    $this->setValidators(array(
      'period' => new sfValidatorInteger(array('trim' => true)),
    ));

    $this->widgetSchema->setLabels(
        array(
          'period' => 'Periodos: '
        )
    );
  }

  /**
   * Processes the current request.
   *
   * @param  sfRequest A sfRequest instance
   *
   * @return Boolean   true if the form is valid, false otherwise
   */
  public function process(sfRequest $request)
  {
    $data = array('period' => $request->getParameter('period'));
    
    if ($request->hasParameter(self::$CSRFFieldName))
    {
      $data[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
    }

    $this->bind($data);

    if ($isValid = $this->isValid())
    {
      $this->save();
    }

    return $isValid;
  }

  /**
   * Changes the current user BusinessEntity.
   */
  public function save()
  {
    $this->user->setAttribute('period', $this->getValue('period'));
  }
}
