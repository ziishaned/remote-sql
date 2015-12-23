<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="jumbotron brand-intro query-con">
			<div class="container">
				<!-- <h1>User Profile</h1> -->
				<div role="tabpanel">
				    
				    <ul class="nav nav-tabs" role="tablist">
				        <li role="presentation" class="active">
				            <a href="#userPro" aria-controls="userPro" role="tab" data-toggle="tab">Profile</a>
				        </li>
				        <li role="presentation">
				            <a href="#security" aria-controls="security" role="tab" data-toggle="tab">Security</a>
				        </li>
				    </ul>
				    <div class="tab-content">
				        <div role="tabpanel" class="tab-pane active" id="userPro">
				        	<div class="panel panel-default homePanel">
				        		<div class="container">
					        		<div class="panel-body">
					        		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					        		   		<div class="page-header homeHead">
					        		   			<h1>User <small>Profile</small></h1>
					        		   		</div>
					        		   		<div class="page-body homeBody">
					        		   			<div class="row">
					        		   				<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
							        		   			<div class="userProImg">
								        		   			<img src="<?php echo base_url(); ?>assets/img/user-img.jpg" class="text-center img-responsive img-rounded" alt="Image">
							        		   			</div>
					        		   				</div>
					        		   				<div class="col-xs-1 col-xs-offset-1 col-sm-5 col-md-5 col-lg-7 col-lg-offset-1">
							        		   			<div class="userProInfo">
															<div class="userProInfoInner">
																<div class="form-group">
																	<label>Username:</label>
																	<p><?php echo $user_data->username; ?></p>
																</div>
																<div class="form-group">
																	<label>Email:</label>
																	<p><?php echo $user_data->email; ?></p>
																</div>
																<div class="form-group">
																	<label>Joined Since:</label>
																	<p><?php echo $user_data->joined_date; ?></p>
																</div>
															</div>
							        		   			</div>
					        		   				</div>
					        		   			</div>
					        		   		</div>
					        		   </div>
					        		</div>
				        		</div>
				        	</div>
				        </div>
				        <div role="tabpanel" class="tab-pane" id="security">
				        	<div class="panel panel-default securityPanel">
				        		<div class="container">
					        		<div class="panel-body">
					        		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					        		   		<div class="page-header securityHead">
					        		   			<h1>Security <small>Setting</small></h1>
					        		   		</div>
					        		   		<div class="page-body securityBody">
					        		   			<div class="row">
					        		   				<div class="col-xs-12 col-sm-7 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-5 col-lg-offset-3">
							        		   			<div class="panel panel-info">
						        		   				  	<div class="panel-heading">
						        		   						<h3 class="panel-title">Change Secuity Settings</h3>
						        		   				  	</div>
						        		   				  	<div class="panel-body secutrityInfo">
						        		   						<p>If you want to change Username and Password just fill the below form and submit it. Or Leave it as it is if you don't want to change username and Password.</p>
						        		   				 	</div>
							        		   			</div>
							        		   			<?php $attribute = array('role' => 'form'); echo form_open('user/change_security', $attribute); ?>
							        		   				<div class="form-group">
							        		   					<label for="username">Username:</label>
							        		   					<?php $attribute = array('name' => 'username', 'class' => 'form-control', 'id' => 'username', 'value' => "$user_data->username", 'required' => 'required'); echo form_input($attribute); ?>
							        		   				</div>
							        		   				<div class="form-group">
							        		   					<label for="password">Password:</label>
							        		   					<?php $attribute = array('name' => 'password', 'class' => 'form-control', 'id' => 'password', 'value' => "$user_data->password", 'required' => 'required'); echo form_password($attribute); ?>
							        		   				</div>
							        		   				<div class="form-group">
							        		   					<label for="re-password">Re-Type Password:</label>
							        		   					<?php $attribute = array('name' => 're-password', 'class' => 'form-control', 'id' => 're-password', 'value' => "$user_data->password", 'required' => 'required'); echo form_password($attribute); ?>
							        		   				</div>
							        		   				<?php $attribute = array('class' => 'btn btn-primary pull-right', 'value' => 'Save Settings'); echo form_input($attribute); ?>
							        		   			<?php echo form_close(); ?>
					        		   				</div>
					        		   			</div>
					        		   		</div>
					        		   </div>
					        		</div>
				        		</div>
				        	</div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>