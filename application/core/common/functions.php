<?php
/*
	DESKRIPTION PLACEHOLDER
*/
// PLEASE, REORGANIZE TO CATEGORYS AND NUMBERED LISTS. ADD DESCRIPTION AND VALID NAMES. DOUBLECHECK WORKABILITY. (apply to all the code =) )
class	Functions
{
	
	/* 1. GENERATE RANDOM STRING */
	// generates string of provided $length, using preset $alphabet shuffled with rand() function
	public static function	genRandStr($length) {
	    
	    $alphabet	=	'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $power		=	strlen($alphabet);
	    $randStr	=	'';
	    
	    for ($i = 0; $i	< $length; $i++) {
	    
	        $randStr	.=	$alphabet[rand(0, $power - 1)];
	    
	    }
    	
    	return $randStr;
	}


	/**/
}