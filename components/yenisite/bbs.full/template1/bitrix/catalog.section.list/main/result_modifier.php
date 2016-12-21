<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 

if (!empty($arResult)): 

	$arSectionTypes = array('animals','business','childrens','dating','electronics','exchange','garden','gift','house','job','moda','other','service','sport','transport');

    $top_key = -1; 
    foreach($arResult['SECTIONS'] as $key => $arItem): 
	
			if ($arItem["DEPTH_LEVEL"] == 1): 

			if($arEnum = CUserFieldEnum::GetList(array(), array('ID'=>IntVal($arItem["UF_SECTION_TYPE"])))->GetNext())
				$arItem['CLASS'] = (in_array($arEnum['VALUE'],$arSectionTypes))?$arEnum['VALUE']:'other';
			else
				$arItem['CLASS'] = 'other';
			
			$top_key++; 
            $arFormatted["TOP"][$top_key] = $arItem; 
        else: //if ($arItem['PERMISSION'] > 'D'): 
            $arFormatted["TOP"][$top_key]["ITEMS"][] = $arItem; 
        endif; 
		
		
    endforeach; 

    // foreach($arFormatted["TOP"] as $key => $arTopItem): 
        // if (count($arTopItem["ITEMS"]) > 12) 
            // $arFormatted["TOP"][$key]["LARGE"] = true; 
        // else 
            // $arFormatted["TOP"][$key]["LARGE"] = false; 
    // endforeach; 
     
endif; 



$arResult = $arFormatted["TOP"]; 

//echo '<pre>'; print_r($arResult); echo '</pre>'; 
?>