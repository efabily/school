<?php

use_helper('I18N');

include_partial('generic/new_success', array('partialModule' => 'generic', 'params' => array(
                                            'boxTitle' => __('Create'), 'form' => $form,
                                            'configuration' => $configuration, 'helper' => $helper)));