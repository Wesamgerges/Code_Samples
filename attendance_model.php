<?php
/**
 * Description of Attendance Model
 *
 * FUNCTIONS:
 *              GETMEMBERS
 *  
 * @author WESAM GERGES
 */

class attendance_model extends CI_Model{
    
    // GET ALL MEMBERS THAT ATTEND A SPECIFIC MEETING
    function getMembers(    )
    {
        // SET A DEFAULT VALUES
        $MeetingId          =   2;
	$currentMeetingId   =   40;
	
	if( isset   (   $_GET[  "Meetings"          ]   )   ) $MeetingId         = $_GET[   "Meetings"          ];
	if( isset   (   $_GET[  "currentMeetingId"  ]   )   ) $currentMeetingId  = $_GET[ "currentMeetingId"    ];
	
        // BUILD THE QUERY 
	$persons = $this->db->query("
                            SELECT * 
                            FROM (
                                    SELECT * FROM ". 			
                                     PersonsTable.",". MemberMeetingTable.
                                   " WHERE ".PersonsTable.".id = ".MemberMeetingTable.".memberid
                                     AND meetingid = {$MeetingId}
                                       ) AS t

                        LEFT OUTER JOIN ".AttendanceTable.
                            " ON
                                    t.MemberId =  ".AttendanceTable.".memberid 
                                    AND ".AttendanceTable.".weeklyMeetingId = {$currentMeetingId}
                                    order by t.FirstName    					 
                    ");
                    return $persons->result(    );
    }
}

?>
