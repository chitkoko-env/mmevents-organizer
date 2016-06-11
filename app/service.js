app.service('sidebarSvc', function($location){

	this.sidebarList = [];

	this.getSidebarList = function(){
		var self = this;
		var url = $location.url();
		var splitURL = url.split("/");
		var respond = [];
		switch(splitURL[1]){
			case "home":
				respond.push(['Home', 'header']);
				respond.push(['home', 'home']);
				self.sidebarList = respond;
				return respond;
			break;

			case "event-list":
				respond.push(['Events', 'header']);
				respond.push(['Event List', 'event-list']);	
				self.sidebarList = respond;
				return respond;
			break;

			case "report":
			case "vehicle-report":
				respond.push(['Report', 'header']);
				respond.push(['Report', 'report']);
				respond.push(['Vehicle Report', 'vehicle-report']);
				self.sidebarList = respond;
				return respond;
			break;

			default:
			break;
		}
	}
});


//file upload with angularjs
app.service('pfileUpload',['$http',function($http){
	this.uploadProductFileToUrl = function(file,uploadUrl,scope){
		var fd = new FormData();
		fd.append('file',file);
		fd.append('newfilename',scope.uploadimgname);
		fd.append('eventid',scope.eventid);
		fd.append('userid',scope.userid);
		$http.post(uploadUrl,fd,{
			transformRequest:angular.identity,
			headers:{'Content-Type':undefined}
		})
		.success(function(data){
			// var date = new Date();
			// console.log(data);
			if(data.success == 'success'){
				// scope.path=scope.uploadimgname+"?"+date;
				toastr.success("Image was Successfully updated!");
			}else{
				toastr.error("Allow jpeg,jpg or png file type only!");
			}
		})
		.error(function(){

		});
	}
}])