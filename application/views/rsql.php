<?php if (validation_errors()): ?>
	<div class="row errors">
		<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-lg-4 col-lg-offset-4">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul class="db-errors">
					<?php echo validation_errors('<li>'); ?>
				</ul>
			</div>
		</div>
	</div>
<?php endif ?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="jumbotron brand-intro query-con">
			<div class="container">
				<div role="tabpanel">		    
				    <ul class="nav nav-tabs" role="tablist">
				        <li role="presentation" class="active">
				            <a href="#condb" aria-controls="condb" role="tab" data-toggle="tab">DB Connection</a>
				        </li>
				    </ul>
				    <div class="tab-content">
				        <div role="tabpanel" class="tab-pane active" id="condb">
				        	<div class="panel panel-default dbconPanel">
				        		<div class="container">
					        		<div class="panel-body">
					        			<?php if ($this->session->userdata('current_db') AND $this->session->userdata('db_slug')) { ?>
					        				<div class="db-no-con">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							        		   		<div class="page-header condbHead">
							        		   			<h1>Uhhh, So You want to Connect <small>DB!</small></h1>
													</div>	
													<div class="page-body condbBody condbBodyAlreadyConn">
							        		   			<div class="row">
							        		   				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
																<ul class="list-group db_con_info">
																	<li class="list-group-item db_con_info">
																		<p class="db_con_info_txt">Hey, you already connected with a DATABASE do you want to disconnect from current db and connect with other db then click the below button.</p>
																	</li>
																</ul>
																<?php $attribute = array('role' => 'form'); echo form_open('rsql/db_disconnect', $attribute); ?>
																	<div class="pull-right">
																		<?php $attribute = array('class' => 'btn btn-default con-diff-db', 'value' => 'Connect DB'); echo form_submit($attribute); ?>
																	</div>
																<?php echo form_close(); ?>
							        		   				</div>
							        		   			</div>
							        		   		</div>
							        		   	</div>
					        				</div>
					        			<?php } else { ?>
					        				<div class="db-connected">
							        		   	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							        		   		<div class="page-header condbHead">
							        		   			<h1>Connect to <small>DB</small></h1>
							        		   		</div>
							        		   		<div class="page-body condbBody">
							        		   			<div class="row">
							        		   				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							        		   					<?php $attribute = array('role' => 'form'); echo form_open('rsql/db_setting', $attribute); ?>
									        		   				<div class="row">
									        		   					<div class="col-lg-6 col-lg-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
											        		   				<div class="form-group">
											        		   					<label for="hostname"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> HOST/IP Address: </label>
											        		   					<?php $attribute = array('name' => 'hostname', 'class' => 'form-control', 'id' => 'hostname', 'required' => 'required', 'value' => '127.0.0.1'); echo form_input($attribute); ?>
											        		   				</div>
									        		   					</div>
										        		   				<div class="col-lg-6 col-lg-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
											        		   				<div class="form-group">
											        		   					<label for="port"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> DB Port: </label>
											        		   					<?php $attribute = array('name' => 'port', 'class' => 'form-control', 'id' => 'port', 'required' => 'required', 'value' => '3306'); echo form_input($attribute); ?>	
											        		   				</div>
									        		   					</div>
									        		   				</div>
									        		   				<div class="row">
									        		   					<div class="col-lg-6 col-lg-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
											        		   				<div class="form-group">
											        		   					<label for="dbname"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> DB Name: </label>
											        		   					<?php $attribute = array('name' =>'dbname', 'class' => 'form-control', 'id' => 'dbName', 'required' => 'required', 'value' => ''); echo form_input($attribute); ?>
											        		   				</div>
									        		   					</div>
									        		   					<div class="col-lg-6 col-lg-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
											        		   				<div class="form-group">
											        		   					<label for="dbUsername"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> DB Username: </label>
											        		   					<?php $attribute = array('name' =>'dbusername', 'class' => 'form-control', 'id' => 'dbUsername', 'required' => 'required', 'value' => 'root'); echo form_input($attribute); ?>
											        		   				</div>
									        		   					</div>
										        		   				<div class="col-lg-6 col-lg-offset-0 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
											        		   				<div class="form-group">
											        		   					<label for="dbpassword"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> DB Password: </label>
											        		   					<?php $attribute = array('name' =>'dbpassword', 'class' => 'form-control', 'id' => 'dbpassword'); echo form_input($attribute); ?>
											        		   				</div>
									        		   					</div>
									        		   				</div>
									        		   				<?php $attribute = array('class' => 'btn btn-primary pull-right', 'value' => 'Save Settings'); echo form_submit($attribute); ?>
									        		   			<?php echo form_close(); ?>
							        		   				</div>
							        		   			</div>
							        		   		</div>
							        		   	</div>
					        				</div>
					        			<?php } ?>
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
<script>
	var dbDisconnected = "<?php echo $this->session->flashdata('disconnected_success'); ?>";
	if (dbDisconnected) {
		$.toast({
		    heading: 'DB Connection:',
		    text: dbDisconnected,
		    hideAfter: 4000,
		    icon: 'success',
		    position: {
		        left: 600,
		        top: 120
		    },
		    stack: false
		});
	};	
	var dbNotFound = "<?php echo $this->session->flashdata('db_not_found'); ?>";
	if (dbNotFound) {
		$.toast({
		    heading: 'DB Connection:',
		    text: dbNotFound,
		    showHideTransition: 'fade',
		    icon: 'error',
		    position: {
		        left: 600,
		        top: 120
		    },
		    stack: false
		});
	};  
	var dbDropped = "<?php echo $this->session->flashdata('db_dropped'); ?>";
	if (dbDropped) {
		$.toast({
		    heading: 'Query Result:',
		    text: dbDropped,
		    showHideTransition: 'fade',
		    icon: 'success',
		    position: {
		        left: 600,
		        top: 120
		    },
		    stack: false
		});
	};  
</script>