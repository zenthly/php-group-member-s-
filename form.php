
<html>
    <head>
        <title>php form</title>
</head>
<form method="POST" action="form.php">
<label>name</label><input type="text"name="username"><br>
<label>Email</label><input type="email"name="email">
<button type="submit" name="submit">submit</button>
</form>
<?php
if(isset($_POST ['submit'])){
$name=$_POST['username'];
$email=$_POST['email'];
echo"Dear"  .$name.  "thank you for contacting us,we will  
get in touch very soon via your email".$email;
}
?>