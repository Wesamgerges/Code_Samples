<?php

/**
 * Description of login
 *
 * FUNCTIONS:
 *      INDEX
 *      LOGIN
 *      LOGOUT
 * 
 * @author Wesam Gerges
 */
class Login extends CI_Controller{
    
    public function index()
    {
        $this->load->view(  "Login_view"    );
    }
    
    public function logins( )
    {
        echo $this->authentication->login(  $this->input->post( "UserName"  )   ,   $this->input->post( "Password"  )   );
    }
    
    function logout()
    {
        $this->authentication->logout();
        redirect(   "login"     );
    }
    
}

?>
