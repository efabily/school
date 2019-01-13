<?php

include_partial($configuration->getPartial('index_success'), array('params' => array(
                                            'configuration' => $configuration, 'form' => $filters,
                                            'pager' => $pager, 'sort' => $sort, 'helper' => $helper)));