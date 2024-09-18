
<h3>Fill the Form </h3>
<form method='POST'>

<label for="email">Your Gmail Id</label><br>
<input type='email' name='email' id='email' placeholder='name@gmail.com' required /><br>

<label for="fullname">Full Name</label><br>
<input type='text' name='fullname' id='fullname' required /><br>

<label for="country">Mobile number country code</label><br>
+<input type='number' id='country' name='country_code' value='91' /><br>
<label for="mobile"> Mobile number </label><br>
<input type='number' name='mobile' id='mobile' placeholder='1234567890' required /><br>

<label for="disability">Type of Your Disability</label><br>
<input type='text' name='disability' id='disability' required /><br>

<label for="percentage">Your Disability Percentage</label><br>
<input type='number' name='percentage' id='percentage' required />%<br>

<label for="where">From Where You Know About Course</label><br>
<input type='text' name='where' id='where' required /><br>

<label for="qualification">Your Qualification</label><br>
<input type='text' name='qualification' id='qualification' required /><br>

<label for="house_flat_name_number">House/Flat name/number</label><br>
<input type="text" name="address" id="house_flat_name_number" required><br>

<label for="village_locality_colony_society_name_number">Village/Locality/Colony/Society name/number</label><br>
<input type="text" name="village" id="village_locality_colony_society_name_number"><br>

<label for="taluka_tehsil_sub_district_name">Taluka/Tehsil/Sub-district name</label><br>
<input type="text" name="taluka" id="taluka_tehsil_sub_district_name"><br>

<label for="city_town_district_name">City/Town/District name</label><br>
<input type="text" name="city" id="city_town_district_name" required><br>

<label for="state_union_territory_name">State/Union-territory name</label><br>
<input type="text" name="state" id="state_union_territory_name" required><br>

<label for="country_name">Country name</label><br>
<input type="text" name="country" id="country_name" required><br>

<label for="pin_postal_zip_code">Pin/Postal/Zip code</label><br>
<input type="text" name="pin" id="pin_postal_zip_code" required><br>


<fieldset>
    <legend>Select Your Gender</legend>
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">I am a Male</label><br/>
  
  <input type="radio" id="female" name="gender" value="female" checked>
  <label for="female">I am a Female</label><br/>
  </fieldset>

<fieldset>
    <legend>Select Your Learning Mode </legend>
  <input type="radio" id="male1" name="mode" value="offline">
  <label for="male1"> OffLine </label><br/>
  
  <input type="radio" id="female1" name="mode" value="online">
  <label for="female1"> OnLine </label><br/>
  </fieldset>
<?php
if(isset($_SESSION['reff'])){
$reff = $_SESSION['reff'];
?>
<label for="ref" hidden>Referral code</label><br>
<input type='text' name='ref' id='ref' value='<?php echo$reff; ?>' hidden/><br>

<?php
}else{
?>
<label for="ref">Referral code</label><br>
<input type='text' name='ref' id='ref' /><br>

<?php
}
?>

<hr><div class="g-recaptcha" data-sitekey="<?php echo$site_key; ?>"></div><hr>

<button name='submit' style='background-color:blue; color:white;'> click here to registor </button><br/>
<input value='click here to reset' type='reset'><br/>

</form>
<br/>

<p>
while clicking submit button you agree to accept Terms and Conditions and Privacy and Disclaimer and all other policies of this site... 
</p><br/>

<p>
If you want to read all Terms and privacy and Disclaimer so please open this site in other Tab or window of your browser, because if you leave this page on same Tab or Window then your details will be deleted 
</p>
