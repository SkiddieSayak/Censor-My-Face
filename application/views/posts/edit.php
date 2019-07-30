<h2><?= $title ?></h2>
<?php echo validation_errors();    ?>

<?php  echo form_open_multipart('posts/update'); ?>
<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
  <div class="form-group">
    <label >Title</label>
    <input type="text" class="form-control" name="title"  placeholder="Title" value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
  	<select name="category_id" class="form-control"><?php foreach ($categories as $category):  ?>
  		<option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?>
  			</option>
<?php endforeach; ?>
  	</select>

  	<div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="postimage" size="20">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body" value="<?php echo $post['body']; ?>"><?php echo $post['body']; ?></textarea>

  </div>
<button type="submit" class="btn btn-success">Submit</button>
</form>