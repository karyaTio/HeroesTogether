<div class="container">
	<h3>Heroes Lists</h3>
	<div class="alert alert-success" style="display: none;">

	</div>
	<button id="btnAdd" class="btn btn-success">Add New</button>
	<table class="table table-bordered table-responsive" style="margin-top: 20px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>Heroes Name</td>
				<td>Real Name</td>
				<td>Age</td>
				<td>Power</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody id="showdata">

		</tbody>
	</table>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="" method="post" class="form-horizontal">
        		<input type="hidden" name="id" value="0">

        		<div class="form-group ">
        			<label for="name" class="label-control col-md-4">Heroes Name</label>
        			<div class="col-md-8">
        				<input type="text" name="hero_name" class="form-control" required>
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Real Name</label>
        			<div class="col-md-8">
        				<input type="text" name="real_name" class="form-control" required>
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Age</label>
        			<div class="col-md-8">
        				<input type="text" name="umur" class="form-control" required>
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Power</label>
        			<div class="col-md-8">
        				<textarea name="power" required></textarea>
        			</div>
        		</div>
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        	Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){
		showAllHeroes();

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Add New Super Heroes');
			$('#myForm').attr('action', '<?php echo base_url() ?>heroes/save');
		});


		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var hero_name = $('input[name=hero_name]');
			var real_name = $('input[name=real_name]');
			var umur = $('input[name=umur]');
			var power = $('textarea[name=power]');
			var result = true;

			if(hero_name.val()==''){
				hero_name.parent().parent().addClass('has-error');
				result = false;
			}else{
				hero_name.parent().parent().removeClass('has-error');
			}
			if(real_name.val()==''){
				real_name.parent().parent().addClass('has-error');
				result = false;
			}else{
				real_name.parent().parent().removeClass('has-error');
			}
			if(umur.val()==''){
				umur.parent().parent().addClass('has-error');
				result = false;
			}else{
				umur.parent().parent().removeClass('has-error');
			}
			if(power.val()==''){
				power.parent().parent().addClass('has-error');
				result = false;
			}else{
				power.parent().parent().removeClass('has-error');
			}

			if(result){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						$('#myModal').modal('hide');
						$('#myForm')[0].reset();

						if(response.type=='add'){
							var type = 'added'
						}else if(response.type=='update'){
							var type ="updated"
						}

						$('.alert-success').html('Heroes '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');

						showAllHeroes();
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(errorThrown);
					}
				});
			}
		});

		//edit
		$('#showdata').on('click', '.item-edit', function(){
			
			var id = $(this).attr('data');
			$('#myModal').modal('show'); // Panggil Modal
			$('#myModal').find('.modal-title').text('Edit Heroes');
			$('#myForm').attr('action', '<?php echo base_url() ?>heroes/update_hero');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>heroes/getById',
				data: {id: id},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=hero_name]').val(data.hero_name);
					$('textarea[name=real_name]').val(data.real_name);
					$('textarea[name=umur]').val(data.umur);
					$('textarea[name=power]').val(data.power);
					$('input[name=Id]').val(data.id);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});

		//delete-
		$('#showdata').on('click', '.item-delete', function(){

			var id = $(this).attr('data');

			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>heroes/delete_hero',
					data:{id:id},
					dataType: 'json',
					success: function(response){

						$('#deleteModal').modal('hide');
						$('.alert-success').html('Heroes Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
						showAllHeroes();
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});



		//function
		function showAllHeroes(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>heroes/heroes_data',
				async: false,
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html +='<tr>'+
									'<td>'+data[i].id+'</td>'+
									'<td>'+data[i].hero_name+'</td>'+
									'<td>'+data[i].real_name+'</td>'+
									'<td>'+data[i].umur+'</td>'+
									'<td>'+data[i].power+'</td>'+
									'<td>'+
										'<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
										'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
									'</td>'+
							    '</tr>';
					}
					$('#showdata').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}
	});
</script>
