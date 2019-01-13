<?php

/**
 * @author HereIam
 * @copyright 2008
 */

function pager_navigation($pager, $uri)
{
  $navigation = '';
 
	  // set the information message   
	    
	if($pager->getNbResults()!= 0)
	{
		if($pager->getPage() == $pager->getLastPage())
		{
			if ($pager->getNbResults() == sfConfig::get('app_pager_list_max'))
			{
				$infc = $pager->getNbResults();
				
				$inf = ' '.__('from').' '. 1 .' '.__('to').' '. $pager->getNbResults();			
								
			} else {
				
				$infc = $pager->getNbResults() % sfConfig::get('app_pager_list_max');
				
				$inf = ' '.'from'.' '. ((sfConfig::get('app_pager_list_max') * ($pager->getPage()-1)) + 1 ).' '.'to'.' '.
                ((sfConfig::get('app_pager_list_max') * ($pager->getPage()-1)) + ($pager->getNbResults() % sfConfig::get('app_pager_list_max')));
				
			}
		} else {
			
			$infc = (sfConfig::get('app_pager_list_max'));
			
			if ($pager->getPage() == 1)
			{
				$inf = ' '.__('from').' 1 '.__('to').' '. (sfConfig::get('app_pager_list_max'));			
			} else {
				
				$inf = ' '.__('from').' '. ((sfConfig::get('app_pager_list_max') * ($pager->getPage()-1)) + 1) .' '.__('to').' '.
                (sfConfig::get('app_pager_list_max') * $pager->getPage());
			}		
		}	
	} else {
		
		$inf = 0;
		$infc = 0;
	}	
	
	// set the max item list number
    
	$navigation .= '<div class="limit">'.'Results '. $inf .'</div>';
	$navigation .= '<div class="limit">'.'Displaying '. $infc .'</div>';
	$navigation .= '<div class="limit">'.'Total '.$pager->getNbResults().'</div>';
 
	if ($pager->haveToPaginate())
	{$uri .= (preg_match('/\?/', $uri) ? '&' : '?');
                
		// First and previous page
		if ($pager->getPage() != 1)
		{
		  $navigation .= '<div class="button2-right"><div class="start"><span>'.link_to(__('Start'), '@'.$uri.'page=1').'</span></div></div>';
		  $navigation .= '<div class="button2-right"><div class="prev"><span>'.link_to(__('Prev'), '@'.$uri.'page='.$pager->getPreviousPage()).'</span></div></div>';

                } else {

		  $navigation .= '<div class="button2-right off"><div class="start"><span>'.__('Start').'</span></div></div>';
		  $navigation .= '<div class="button2-right off"><div class="prev"><span>'.__('Prev').'</span></div></div>'; 
		}

		$navigation .= '<div class="button2-left"><div class="page">';
    
		// Pages one by one
		foreach ($pager->getLinks() as $page)
		{
                    if ($page == $pager->getPage())
                    {
                        $navigation .=  '<span>'.$page.'</span>';
                    } else {
                        $navigation .= '<span>'.link_to($page, '@'.$uri.'page='.$page).'</span>';
                    }
		}

		$navigation .= '</div></div>';
		
		// Next and last page
		if ($pager->getPage() != $pager->getCurrentMaxLink())
		{
                  $navigation .= '<div class="button2-left"><div class="next"><span>'.link_to(__('Next'), '@'.$uri.'page='.$pager->getNextPage()).'</span></div></div>';
		  $navigation .= '<div class="button2-left"><div class="end"><span>'.link_to(__('End'), '@'.$uri.'page='.$pager->getLastPage()).'</span></div></div>';

                } else {
      
		  $navigation .= '<div class="button2-left off"><div class="next"><span>'.'Next'.'</span></div></div>';
		  $navigation .= '<div class="button2-left off"><div class="end"><span>'.'End'.'</span></div></div>'; 
		}
	} else {
    
		$navigation .= '<div class="button2-right off"><div class="start"><span>'.'Start'.'</span></div></div>';
		$navigation .= '<div class="button2-right off"><div class="prev"><span>'.'Prev'.'</span></div></div>';
		$navigation .= '<div class="button2-left off"><div class="next"><span>'.'Next'.'</span></div></div>';
		$navigation .= '<div class="button2-left off"><div class="end"><span>'.'End'.'</span></div></div>'; 
	}
  
 	$navigation .= '<div class="limit">'.'Page'.' '.$pager->getPage().' '.'of'.' '.$pager->getLastPage().'</div> ';
 	
  return $navigation;
}