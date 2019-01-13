<?php

use_helper('I18N');

include_partial('generic/edit_success', array('partialModule' => 'generic', 'params' => array(
                                            'form' => $form, 'helper' => $helper,
                                            'configuration' => $configuration,
                                            'boxTitle' => __('Editando "%%name%%".',
                                              array('%%name%%' => $_object->__toString()), 'messages'))));