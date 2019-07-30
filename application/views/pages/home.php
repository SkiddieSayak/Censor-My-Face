<h1><center>Censor My Face</center></h1>

<?php echo validation_errors();    ?>
<?php
                if (isset($errors)){
                    echo $errors;
                }
            ?>

<?php  echo form_open_multipart('Face/img'); ?>
    <div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="userfile" id="userfile" size="33">
  </div>

<button type="submit" class="btn btn-success">Submit</button>
</form>
<br>

