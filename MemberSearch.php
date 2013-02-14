 
<div class="row-fluid ">
    <div class="span12">

        <div class="span4 offset4 center">

            <div align = "right" id = "container" style = "width: 388px; " >  
                <div class="btn-group" data-toggle="buttons-radio" id="Searchcriteria">
                    <button type="button" class="btn btn-primary btn-large active" id ="native" onclick="active = 'Native';">Native</button>
                    <button type="button" class="btn btn-primary btn-large" onclick="active = 'Name';">Name</button>
                    <button type="button" class="btn btn-primary btn-large" onclick="active = 'Phone';">Phone</button>
                    <button type="button" class="btn btn-primary btn-large" onclick="active = 'Email';">Email</button>
                </div> 
                <br/><br/>
                <form class="form-search" style = " ">
                    <div class="input-append">
                        <input type="text" class=" input-xlarge search-query" id="SearchBox" autocomplete="off">
                        <button type="submit" class="btn search-btn"><i class="icon-search"></i></button>
                    </div>

                    <div id="NewSearchResults" style="max-height:420px; overflow: auto;">                           
                        <div id="data">
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="span4" id="memberInformation" style="padding: 20px 20px;">

        </div>                    
    </div>
</div>


<br/><br/>  

<br/>
<div id="detailedMessage3" align="center" ></div>
<div id="detailedMessage23" align="center"></div>

</div>

<script type="text/template" id="MemberInfo">

    <div class="img-polaroid img-rounded center" >
        <!-- Start to trigger modal -->
        <div >
            <!-- Button to trigger modal -->
            <div class="right">
                <a href="#myModal" role="button" class="btn btn-primary right" data-toggle="modal">Edit</a>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel"><%= FirstName + " " + LastName %></h3>
                </div>
                <div class="modal-body">
                    
                    <form class="form-horizontal">
                        
                        <div class="control-group">
                            <label class="control-label" for="inputFirstName">First Name</label>
                            <div class="controls">
                                <input type="text" id="inputFirstName" placeholder="First Name" value="<%= FirstName %>">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="inputFirstName">Last Name</label>
                            <div class="controls">
                                <input type="text" id="inputLastName" placeholder="Last Name" value="<%= LastName %>">
                            </div>
                        </div>
                       <div class="control-group">
                            <label class="control-label" for="inputNativeName">Native Name</label>
                            <div class="controls">
                                <input type="text" id="inputNativeName" placeholder="Native Name" value="<%= native_name %>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPhone">Phone</label>
                            <div class="controls">
                                <input type="text" id="inputPhone" placeholder="Phone" value="<%= Phone %>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Email</label>
                            <div class="controls">
                                <input type="Email" id="inputEmail" placeholder="Email" value="<%= Email %>">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
        <!-- end to trigger modal -->

        <img src="include/images/cross-icon-big.png" style="width: 180px;height: 180px" class=" pull-right"/>
        <br/>

        <h3><%= FirstName + " " + LastName %></h3>
        <% if ( native_name ) { %>
        <h3><%= native_name %> </h3>
        <% }else{ %>
        <br/>
        <%}%>
        <h4 style="color:gray;"><%= Phone %></h4>
        <div style="text-align: left; padding: 15px;">
            <h5> <%= HouseNo  + " " + Street  + " " + Floor + ",<br/> " + City + " " + State  + ". " + ZIP  %> </h5>
            <h5><%= mstatus[Status-1]%></h5>
            <h5><%= Email.replace("," , ",<br/>") %></h5>

        </div>




    </div>

</script>
<script src="//code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.10/backbone-min.js"></script>
<!--        BackboneJS              -->
<script>
    //-----------------------------     BACKBONE.JS     ----------------------------------------------------------
    var mstatus = [ 
                    "Single"    ,
                    "Married"   
                  ];
                  
    person = Backbone.Model.extend({
        initialize:function (){
        },	
		
        defaults:{	
            // SET THE DEFAULT VALUES FOR THE MODEL        
        },
		
        validate: function(){
           // VALIDATE THE MODEL VALUES
        },
        urlRoot:    "members/member/id/"
    });
            
    var BBView = Backbone.View.extend({
        initialize: function(){           
        },
                
        events:
        {
            "click li": "getId"
        },
        
        el:         "#container",		
        template:   _.template( $(  "#MemberInfo"   ).html  (   )   ),
                
        getId: function(event){
            this.model.set( "id", parseInt( $(  event.currentTarget ).val() )   );  
                   
            var self = this;
            this.model.fetch({
                success: function ( user ) {
                    if(    self.model.get(  "City"     )   == null )  self.model.set(  "City"      , " "   );
                    if(    self.model.get(  "Floor"    )   == null )  self.model.set(  "Floor"     , " "   );
                    if(    self.model.get(  "HouseNo"  )   == null )  self.model.set(  "HouseNo"   , " "   );
                    if(    self.model.get(  "Street"   )   == null )  self.model.set(  "Street"    , " "   );
                    if(    self.model.get(  "State"    )   == null )  self.model.set(  "State"     , " "   );
                    if(    self.model.get(  "ZIP"      )   == null )  self.model.set(  "ZIP"       , " "   );
                    self.render();
                }
            });
        },
        render:function(){		
            $(  "#memberInformation"    ).html( this.template(  this.model.toJSON() )   );
            return this;
        }
		
    });
    var person = new person();
           
    var v = new BBView({model:person});
            
</script>
<script>
    var active = "Native";
    $(  "#SearchBox"         ).attr(    "dir"   ,   "rtl"   );
    $(  "#NewSearchResults"  ).attr(    "dir"   ,   "rtl"   );
    
    $(function(){
        
        $(  '.btn'  ).click(function(){
            
            $(  "#SearchBox"    ).  focus   (  );           
            $(  "#SearchBox"    ).  select  (  );
            $(  "#SearchBox"    ).  keyup   (  );
            
            if(     active == "Native"                               )
            {
                $(  "#SearchBox"        ).attr( "dir"   ,   "rtl"   );
                $(  "#NewSearchResults" ).attr( "dir"   ,   "rtl"   );

            }
            else
            {
                $(  "#SearchBox"        ).attr( "dir"   ,   "ltr"   );
                $(  "#NewSearchResults" ).attr( "dir"   ,   "ltr"   );

            }
            
        }) ;
        
    });
   
</script>
