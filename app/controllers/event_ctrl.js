		/**************************** Event List Controller ****************************/
app.controller("event_list", function($scope,$http,$location,$modal,$rootScope,$filter,loadData) {
	
	var serviceurl="Event_ctrl";
	$scope.animationsEnabled = true;
	$scope.currentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;
	$scope.organizerid = $rootScope.userid;
	geteventlist();

	function geteventlist(){
		var record = {};
		record.organizerid = $scope.organizerid;
		loadData(serviceurl,'geteventlist',record).success(function(data){
	    	 $scope.eventlst=data;
	    	 // console.log(data);
	         $scope.pagi=true;

	         $scope.totalitems=Math.ceil($scope.eventlst.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredEvent = $scope.eventlst.slice(begin, end);     
		});
	}
	$scope.geteventlist=geteventlist;

	$scope.pageChanged = function(){
		$scope.totalitems=Math.ceil($scope.eventlst.length / $scope.numPerPage)*10;

	          var begin = (($scope.currentPage - 1) * $scope.numPerPage)
	    , end = begin + $scope.numPerPage;
		    $scope.filteredEvent = $scope.eventlst.slice(begin, end);    
	};

	$scope.finddata=function(val){
	    $scope.pagi=false;
 
	 	if(typeof val!="undefined"){
	       if(val.$==""){
	 		geteventlist();
		    return;
		   }

		   $scope.filteredEvent=$scope.eventlst; 
		}
    }

	$scope.openeventdialog = function (size) { 	
		$scope.cedit=false;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventdialog',
	      controller: 'EventModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};		

 	$scope.goDetail = function(eventid){
 		$location.path("event-detail/"+eventid)
 	}
});

		/**************************** Event Modal Controller ****************************/
app.controller("EventModalCtrl", function($scope,scope,$http,$location,$modal,$modalInstance,$rootScope,loadData){
	
	var serviceurl="Event_ctrl";
	// console.log(scope.eventdtl);
	if(scope.cedit==true){
		$scope.title="Event Editing";
		$scope.btnprocess = "Update";

		$scope.eventtitle = scope.eventdtl.title;
		$scope.email = scope.eventdtl.email;
		$scope.phone = scope.eventdtl.phone;
		$scope.fax = scope.eventdtl.fax;
		$scope.fblink = scope.eventdtl.fb_link;
		$scope.weblink = scope.eventdtl.website;
		$scope.caddress = scope.eventdtl.contact;
		$scope.description = scope.eventdtl.ec_description;
	}
	else{
		$scope.title="Event Registration";
		$scope.btnprocess = "Save";
	}

	getcitylist();
	function getcitylist(){
		loadData(serviceurl,"getcitylist",'').success(function(data){
			$scope.citylst=data;
			if(scope.cedit==true){
				angular.forEach($scope.citylst,function(val,key){
					if(val.city_id==scope.eventdtl.city_id){
						$scope.selcity=val;
						gettownship(val.city_id);
					}
				});
			}
			else{
				$scope.selcity=data[0];	
				gettownship(data[0].city_id);		
			}
		});
	}

	//click on change township
	$scope.clickcity = function(cityval){
		// console.log(cityval);
		gettownship(cityval.city_id);
	}

	function gettownship(cityid){
		var record = {};
		record.cityid = cityid;
		loadData(serviceurl,"gettownshiplist",record).success(function(data){
			$scope.townshiplst=data;
			if(scope.cedit==true){
				$scope.townshiplst.splice(0,0,{township_id : 0,township_name:"All"});
				angular.forEach($scope.townshiplst,function(val,key){
					if(val.township_id==scope.eventdtl.township_id){
						$scope.seltownship=val;
					}
				});
			}
			else{
				$scope.townshiplst.splice(0,0,{township_id : 0,township_name:"All"});
                $scope.seltownship=data[0];			
			}
		});
	}

	getcatelist();
	function getcatelist(){
		loadData(serviceurl,"getcatelist",'').success(function(data){
			$scope.catelst=data;
			if(scope.cedit==true){
				angular.forEach($scope.catelst,function(val,key){
					if(val.category_id==scope.eventdtl.category_id){
						$scope.selcate=val;
						getsubcate(val.category_id);
					}
				});
			}
			else{
				$scope.selcate=$scope.catelst[0];	
				getsubcate($scope.catelst[0].category_id);		
			}
		});
	}

	//click on change sub category
	$scope.clickcate = function(cateval){
		// console.log(cateval);
		getsubcate(cateval.category_id);
	}

	function getsubcate(cateid){
		var record = {};
		record.cateid = cateid;
		loadData(serviceurl,"getsubcatelist",record).success(function(data){
			$scope.subcatelst=data;
			if(scope.cedit==true){
				angular.forEach($scope.subcatelst,function(val,key){
					if(val.sub_category_id==scope.eventdtl.sub_category_id){
						$scope.selsubcate=val;
					}
				});
			}
			else{
                $scope.selsubcate=data[0];			
			}
		});
	}

	getvenuelist();
	function getvenuelist(){
		loadData(serviceurl,"getvenuelist",'').success(function(data){
			$scope.venuelst=data;
			if(scope.cedit==true){
				angular.forEach($scope.venuelst,function(val,key){
					if(val.venue_id==scope.eventdtl.venue_id){
						$scope.selvenue=val;
					}
				});
			}
			else{
				$scope.selvenue=$scope.venuelst[0];		
			}
		});
	}
	



	$scope.addevent=function(){
		var record = {};
		record.organizerid = scope.organizerid;
		record.etitle=$scope.eventtitle;
		record.cityid=$scope.selcity.city_id;
		record.townshipid = $scope.seltownship.township_id;
		record.cateid = $scope.selcate.category_id;
		record.subcateid = $scope.selsubcate.sub_category_id;
		record.venueid = $scope.selvenue.venue_id;
		record.email = ($scope.email == undefined)? "" : $scope.email;
		record.phone = ($scope.phone == undefined)? "" : $scope.phone;
		record.fax = ($scope.fax == undefined)? "" : $scope.fax;
		record.fblink = ($scope.fblink == undefined)? "" : $scope.fblink;
		record.weblink = ($scope.weblink == undefined)? "" : $scope.weblink;
		record.caddress = ($scope.caddress == undefined)? "" : $scope.caddress;
		record.description = ($scope.description == undefined)? "" : $scope.description;

		// console.log(record);
		if(scope.cedit==false){
			loadData(serviceurl,"addevent",record).success(function(data){	
				if(data.success==true){
					toastr.success("New Event was Successfully Created!");
					$modalInstance.close();
					scope.geteventlist();
				}
			});		
		}
		else{
			record.eventid = scope.eventid;
			// console.log(record);
			loadData(serviceurl,"updateevent",record).success(function(data){	
				if(data.success==true){
					toastr.success("Event was Successfully Updated!");
					$modalInstance.close();
					scope.geteventdetail();
				}
			});			
		}
	}

	$scope.formenter=function(event){
		if(event.keyCode==13){
			if($scope.dataForm.$invalid==false){
				$scope.addevent();
			}
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }	
});

		/**************************** Event Details Controller ****************************/
app.controller("event_dtl", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData){
	
	var serviceurl="Event_ctrl";
	var eventid=$routeParams.param;
	$scope.eventid=eventid;
	$scope.organizerid = $rootScope.userid;

	$scope.active=1;
	$scope.animationsEnabled = true;

	$scope.bcurrentPage = 1;
	$scope.mcurrentPage = 1;
	$scope.numPerPage = 25;
	$scope.maxSize = 5;

	$scope.vupagi=true;
	$scope.mpagi=true;

	geteventdetail();
	$scope.addbtnctrl = true;
	function geteventdetail(){
		// console.log(eventid);
		var record = {};
		record.userid = $scope.organizerid;
		record.eventid = eventid;
		loadData(serviceurl,"geteventdetail",record).success(function(data){
			console.log(data);	
			if(data.length > 0){
				$scope.eventdtl=data[0];
				chkdate = $scope.eventdtl.start_date;
				if(chkdate != null){
					$scope.addbtnctrl = false;
				}

				$scope.showschedulelst();
			}else{
				$location.path('404');
			}
		});		
	}
	$scope.geteventdetail=geteventdetail;

	/*Vehicle Usage Section*/
	$scope.showvehicleusage=function(){
		$scope.active=1;
		console.log('tag1');
	}

    /*Maintenance Section*/
  	$scope.showmaintenance=function(){
		$scope.active=2;
		console.log('tag2');
	}

 	/*Gallery Lists Section*/
  	$scope.showschedulelst=function(){
		$scope.active=3;
		var record = {};
		record.eventid = eventid;
		loadData(serviceurl,"geteventgallery",record).success(function(data){
			console.log(data);
			$scope.eventimgs = data;
		});

	}

	$scope.openeventeditdialog = function (size) { 	
	    $scope.cedit=true;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventdialog',
	      controller: 'EventModalCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	}; 

 	$scope.addeventdatedialog = function (size) { 	
	    $scope.ededit=false;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventdatedialog',
	      controller: 'eventdatemodal',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	}; 

 	$scope.editeventdatedialog = function (size) { 	
	    $scope.ededit=true;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventdatedialog',
	      controller: 'eventdatemodal',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	}; 


 	//add cover image
 	$scope.addcimagedialog = function (size) { 	
	    $scope.cimgedit=false;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventimgdialog',
	      controller: 'imguploadmodal',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	//update cover image
 	$scope.updatecimagedialog = function (size) { 	
	    $scope.cimgedit=false;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventimgdialog',
	      controller: 'imguploadmodal',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	//add event images
 	$scope.addegimgdialog = function (size) { 	
	    $scope.egimgedit=false;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'eventimgdialog',
	      controller: 'egimguploadmodal',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	//confirm box del modal control
	$scope.delimg = function (size,data) {
		$scope.deldata=data;

		var modalInstance = $modal.open({
		  animation: $scope.animationsEnabled,
		  templateUrl: 'delConfirmContent',
		  controller: 'eimgDeleteInstanceCtrl',
		  size: size,
		  resolve:{
				scope:function(){
					return $scope;
				}
			}
		});
	}

	//add event map 
 	$scope.addemapdialog = function (size) { 	
	    $scope.emapedit=false;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'getmaplContent',
	      controller: 'emapInstanceCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

 	//edit event map 
 	$scope.editemapdialog = function (size) { 	
	    $scope.emapedit=true;
	    // $scope.editdata=c;
	    var citymodal = $modal.open({
	      animation: $scope.animationsEnabled,
	      templateUrl: 'getmaplContent',
	      controller: 'emapInstanceCtrl',
	      size: size,
	      resolve: {
		        scope: function () {
		          return $scope;
		        }
   		  }
	  });
 	};

});	
		/**************************** Event Details Date Control Controller ****************************/
app.controller("eventdatemodal", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData,scope,$modalInstance){

	var serviceurl="Event_ctrl";

	if(scope.ededit==true){
		// console.log(scope.eventdtl);
		$scope.title="Update Event Date";

		var formatsdate = new Date(scope.eventdtl.start_date);
		$scope.startdate = formatsdate;
		if(scope.eventdtl.end_date != "0000-00-00"){
			$scope.emoredatechk = true;
			var formatedate = new Date(scope.eventdtl.end_date);
			$scope.enddate = formatedate;
		}else{
			$scope.emoredatechk = false;
			var formatsdate = new Date(scope.eventdtl.start_date);
			$scope.enddate = formatsdate;
		}

		var sstarttime = new Date(scope.eventdtl.start_time);
		var estarttime = new Date(scope.eventdtl.end_time);
		$scope.stime = new Date(sstarttime.getFullYear(),sstarttime.getMonth(),sstarttime.getDay(), sstarttime.getHours(),sstarttime.getMinutes(),0);
		$scope.etime = new Date(estarttime.getFullYear(),estarttime.getMonth(),estarttime.getDay(), estarttime.getHours(),estarttime.getMinutes(),0);
		$scope.btnctrl = 'Update';
		
	}else{
		$scope.title="Add Event Date";
		var date = new Date();
		$scope.startdate = date;
		var tomorrow = new Date();
		tomorrow.setDate(tomorrow.getDate() + 1);
		$scope.enddate = tomorrow;
		$scope.stime = new Date(date.getFullYear(),date.getMonth(),date.getDay(), date.getHours(),date.getMinutes(),0);
		$scope.etime = new Date(date.getFullYear(),date.getMonth(),date.getDay(), date.getHours()+1,date.getMinutes(),0);
		$scope.emoredatechk = false;
		$scope.btnctrl = 'Save';
	}
	

	$scope.oneclickbtn = false;
	$scope.addedate = function(){
		$scope.oneclickbtn = true;
		var record = {};
		record.eventid = scope.eventid;
		record.startdate = $filter('date')($scope.startdate, "yyyy-MM-dd");
		record.enddate = $filter('date')($scope.enddate, "yyyy-MM-dd");
		record.edatechk = $scope.emoredatechk;
		record.starttime = $filter('date')($scope.stime, record.startdate+" HH:mm:ss");
		record.endtime = $filter('date')($scope.etime, record.startdate+" HH:mm:ss");
		// console.log(record);
		if(scope.ededit==true){
			loadData(serviceurl,"editeventdate",record).success(function(data){	
				if(data.success==true){
					toastr.success("Event's Date & Time was Successfully Updated!");
					$modalInstance.close();
					scope.geteventdetail();
				}
			});		
		}else{
			loadData(serviceurl,"addeventdate",record).success(function(data){	
				if(data.success==true){
					toastr.success("Event's Date & Time was Successfully Added!");
					$modalInstance.close();
					scope.geteventdetail();
				}
			});	
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }

});	

		/**************************** Event Cover Image Upload Control Controller ****************************/
app.controller("imguploadmodal", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData,scope,$modalInstance,pfileUpload,$route){
	var serviceurl="Event_ctrl";

	$scope.title="Upload Event Cover Image";
	$scope.eventid = scope.eventid;

	$scope.uploadFile = function(){
		var file=$('#imgupload')[0].files[0];
		// console.log(file);
		if(file.type=="image/jpeg"){
			$scope.imgext = ".jpg";
		}else if(file.type=="image/png"){
			$scope.imgext = ".png";
		}
		$scope.uploadimgname = "eimage"+$scope.eventid+$scope.imgext;

		if(file.size>2097152){
			toastr.error("File Size Limit(2MB) Exceeded!");
		}else if(file.size<0){
			toastr.error("Please choose a image!");
		}else if(file.type!="image/jpeg" && file.type!="image/png") {
			toastr.error("Upload only image file type!");
		}else{
			var uploadUrl = BASE_URL+"Event_ctrl/do_upload";
			// console.log($scope.uploadimgname);
			pfileUpload.uploadProductFileToUrl(file,uploadUrl,$scope);
			// console.log('reach');
			$modalInstance.close();
			$route.reload();
		}
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }

});	

		/**************************** Event Gallery Image Upload Control Controller **************************/
app.controller("egimguploadmodal", function($scope,$http,$location,$modal,$rootScope,$filter,$routeParams,loadData,scope,$modalInstance,pfileUpload,$route){
	var serviceurl="Event_ctrl";

	$scope.title="Upload Event Images";
	$scope.eventid = scope.eventid;
	$scope.userid = scope.organizerid;

	$scope.uploadFile = function(){
		var file=$('#imgupload')[0].files[0];
		// console.log(file);
		if(file.type=="image/jpeg"){
			$scope.imgext = ".jpg";
		}else if(file.type=="image/png"){
			$scope.imgext = ".png";
		}
		var randomid = makeid();
		$scope.uploadimgname = "eimage"+$scope.eventid+'-g'+randomid+$scope.imgext;

		if(file.size>2097152){
			toastr.error("File Size Limit(2MB) Exceeded!");
		}else if(file.size<0){
			toastr.error("Please choose a image!");
		}else if(file.type!="image/jpeg" && file.type!="image/png") {
			toastr.error("Upload only image file type!");
		}else{
			var uploadUrl = BASE_URL+"Event_ctrl/do_upload_gallery";
			// console.log($scope.uploadimgname);
			pfileUpload.uploadProductFileToUrl(file,uploadUrl,$scope);
			// console.log('reach');
			$modalInstance.close();
			$route.reload();
		}
	}

	function makeid()
	{
	    var text = "";
	    var possible = "abcdefghijklmnopqrstuvwxyz0123456789";//ABCDEFGHIJKLMNOPQRSTUVWXYZ

	    for( var i=0; i < 3; i++ )
	        text += possible.charAt(Math.floor(Math.random() * possible.length));

	    return text;
	}

	$scope.closedialog=function(){
   		$modalInstance.close();
    }

});	

		/**************************** Event Image Delete Confirm Modal Controller ****************************/
app.controller("eimgDeleteInstanceCtrl", function($scope,scope,$http,$modal,$modalInstance,$rootScope,loadData,$route){
	var serviceurl="Event_ctrl";

	// console.log(scope.deldata);
	//modal option
	$scope.ok = function () {
		$modalInstance.close($scope.deleimgdata());
	};
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	$scope.title = "Delete Image File";
	$scope.actiontext = 'delete';

	$scope.deleimgdata = function(){
		var record = {};
		record.eimgid = scope.deldata.eimg_id;
		record.imgfile = scope.deldata.imgfile;
		console.log(record);

		loadData(serviceurl,"deleimage",record).success(function(data){
			console.log(data);
			if(data.success==true){
				toastr.success("Event Image was Successfully Deleted!");
				$modalInstance.close();
				$route.reload();
			}else{
				toastr.warning("Event Image is not Delete!");
			}
		});
	}
})

		/**************************** Event Map Modal Controller ****************************/
app.controller("emapInstanceCtrl", function($scope,scope,$http,$modal,$modalInstance,$rootScope,loadData,$route,$timeout,NgMap){
	var serviceurl="Event_ctrl";

	console.log(scope.eventdtl);
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	$scope.$watch('google', function(google){ $scope.map = NgMap.initMap('map'); });

	// NgMap.getMap({id:"mymap"}).then(function(map) {

 //   		var latlng = new google.maps.LatLng(40, -110);
 //       	map.setCenter(latlng);
 //       	map.setZoom(4);
 //       	window.map = map;
 //    });
    
 //    $scope.setCenter = function(){
 //      window.map.setCenter(new google.maps.LatLng(50, -110) );
 //    }

	if(scope.emapedit==true){
		$scope.title = "Edit Map Location";
		$scope.latlng = [scope.eventdtl.map_lat,scope.eventdtl.map_lng];
		$scope.selcentlat = scope.eventdtl.map_lat;
		$scope.selcentlng = scope.eventdtl.map_lng;
		$scope.defaultzoonlvl = 15;
		$scope.btnctrl = 'Update';

		// var myLatlng = new google.maps.LatLng($scope.selcentlat, $scope.selcentlng);
  //       var mapOptions = {
  //         zoom: $scope.defaultzoonlvl,
  //         center: myLatlng,
  //         mapTypeId: google.maps.MapTypeId.ROADMAP,
  //       };
  //       var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  //       var marker = new google.maps.Marker({
  //           map: map,
  //           draggable: true,
  //           position: myLatlng
  //       });

		// window.setTimeout(function(){
                                                      
  //          google.maps.event.trigger(map, 'resize');
  //       },100);

		

	}else{
		$scope.title = "Add Map Location";
		$scope.latlng = [16.80528,96.15611];
		$scope.selcentlat = 16.80528;
		$scope.selcentlng = 96.15611;
		$scope.defaultzoonlvl = 13;
		$scope.btnctrl = 'Save';
	}

	
	$scope.getpos = function(event){
	    $scope.latlng = [event.latLng.lat(), event.latLng.lng()];
	};

	$scope.addemap = function(){
		var record = {};
		record.eventid = scope.eventid;
		record.emaplat = $scope.latlng[0];
		record.emaplng = $scope.latlng[1];
		console.log(record);

		loadData(serviceurl,"addeventmap",record).success(function(data){
			// console.log(data);
			if(data.success==true){
				toastr.success("Event's Map was Successfully Created!");
				$modalInstance.close();
				scope.geteventdetail();
				// $window.location.reload();
				$route.reload;
			}else{
				toastr.warning("Event's Map is not Create!");
			}
		});
	}
})

