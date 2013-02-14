<?php
/**
 * Description of main
 * DISPLAYS THE MAIN ICONS IN THE FRONT PAGE.
 * 
 * FUNCTION
 *          INDEX
 * 
 * @author Wesam Gerges
 */

class Main extends CI_Controller {

    public function index() {
        
        // CHECK IF THE USER IS LOGGED IN 
        if (    !$this->authentication->logged_in(  )   )
            redirect(   "login"     );

         // LOAD THE MAIN MODEL
        $this->load->model(     "Main_Model"    );
        
        // LOAD THE MAIN PAGE ICONS FROM THE DB USING THE MAIN MODEL
        $data[  'MainIcons' ] = $this->Main_Model->get_Menus(   );
        
        // SET THE CURRENT USER DATA
        $data[  'currentUser'   ]   = $this->session->userdata(   'user_firstname'    );
        
        // SET THE TITLE FOR THE SEARCH PAGE
        $data[  'title'         ]   = "ChMS Main";
        
        // LOAD THE HEADER
        $this->     load->   view(  "templates/header"  , $data );
        
        // LOAD THE MAIN PAGE
        $this->     load->   view(  "main_view"         , $data );
        
        // LOAD THE FOOTER
        $this->     load->   view(  "templates/footer"  , $data );
    }

}

?>
