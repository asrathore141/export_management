

<!DOCTYPE html>
<html>
<head>
<style>
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  <form action="/action_page.php">
    <label for="fname">Name</label>
    <input type="text" id="fname" name="name"/>

    <label for="lname">	Description</label>
    <input type="text" id="lname" name="Descriptione"/>

	  <label for="lname">	Address</label>
    <input type="text" id="lname" name="Address"/>
	  <label for="lname">	City</label>
   <input type="text" id="lname" name="City"/>
   
    <label for="subject">Remark</label>
   <input type="text" id="subject" name="Remark" />

    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
