<?php
include('include/config.php');

// Get the category ID from the AJAX request
$cat_id = $_POST['cat_id'];

// Query the database for subcategories that belong to the selected category
$query = mysqli_query($con, "SELECT * FROM tbl_subcategory WHERE categoryid = $cat_id");

// Generate the HTML options for the subcategories
$options = "<option value=''>Select Subcategory</option>";
while ($row = mysqli_fetch_array($query)) {
    $options .= "<option value='" . $row['subid'] . "'>" . $row['subcategory'] . "</option>";
}

// Return the HTML options as the AJAX response
echo $options;
?>
