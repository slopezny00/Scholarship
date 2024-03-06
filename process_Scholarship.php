<!--Chapter 4 example-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submitted!</title>
</head>
<body>
    <h3>Form Submitted!</h3>
    <?php

        // definition of the displayRequired() function
        function displayRequired($fieldName) {
            echo "<p style='color: red';>The field \"$fieldName\" is required!</p>";
        }


        // definition of the validateInput() function
        function validateInput($data, $fieldName) {
            global $errorCount;
            if(empty($data)) {
                // this is when the form field is empty
                displayRequired($fieldName);
                ++$errorCount;
                $retval = "";
            } else {
                // clean up the input when it IS NOT empty
                $retval = trim($data);
                $retval = stripslashes($retval);
            }

            return $retval;
        }

        // definition of the redisplayForm() function
        function redisplayForm($firstName, $lastName) {
            ?>
            <h2 style="text-align: center;">Scholarship Form</h2>
            <form name="scholarship" action="process_Scholarship.php" method="post" style="text-align: center;">
                <label for="fName">First Name:</label>
                <input type="text" name="fName" id="fName" value="<?php echo $firstName; ?>"/>
                <br/>
                <br/>
                <label for="lName">Last Name:</label>
                <input type="text" name="lName" id="lName" value="<?php echo $lastName; ?>"/>
                <p><input type="reset" value="Clear Form">&nbsp; &nbsp;<input type="submit" name="Submit" value="Send Form"></p>

            </form>

            <?php 
        }

        $errorCount = 0;
        $firstName = validateInput($_POST["fName"], "First Name");
        $lastName = validateInput($_POST["lName"], "Last Name");

        // Final output is either the original confirmation or an explanation of how to fix the errors
        if($errorCount > 0) {
            echo "<p>Please re-enter the missing information below.</p>";
            redisplayForm($firstName, $lastName);
        } else {
            echo "<p>Thank you for filling out the scholarship form, $firstName $lastName!</p>";
        }
    ?>
</body>
</html>