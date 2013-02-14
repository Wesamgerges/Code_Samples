<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Members RESFUL CLASS
 *
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class members extends REST_Controller {

    function member_get()
    {
        // CHECK IF THE ID IS EXSIT
        if (    !$this->get(    'id'   )    ) 
        {
            $this->response( 
                                // SEND AN EMPTY RESPONSE BACK.
                                NULL    , 
                                // RESPOND CODE
                                400    
                           );
        }
        // SELECT A PERSON INFROMATION WITH THE SPECIFIED ID 
        $this->     db->    select  (   '*'                                                 );
        $this->     db->    join    (   'relations' ,   'relations.memberid = person.id'    );
        $this->     db->    join    (   'family'    ,   'family.id = relations.familyid'    );
        $this->     db->    where   (   "person.id = " . $this->get('id'));
        
        // GETTING THE RESULT FROM THE DB
        $arr = @$this->db->get("person")->result();
        
        // SENDING THE RESPOND BACK TO THE CLIENT
        if ($arr) {
            $this->response(   
                                $arr[0] ,   
                                // 200 being the HTTP response code
                                200);  
        } else {
            //SEND BACK A FAILURE RESPOSNSE
            $this->response(    
                    array( 
                            // ERROR MESSAGE
                            'error' =>  'User could not be found'   )   , 
                    
                            // ERROR CODE 
                            404   
                        );
        }
    }

}