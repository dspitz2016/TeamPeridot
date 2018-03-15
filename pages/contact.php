<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();
?>

<h1>Contact Page</h1>
Simple contact page, must be tested for sending email

<!--
<div class="container">
	<div class="row card-panel cust-color-rust">
		<img class="circle responsive-img col s6" src="http://via.placeholder.com/300x250" />
		<div class="col s6">
			<h1>Important Person 1</h1>
			<p>This is some stuff about important person 1</p>
		</div>
	</div>
	
	<div class="row card-panel cust-color-seafoam">
		<img class="circle responsive-img col s6" src="http://via.placeholder.com/500x500" />
		<div class="col s6">
			<h1>Important Person 2</h1>
			<p>This is some stuff about important person 2 and some more junk</p>
		</div>
	</div>
	
</div>
-->
	<div class="container">
    <form action="#">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      
      <div class="row">
        <div class="input-field col s3">
          <input id="tel_number" type="tel" class="validate">
          <label for="tel_number">Telephone</label>
        </div>

        <div class="input-field col s9">
          <input id="email" type="email" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
      </div>
      
		<div class="row">
			<div class="input-field col s12">
				<textarea id="desc" class="materialize-textarea"></textarea>
				<label for="desc">Description</label>
			</div>
		</div>
      
      <div class="row">
		<button class="btn waves-effect waves-light" type="submit" name="action">Submit
			<i class="material-icons right">send</i>
		</button>
	  </div>
      
    </form>
    </div>

<?php $main->getScripts(); ?>
<?php $main->getFooter(); ?>

