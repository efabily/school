<?php

use_helper('I18N');

include_partial('generic/show_success', array('partialModule' => 'generic', 'params' => array(
                                              'configuration' => $configuration, 'helper' => $helper,
                                              '_object' => $_object, 'boxTitle' => __('Mostrando "%%name%%".',
                                                array('%%name%%' => $_object->__toString()), 'messages'))));
