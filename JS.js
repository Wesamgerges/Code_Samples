 var inputs = 1;
 $("document").ready(function(){
	$("#Add").click(function(){  	          
        $.post('add_family/addfamily', $("#info").serialize(),  
                function(data) { 
                    alert(data);
                $('#message').html(data).show().fadeOut(5000); 
                $("#info")[0].reset();           
                 }); 
            });
        $("#AddOne").click(function(){
        	$("#NoPersons").val(parseInt($("#NoPersons").val())+1);
        	$.post('include/BuildAContact.php', {NoPersons:$("#NoPersons").val()},  
                function(data) { 
                 
                 $("#childern").append(data);
                 addStatusListBox(this);
                 $("#person"+$("#NoPersons").val()).hide().slideDown(500);  
               });     
            });  

function addStatusListBox(){
 var c = $('#Status1').clone(true);   
	c.attr('name','Status'+ (++inputs));     
	c.attr('id','Status'+ (inputs));
	 $('.status1').append(c);
	 $(".status1").attr('class','status');
}

		 
       $("#RemoveOne").click(function(){
       	if ($("#NoPersons").val() <= 3) return;
            $("#person"+$("#NoPersons").val()).slideUp(500, function() {
                $("#person"+$("#NoPersons").val()).remove();
                $("#NoPersons").val(parseInt($("#NoPersons").val())-1) ;   
            });              
         });
         

         $("#getRegisteredUser").dialog( {autoOpen: false,
			height: 600,
			width: 650,
			modal: true,buttons:{"Cancel": function() {//alert("cancel");
					$( "#getRegisteredUser" ).dialog( "close" );$( "#getRegisteredUser" ).dialog( "destroy" );
				}
			},
			close: function() {
				$( this ).dialog( "close" );
				
			}});
			
		
		 $("#searchbtn").click(function()
    	{
        $.post('GetSearchResults.php', {search:$("#search").val()},  
          function(data) {              
          $('#message').html(data).hide().slideDown(500);            
           }); 
    	});
 
   $(".ff").click(  function(){
                            $("#getRegisteredUser").dialog("open");
                        });
   });
   
