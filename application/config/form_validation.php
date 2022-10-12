<?php
$config = array(
       


'profile_rejection'=>array(
            array(
                'field'=>'rejection_remarks',
                'label'=>'Remarks',
                'rules'=>'trim|max_length[50]|regex_match[/^[a-z0-9 \/\-\.\,\?]*$/i]',
                 'errors'=>array(
                    'regex_match'=>'{field} contains invalid Characters.Allowed Chars- a-z 0-9 /-.,.'
                )
            ),  
            array(
                'field'=>'status',
                'label'=>'Status',
                'rules'=>'trim|required|in_list[R]'
            ),           
            ),  //end of 'complaint_registration' 
'profile_verification'=>array(
             array(
                'field'=>'status',
                'label'=>'Status',
                'rules'=>'trim|required|in_list[V]'
            ),      
            ),  //end of 'complaint_registration' 

 


     );  // end of array(