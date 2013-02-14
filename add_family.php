<?php
/**
 * Description of ADD FAMILY CONTROLLOR
 *
 * FUNCTIONS:
 *              INDEX
 *              ADD FAMILY
 *  
 * @author WESAM GERGES
 */

class add_family extends CI_Controller{
   
    // LOAD THE ADD FAMILY PAGE
    function index()
    {
        $this-> load->  view(   'add_family_view'   );
    }
   
    // ADD A NEW FAMILY 
    public function addfamily(  )
    {
        // LOAD ADD FAMILY MODEL
        $this-> load->  model(  'add_family_model'    );
        
        // SAVE THE NEW FAMILY IN THE DB
        $this-> add_family_model->  add_family( );
    }
    
}
?>
