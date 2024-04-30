<?php
include('database.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MySQL</title>
</head>
<body>
    <h1>My Form!</h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <p>Username <br>
        <input type="text" name="username" placeholder="username">
        </p> 
        <p>Password <br>
        <input type="password" name="password" placeholder="password"> 
        </p>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username && $password)) {
        $sql = "INSERT INTO users (username, password)
        VALUES ('$username', '$hash')";

        try {
        if (mysqli_query($conn, $sql));
        echo "User added successfully!";
        } catch(mysqli_sql_exception) {
            echo "Could not register user";
        }
    }
}

mysqli_close($conn);
?>
