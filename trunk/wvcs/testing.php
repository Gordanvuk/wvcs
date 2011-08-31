<?php
include 'style/header.php';
?>
<div class="row login">
<div class="span4 columns">latest news</div>
<div class="span12 columns">
	<form action="goto.php" method="post">
        <fieldset>
          <legend>Sign in <?php echo $system_name_short;?></legend>
          <div class="clearfix">
            <label for="xlInput"><?php echo $system_name_short;?> ID</label>
            <div class="input">
              <input class="xlarge" id="xlInput" name="xlInput" size="30" type="text">
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix">
            <label for="xlInput">Password</label>
            <div class="input">
              <input class="xlarge" id="xlInput" name="xlInput" size="30" type="text">
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix">
            <label id="optionsRadio"></label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="checkbox" name="optionsCheckboxes" value="option1">
                    <span>Remember me</span>
                  </label>
                </li>
              </ul>
            </div>
          </div><!-- /clearfix -->
          <div class="actions">
            <button type="submit" class="btn primary">Save Changes</button>&nbsp;<button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
      </form>
</div>
</div>
<?php 
include 'style/footer.php';
?>