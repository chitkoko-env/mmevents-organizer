<style>
/*err highlight*/
#txtErrtrue{border-color: #B94A48;}
#lblErrtrue{color:#B94A48;}
</style>
  <!-- Change Password Dialog -->
<script type="text/ng-template" id="chgpassdialog">
        <div class="modal-header">
            <a class="close" ng-click="closechgpassdialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-lock"></i>&nbsp; Change Password</h3>
        </div>

        <div class="modal-body">
            <form class="form-horizontal backwell" name="chgform" id="chgform">
            <fieldset>
		          <div class="form-group col-md-12" ng-class="{'has-error': chgform.cur.$invalid}">
		                <label class="control-label col-md-5" id="lblErr{{isCurPassErr}}" for="cur">Current Password:</label>
		                <div class="controls col-md-5">		                    	                                    
		                	<div class="right-inner-addon ">
							    <i class="fa fa-times" title="Password do not match!" ng-show="isCurPassErr" style="cursor:pointer;color:#B94A48;"></i>
							  	<input type="password" class="form-control" name="cur" id="txtErr{{isCurPassErr}}" ng-model="curpass" ng-keyup="checkcurpass()" ng-focus="true" required/>	
						    </div>
		                </div>
		          </div>

		          <div class="form-group col-md-12" ng-class="{'has-error': chgform.new.$invalid}">
		                <label class="control-label col-md-5" for="new">New Password:</label>
		                <div class="controls col-md-5">		                  
		                  	<input type="password" class="form-control" name="new" id="new" ng-model="newpass" ng-keyup="checknewpass(newpass)" required/> 	            
		                </div>
		          </div>

		          <div class="form-group col-md-12" ng-class="{'has-error': chgform.cfm.$invalid}">
		                <label class="control-label col-md-5" for="cfm" id="lblErr{{isConfirmPassErr}}">Confirm Password:</label>
		                <div class="controls col-md-5">	                        
		                  <div class="right-inner-addon ">
						    <i class="fa fa-times" title="Password do not match!" ng-show="isConfirmPassErr" style="cursor:pointer;color:#B94A48;"></i>
						  	<input type="password" class="form-control" name="cfm" id="txtErr{{isConfirmPassErr}}" ng-model="cfmpass" ng-keyup="checkconfirmpass(cfmpass)" required/> 
						  </div>
		                </div>
		          </div>
	          </fieldset>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closechgpassdialog()"><i class="fa fa-times"></i> Cancel</button>
            <button type="button" class="btn btn-default" ng-disabled="chgform.$invalid || isConfirmPassErr || isCurPassErr" ng-click="changepwd()">
            <i class="fa fa-check-square" style="color:rgb(36, 152, 11);"></i> Change</button>   
        </div>
</script>