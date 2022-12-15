<?php

include '../Controller/sponsors.php';

$error = "";

// create client
$sponsors = null;

// create an instance of the controller
$sponsors = new sponsors() ;
if (
    isset($_POST["idsponsors"]) &&
    isset($_POST["firstName"]) &&
    isset($_POST["lastName"]) &&
    isset($_POST["address"]) &&
    isset($_POST["dob"])
) 
    if (
        !empty($_POST["idsponsors"]) &&
        !empty($_POST['firstName']) &&
        !empty($_POST["lastName"]) &&
        !empty($_POST["address"]) &&
        !empty($_POST["dob"])
    ) {
        $sponsors = new sponsors(
            $_POST['idsponsors'],
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['address'],
            new DateTime($_POST['dob'])
        );
        $sponsors->updateClient($sponsors, $_POST["idClient"]);
        header('Location:Listsponsors.php');
    } else
        $error = "Missing information";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="ListClients.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idClient'])) {
        $client = $clientC->showsponosrs($_POST['idsponsors']);

    ?>

        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="idsponsors">Id sponsors:
                        </label>
                    </td>
                    <td><input type="text" name="idsponsors" id="idsponsors" value="<?php echo $sponsors['idsponsors']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="firstName">First Name:
                        </label>
                    </td>
                    <td><input type="text" name="firstName" id="firstName" value="<?php echo $sponsors['firstName']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="lastName">Last Name:
                        </label>
                    </td>
                    <td><input type="text" name="lastName" id="lastName" value="<?php echo $sponsors['lastName']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Address:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="address" value="<?php echo $sponsors['address']; ?>" id="address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dob">Date of Birth:
                        </label>
                    </td>
                    <td>
                        <input type="date" name="dob" id="dob" value="<?php echo $sponsors['dob']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Update">
                    </td>
                    <td>
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>
</body>

</html>
