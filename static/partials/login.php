<div class="container-fluid card" ng-controller="userAuthCtrl">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Welcome to MM Events System</h2>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">User Login</h3>
				</div>

				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
						<form accept-charset="UTF-8" role="form" name='loginForm'>
							<fieldset>
								<span style="color:red" ng-show="loginForm.username.$error || loginForm.password.$error">
									<span ng-show="loginForm.username.$error.required" class="help-inline">User name is required.</span>
									<span ng-show="loginForm.password.$error.required" class="help-inline">Password is required.</span>
								</span>
								<span style="color:red" ng-if="errormsgshow==true">
									<span class='help-inline'>{{error}}</span>
								</span>

								<div class="input-group input-group-lg" >
									<span class="input-group-addon"  id="sizing-addon1"><span class='glyphicon glyphicon-user'></span></span>
									<input class="form-control" placeholder="User Name" name="username" ng-model="user.username" type="text" aria-describedby="sizing-addon1" required>
								</div>
								
								<br/>
								<div class="input-group input-group-lg">
									<span class="input-group-addon" id="sizing-addon2"><span class='glyphicon glyphicon-lock'></span></span>
									<input class="form-control" placeholder="Password" name="password" ng-model="user.password" type="password" value="" aria-describedby="sizing-addon2" required>
								</div>
								
								<br/>
								<!-- <div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me"> Remember Me
									</label>
								</div> -->
								<button class="btn btn-lg btn-primary btn-block" ng-disabled="loginForm.$invalid" ng-click="login(user)"><span class='glyphicon glyphicon-off'></span> Login</button>
							</fieldset>
						</form>
					</div>
				</div>

				<div class="panel-footer" align="right">
					Developed by: <a class="logofont" href="https://www.eunovate.com" target="_blank">Eunovate Technologies</a>
				</div>
			</div>



		</div>
	</div>
</div>