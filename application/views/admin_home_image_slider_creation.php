<?php if($title=="add") $post_title="Add new";
				else if($title=="edit") $post_title="Edit";
			 ?>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo GENERAL_CSS_DIR;?>/jquery.tagsinput.css" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
		<h1>
			<?php echo $post_title;?> Image Slider
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Post</a></li>
			<li class="active"><a href="#">Add Image Slider</a></li>
		</ol>
  </section>
	
	<!-- Main content -->
  <section class="boxku">
		<div class="row">
			<?php include('message_after_transaction.php');?>			
			<div class="col-xs-12">
				<div class="box box-info">
  					<div class="box-header">
						<h3 class="box-title"><?php echo $post_title;?> Image Slider
						</h3>
        			</div><!-- /.box-header -->
        			<div class="box-body no-padding">
						<!-- form start -->
						<form role="form" id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url().($title=="add" ? 'cms/add_image_slider' : 'cms/update_image_slider?id='.$this->input->get('id'));?>">
							<input type="hidden" name="type" value="home_image_slider">
							<div class="box-body">
								<div class="row">
									<div class="col-sm-8">
										<div class="form-group">
											<label for="title">Post Title</label>
											<input type="text" class="form-control input-sm" id="title" name="title" placeholder="" value="<?php if($title=='edit') echo $post_data->title;?>" required>
										</div><!-- ./form-group -->
										<div class="form-group">
											<label for="content">Post Content</label>
											<textarea class="form-control" id="content-editor" name="content" rows="10" cols="80"> <?php if($title=='edit') echo $post_data->content;?></textarea>
										</div><!-- ./form-group -->
									</div><!-- ./col -->
									<div class="col-sm-4">
										<div class="form-group" id="primary_image">
							                <label for="exampleInputFile">Primary Image</label>
							                <input type="file" id="image_file" name="image_file" <?php if($title=="add") echo "required";?>/>
							                <p class="help-block">Max size is 50MB, and best dimension is 1920px x 420px.</p>
												  		<br>
							                <?php if($title=="edit" and $post_image <> false and $post_image->file_name <> ""){
							                ?>
							                <img src="<?php echo $this->config->item('upload_path').$post_image->file_name;?>" width="150" height="200" />
							                <?php
							                } else{
							                ?>
							                <img src="http://placehold.it/150x100" alt="..." class='margin' />
							                <?php
							                	}
							                ?>
							            </div>
									</div><!-- ./col -->
								</div><!-- ./row -->
						
							</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary" name="action" value="publish">Publish</button>
							</div>
						</form>
        			</div><!-- /.box-body -->
	      		</div><!-- /.box -->
			</div><!-- /.col -->
		</div>
	</section>
		  
</div><!-- /.content-wrapper -->

<?php include('footer.php');?>
<!-- CK Editor -->
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Tags Master -->
<script type="text/javascript" src="<?php echo GENERAL_JS_DIR;?>/jquery.tagsinput.js"></script>

<script>
	$(document).ready(function(){
		$('#tags_1').tagsInput({width:'auto'});
		//$(".editor").jqte();
	});

	$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('content-editor');
    
  });
</script>
</body>
</html>
