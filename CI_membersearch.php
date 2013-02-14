<?php
/**
 * Description of MemberSearch
 * FUNCTIONS:
 *              CONSTRUCTOR
 *              INDEX
 *              SEARCH
 *              GETMEMBERINFORMATION
 * 
 * @author Wesam Gerges
 */

class MemberSearch extends CI_Controller
{
   // CLASS CONSTRUCTOR  
   public function __construct() 
   {
       // LOAD THE PARENT CONSTRUCTOR 
       parent::__construct();   
        
        // LOAD THE SEARCH MODEL TO USE IT IN THE OTHER CLASS FUNCTION
        $this-> load->  model( "MemberSearch_Model"    ); 
        
    }
   public function index()
   {
       // CHECK IF THE USER IS LOGGED IN 
       if( ! $this->authentication->logged_in() ) redirect("login"); 
       
       // SET THE CURRENT USER DATA
       $data[   'currentUser'   ] = $this-> session->   userdata(   'user_firstname'    );
       
       // SET THE TITLE FOR THE SEARCH PAGE
       $data[   'title'         ] = "Member Search";
       
       // LOAD THE HEADER
       $this->  load->  view(   "templates/header"  ,   $data);
       
       // LOAD THE SEARCH PAGE
       $this->  load->  view(   "MemberSearch"      ,   $data);
       
       // LOAD THE FOOTER
       $this->  load->  view(   "templates/footer"  ,   $data);
   }
   
   // SEND THE SEARCH CRITERIA TO THE SEARCH MODEL
   public function search()
   {
      echo $this->MemberSearch_Model->search(
                                                $this->input->post(    "searchword"    ),
                                                $this->input->post(    "criteria"      )
                                            );
   }
   
   // GET MEMBER INFORMATION
   public function GetMemberInformation()
   {
      // SEND MEMBER ID TO THE MEMBER SEARCH MODEL AND RETURN MATCH MEMBER INFORMATION 
      echo $this->MemberSearch_Model->GetMemberInformation( $this->input->post(  "MemberId"  )  );      
   }
}

?>
