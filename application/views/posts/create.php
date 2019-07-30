<h2><?= $title ?></h2>
<?php echo validation_errors();    ?>

<?php  echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label >Title</label>
    <input type="text" class="form-control" name="title"  placeholder="Title">
  </div>
  <div class="form-group">
  	<select name="category_id" class="form-control"><?php foreach ($categories as $category):  ?>
  		<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
  			</option>
<?php endforeach; ?>
  	</select>

    <div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="userfile" size="20">
  </div>

  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" rows="3" placeholder="Add Body"></textarea>
  </div>

<button type="submit" class="btn btn-success">Submit</button>
</form>