<?php
/**
 * Description of MembersList_Model
 * DISPLAYS THE MAIN ICONS IN THE FRONT PAGE.
 * 
 * FUNCTION
 *          GETMEMBERSLIST
 * 
 * @author Wesam Gerges
 */

class MembersList_Model extends CI_Model
{
        // GET ALL MEMBERS LIST
        public function getMembersList()
        {
                $membersList = $this->  db->  get(    'person'    );
                
                return $membersList ->  result_array( );
        }
}
?>