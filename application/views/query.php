<?php if (validation_errors()): ?>
	<div class="row errors">
		<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-lg-4 col-lg-offset-4">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul>
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
				<h1>Query Section</h1>
				<p>In this section/page of <code>Remote SQL Server</code> just type the query in the text-field that is below. And then click on submit button and just watch the magic. If the query runs ok then the result will be appeared below the query input field.</p>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-lg-offset-1">
						<?php $attribute = array('role' => 'form', 'class' => 'query-form'); echo form_open('rsql/run_query', $attribute); ?>			
							<div class="form-group">
								<label for="textarea" class="col-sm-2 control-label">Type Query Here:</label>
								<div class="col-sm-12">
									<?php $attribute = array('name' => 'query', 'id' => 'textarea', 'class' => 'form-control', 'rows' => '3', 'required' => 'required'); echo form_textarea($attribute); ?>
								</div>
							</div>
							<?php $attribute = array('class' => 'btn btn-primary pull-right', 'id' => 'query-submit', 'value' => 'Run'); echo form_submit($attribute); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
				<?php if (isset($fields_name) AND isset($query_result)): ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-lg-offset-1 query-result-con">
							<h3 class="query-result-txt">Query Result</h3>
							<table class="table">
							    <thead>
									<tr>
										<?php foreach ($fields_name as $field_name): ?>
											<th><?php echo $field_name; ?></th>
										<?php endforeach ?>
									</tr>
								</thead>
							    <tbody>
							    	<?php foreach ($query_result as $result): ?>
									    <?php echo '<tr>'; ?>
									    	<?php foreach ($fields_name as $field_name): ?>
									    		<?php echo '<td>' . $result[$field_name] . '</td>'; ?>
									    	<?php endforeach ?>
							    		<?php echo '</tr>'; ?>
							    	<?php endforeach ?>
						    	</tbody>
							</table>
						</div>
					</div>
				<?php endif ?>
				<?php if (isset($query_count) AND isset($query_duration) AND isset($affected_rows)): ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-lg-offset-1 query-result-bot-con">
							<p class="query-result-des"><span>Affected rows:</span> <?php echo $affected_rows; ?> <span>Duration for 1 query:</span> <?php echo round($query_duration, 3) . ' sec'; ?> <span>For </span> <?php echo $query_count; ?> <span>Queries</span>.</p>
							<p class="query-result-des actual-query"><span>Query: </span><?php echo $query; ?></p>
						</div>
					</div>
				<?php endif ?>
				<?php if (isset($query_error)): ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-lg-offset-1 query-result-bot-con alert-bor-red">
							<p class="query-result-des query-err"><?php echo 'SQL Error (' . $query_error['code'] . '): ' . $query_error['message']; ?></p>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<script>
	var dbConnected = "<?php echo $this->session->flashdata('db_connected'); ?>";
	if (dbConnected) {
		$.toast({
			heading: 'Ohh WOW!:',
		    text: dbConnected,
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: {
		        left: 600,
		        top: 120
		    },
		    stack: false
		});
	};  
</script>