<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit;
        }
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $dbname = "notes";
        
        $conn = new mysqli($servername, $username_db, $password_db, $dbname);
        
        if ($conn->connect_error) {
            // die("Connection failed: " . $conn->connect_error);
            die("Connection failed: ");
        }
        
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. <a href='login.php'>Login</a>";
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            echo "Error" . "<br>"; 
        }
        
        $conn->close();
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

        /* Reset default margin and padding */
        body, h2, form {
            margin: 0;
            padding: 0;
        }

        /* Set background color and font family */
        body {
            background-color: #f2f2f2;
            font-family: 'Poppins', sans-serif;
        }

        /* Center the form on the page */
        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Style the form heading */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Style form labels and input fields */
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style the submit button */
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Style the login link */
        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="Sign Up">
        <a class="login-link" href="login.php">Login</a>
    </form>
</body>
</html>
