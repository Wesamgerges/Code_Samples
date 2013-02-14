<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Authentication LIBRARY
 * FUNCTIONS:
 *              GET_USERDATA
 *              LOGGED_IN
 *              LOGIN
 *              LOGOUT
 *              
 * @author Wesam Gerges
 */

class Authentication {
        
    function get_userdata()
    {
        $CI =& get_instance();
        if( !$this->logged_in(  )   )
            return false;
        else {
          $query = $CI->db->query("
                                    SELECT 
                                        firstname, lastname, email 
                                    FROM 
                                        users 
                                    WHERE 
                                        id = ? ",$CI->session->userdata("user_id") 
                                ) ;
          return $query->row();
        }
    }
	
    // CHECK IF THE USER LOGGED IN
    function logged_in()
    {
      $CI =& get_instance();
      return ( $CI->session->userdata("user_id")) ? true : false;      
    }
	
    //Login Function
    function login( $username   ,   $password   )
    {
        $CI =& get_instance();
        $query = $CI->db->query("SELECT id,firstname, lastname FROM users WHERE username=? AND hashedpassword=?",array($username,sha1($password)));
        if($query->num_rows != 1 )
        {
            return "FALSE";
        }
        else
        {
            $CI->session->  set_userdata(   "user_id"           ,   $query->row()->id       );
            $CI->session->  set_userdata(   "user_firstname"    ,   $query->row()->firstname);
            $CI->session->  set_userdata(   "user_lastname"     ,   $query->row()->lastname );
            return $query->row()->firstname;
        }
    }
    
    // Logout Function
    function logout()
    {     
        $CI =& get_instance(    );
        $CI->session->unset_userdata(   "user_id"   );
    }
}

?>
