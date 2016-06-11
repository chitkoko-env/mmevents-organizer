<link href="./static/css/vehicle.css" rel="stylesheet"/>
<div class="container-fluid card" ng-controller="event_dtl">
	<title>Event Details</title>
    <div class="header row">
   		<i class="fa fa-map-marker"></i> Event Details 
 	</div>

	<div style="margin: 7px 0px 15px 0px;" align="left">
		<a href="javascript:history.back()" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> <b>Back</b></a>
		<button ng-click="openeventeditdialog('md')" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o" style="color:#FF6C00;" ></i> <b>Edit</b></button>	
	</div>

  <div class="row">
		<div class="col-md-6">
			<table class="table table-striped table-hover" style="background-color:white">
				<tr>
					<td style="width:30%">Title:</td>
        	<td style="text-align:left;">{{eventdtl.title}}</td>
				</tr>
        <tr>
          <td>City:</td>
          <td>{{eventdtl.city_name}}</td>
        </tr>
        <tr>
          <td>Township:</td>
          <td>{{eventdtl.township_name}}</td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>{{eventdtl.category_name}}</td>
        </tr>
        <tr>
          <td>Sub Category:</td>
          <td>{{eventdtl.sub_category_name}}</td>
        </tr>
        <tr>
          <td>Venue:</td>
          <td>{{eventdtl.v_name}}</td>
        </tr>
        <tr>
          <td>Phone:</td>
          <td>{{eventdtl.phone}}</td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>{{eventdtl.email}}</td>
        </tr>
        <tr>
          <td>Contact:</td>
          <td>{{eventdtl.contact}}</td>
        </tr>
        
      </table>
		</div>

    <div class="col-md-6">
      <table class="table table-striped table-hover" style="background-color:white">
        <tr>
          <td style="width:30%">Fax:</td>
          <td>{{eventdtl.fax}}</td>
        </tr>
        <tr>
          <td>Website:</td>
          <td>{{eventdtl.website}}</td>
        </tr>
        <tr>
          <td>FB link:</td>
          <td>{{eventdtl.fb_link}}</td>
        </tr> 
        <tr>
          <td>Description:</td>
          <td>{{eventdtl.ec_description}}</td>
        </tr>   
        <tr>
          <td>Event Date:</td>
          <td>
            <button ng-click="addeventdatedialog('md')" class="btn btn-default btn-sm" ng-show="addbtnctrl"><i class="fa fa-calendar" ></i> <b>Add Date</b></button>
            <span ng-hide="addbtnctrl">
              {{eventdtl.start_date | datetimeformat}}
              <span ng-if="eventdtl.end_date!='0000-00-00'">To {{eventdtl.end_date | datetimeformat}}</span>
            </span>
          </td>
        </tr> 
        <tr ng-hide="addbtnctrl">
          <td>Time:</td>
          <td>{{eventdtl.start_time | timeformat}} - {{eventdtl.end_time | timeformat}}</td>
        </tr>
        <tr ng-hide="addbtnctrl">
          <td></td>
          <td>
            <button ng-click="editeventdatedialog('md')" class="btn btn-default btn-sm"><i class="fa fa-calendar" ></i> <b>Update Date/Time</b></button>
          </td>
        </tr>
        <tr>
          <td>Google Map:</td>
          <td>
            <button ng-click="addemapdialog('md')" class="btn btn-default btn-sm" ng-if="eventdtl.map_lat==''"><i class="fa fa-map-marker" ></i> <b>Add Map</b></button>

            <button ng-click="editemapdialog('md')" class="btn btn-default btn-sm" ng-if="eventdtl.map_lat!=''"><i class="fa fa-map-marker" ></i> <b>Edit Map</b></button>
          </td>
        </tr>
      </table>
    </div>

	</div>

	<!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="" role="tab" data-toggle="tab"  ng-click="showvehicleusage()">
              <i class="fa fa-suitcase"></i> Test 1
          </a>
      </li>
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showmaintenance()">
          <i class="fa fa-info-circle"></i>  Test 2
        </a>
      </li>  
      <li>
        <a href="" role="tab" data-toggle="tab" ng-click="showschedulelst()">
          <i class="fa fa-picture-o"></i>  Gallery
        </a>
      </li>   
    </ul>

   <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" ng-show="active==1">
      
        
      </div>

      <div class="tab-pane fade active in" ng-show="active==2">      
        
        
      </div>

      <!--tab pane 3-->
      <div class="tab-pane fade active in" ng-show="active==3">      
        
        <!-- vehicle usage content -->
        <div class="row">     
          <div class="col-xs-12 col-md-4" >
             
            <button ng-click="addcimagedialog()" class="btn btn-default" ng-show="eventdtl.imgfile==''"><i class="fa fa-file-image-o i-add"></i> <b>Add Cover Photo</b></button>   

            <button ng-click="addegimgdialog()" class="btn btn-default"><i class="fa fa-file-image-o i-add"></i> <b>Add Photos</b></button>                 
          </div>      
        </div> 

        <div style="float:right;width:170px;">Count : {{filteredCCourse.length}}10 | Total : 10{{classcourse.length}}</div>
        <br>

        <div class="row image-gallery-blk">
          
          <div class="col-md-4" ng-show="eventdtl.imgfile!=''">
            <div class="thumbnail">
              <div class="gallery-block">
                <img src="static/uploadimgs/thumbs/{{eventdtl.imgfile}}">
              </div>
              
              <span class="label label-primary">Cover</span>
              <a class="btn btn-info btn-xs" title="Update" ng-click="updatecimagedialog()">
                <i class="fa fa-pencil-square-o"></i> Update
              </a>
            </div>
          </div> 

          <div class="col-md-4" ng-repeat="ei in eventimgs">
            <div class="thumbnail">
              <div class="gallery-block">
                <img src="static/uploadimgs/thumbs/{{ei.imgfile}}">
              </div>
              
              <a class="btn btn-danger btn-xs" title="Delete" ng-click="delimg('',ei)">
                <i class="fa fa-minus-circle"></i> Delete
              </a>
            </div>
          </div> 

        </div>

      </div>
      

    </div>
    

    <?php include('./event_dialog_tpl.php');?>  

    <!-- Add Event Date Dialog -->
    <script type="text/ng-template" id="eventdatedialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-calendar-o"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset> 
                  
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="eventdate"></label>
                      <div class="controls col-md-6">
                          <input type="checkbox" ng-model='emoredatechk'> Your event is more than one day? 
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.startdate.$invalid}" >
                      <label class="control-label col-md-5" for="startdate">Start Date:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="startdate" ng-model="startdate" ng-keyup="formenter($event)" required/> 
                          <p class="help-block">eg : MM/DD/YYYY</p>                       
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.enddate.$invalid}" ng-show="emoredatechk==true">
                      <label class="control-label col-md-5" for="enddate">End Date:</label>
                      <div class="controls col-md-5">
                          <input type="date" class="form-control" name="enddate" ng-model="enddate" ng-keyup="formenter($event)" required/> 
                          <p class="help-block">eg : MM/DD/YYYY</p>                       
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.stime.$invalid}">
                      <label class="control-label col-md-5" for="stime">Start Time:</label>
                      <div class="controls col-md-5">
                          <input type="time" class="form-control" name="stime" ng-model="stime" placeholder="HH:mm:ss" required/>                        
                      </div>
                  </div> 

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.etime.$invalid}">
                      <label class="control-label col-md-5" for="etime">End Time:</label>
                      <div class="controls col-md-5">
                          <input type="time" class="form-control" name="etime" ng-model="etime" placeholder="HH:mm:ss" required/>                        
                      </div>
                  </div> 
                                  
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="addedate()" ng-disabled="dataForm.$invalid || oneclickbtn" class="btn btn-default"><i class="fa fa-check i-save"></i> {{btnctrl}}</button>
        </div>
    </script>
    <!-- End of Event Date Dialog --> 

    <!-- Add Event Image Dialog -->
    <script type="text/ng-template" id="eventimgdialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-calendar-o"></i>&nbsp; {{title}}</h3>
        </div>

        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset> 
                  

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.imagef.$invalid}">
                      <label class="control-label col-md-5" for="imagef">Image File:</label>
                      <div class="controls col-md-5">
                          <input type="file" class="form-control" id="imgupload" name="imagef" ng-model="myFile"/> 
                          <p class="help-block">* upload only image file.</p>                       
                      </div>
                  </div>
                                  
                </fieldset>
            </form>
        </div>

         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="uploadFile()" ng-disabled="dataForm.$invalid || oneclickbtn" class="btn btn-default"><i class="fa fa-check i-save"></i> Upload</button>
        </div>
    </script>
    <!-- End of Event Image Dialog --> 

    <!--Event Image delete confirm box-->
    <script type="text/ng-template" id="delConfirmContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()">&times;</button>
        <h4 class="modal-title">{{title}}</h4>
      </div>
      <div class="modal-body">
          Are you sure you want to {{actiontext}}?
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="ok()">Yes</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="cancel()">No</button>
      </div>
    </script>
    <!-- End of Course delete confirm box -->


    <!--Event map location box-->
    <script type="text/ng-template" id="getmaplContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()">&times;</button>
        <h3  class="modal-title"><i class="fa fa-map-marker"></i>&nbsp; {{title}}</h3>
      </div>
      <div class="modal-body">
          <div>  
              <ng-map id="map" center="[{{selcentlat}},{{selcentlng}}]" zoom="{{defaultzoonlvl}}" on-click="getpos($event)" centered="true">
                <marker position="{{latlng}}" title="Event Map!" on-dragend="getpos($event)" 
                  animation="DROP" draggable="true"></marker>
              </ng-map>
          </div>
      </div>
      
      <div class="modal-footer">
          <button class="btn btn-default cancel" ng-click="cancel()"><i class="fa fa-times"></i> Cancel</button>                          
          <button ng-click="addemap()" ng-disabled="dataForm.$invalid || oneclickbtn" class="btn btn-default"><i class="fa fa-check i-save"></i> {{btnctrl}}</button>
      </div>
    </script>
    <!-- End of Event map location box -->

    
  
</div>

  