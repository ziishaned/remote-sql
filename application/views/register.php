<div class="row" id="login-form">
	<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-lg-4 col-lg-offset-4">
		<ul class="nav nav-tabs">
			<li role="presentation" class="login-form-btn-li"><a href="<?php echo base_url('user/login'); ?>" class="login-form-btn">Login</a></li>
		  	<li role="presentation" class="active login-form-btn-li"><a href="<?php echo base_url('user/register'); ?>" class="login-form-btn">Register</a></li>
		</ul>
		<?php $attributes = array('role' => 'form', 'class' => 'login'); echo form_open('user/register_user', $attributes); ?>	
			<div class="form-group">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<?php $attributes = array('name' => 'username', 'placeholder' => 'Enter Username', 'class' => 'form-control', 'id' => 'username'); echo form_input($attributes); ?>	
			</div>
			<div class="form-group">
				<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
				<?php $attributes = array('name' => 'password', 'placeholder' => 'Enter Password', 'class' => 'form-control', 'id' => 'password'); echo form_password($attributes); ?>	
			</div>
			<div class="form-group">
				<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
				<?php $attributes = array('name' => 'repassword', 'placeholder' => 'Re-Type Password', 'class' => 'form-control', 'id' => 're-password'); echo form_password($attributes); ?>	
			</div>
			<div class="form-group">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				<?php $attributes = array('name' => 'email', 'placeholder' => 'Enter email Id', 'class' => 'form-control', 'id' => 'email'); echo form_input($attributes); ?>	
			</div>
			<div class="row">
				<div class="col-xs-12 col-xs-offset-6 col-sm-12 col-sm-offset-7 col-md-12 col-lg-5 col-lg-offset-7">
					<?php $attributes = array('class' => 'btn btn-default', 'id' => 'btn-register register_me', 'value' => 'Register'); echo form_submit($attributes); ?>			
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>	
</div>
<script>
	var toast = ($.toast);
		
	$('input.btn').on('click', function(event) {
		event.preventDefault();

		var errors = [];
		var username = $('input#username').val();
		var password = $('input#password').val();
		var repassword = $('input#re-password').val();
		var email = $('input#email').val();

		if (username == null || username == "") {
			errors.push('The Username field is required.');
		}


		if (username != null && username != "") {
			if (username.length < 3) {
				errors.push('The Username must be greater than 3 characters.');
			}

			if (username.length > 20) {
				errors.push('The Username must be less than 20 characters.');
			}
		}
		
		if (password == null || password == "") {
			errors.push('The Password field is required.');
		}

		if (password != null && password != "") {
			if (password.length < 6) {
				errors.push('The Password must be greater than 6 characters.');
			}

			if (password.length > 20) {
				errors.push('The Password must be less than 20 characters.');
			}
		}

		if (repassword == null || repassword == "") {
			errors.push('The Re-Type Password field is required.');
		}

		if (email == null || email == "") {
			errors.push('The Email field is required.');
		}

		if (password != null && password != "" && repassword != null && repassword != "") {
			if (password != repassword) {
				errors.push('The Re-Type Password and Password not matched.');
			};
		}

		if (errors.length != 0) {
			toast({
				heading: 'Query Error:',
			    text: errors,
			    showHideTransition: 'fade',
			    icon: 'error',
			    position: {
			        left: 492,
			        top: 30
			    },
			    stack: false, 
			    hideAfter: 9000
			});
		} else {
			$.ajax({
				url: 'http://localhost/remote-sql-master/user/register_user',
				type: 'POST',
				dataType: 'json',
				data: {
					data: {
						'username' : username,
						'password' : password,
						'email' : email
					}
				},
				success: function(data) {
			        if (data == true) {
			        	toast({
							heading: 'Successfully Registered:',
						    text: 'You have been successfully registered.',
						    showHideTransition: 'fade',
						    icon: 'success',
						    position: {
						        left: 492,
						        top: 90
						    },
						    stack: false, 
						    hideAfter: 9000
						});
			        } else {
			        	alert("We are having connection problems.");
			        }
			    },
			    error: function(e) {
				   alert(e.message);
				}
			});			
		}
	});

</script>