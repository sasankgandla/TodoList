<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$conn = mysqli_connect($servername, $username, $password, $database);
$insert;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    if (isset($_POST["snoDelete"])) {
        // delete
        $id = $_POST["snoDelete"];
        $s = "DELETE FROM `notes` WHERE `notes`.`sno` = $id;";
        $res = mysqli_query($conn, $s);
        if ($res) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Note Deleted Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
        }
    } else if (isset($_POST["snoEdit"])) {
        // update
        $id = $_POST["snoEdit"];
        $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $id;";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Note Updated Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
        }
    } else if (trim($title) == "" || trim($description) == "") {
        $insert = false;
    } else {
        $sql = "INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$description', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $insert = true;
    }
}


if (isset($insert) && $insert == true) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Note Inserted Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
} else if (isset($insert) && $insert != true) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Please enter title and description</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Crud App</title>
</head>

<body>
    <!-- Edit Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">
                        <form class="needs-validation" novalidate method="POST" action="index.php">
                            <input type="hidden" name="snoEdit" id="snoEdit"></input>
                            <div class="mb-3">
                                <label for="mtitle">Note title</label>
                                <input type="text" class="form-control" id="mtitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="mdescription">Note description</label>
                                <textarea class="form-control" id="mdescription" rows="3" name="description" required></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Edit Note</button>
                        </form>

                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
                                            if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
                                            form.classList.add('was-validated');
                                        }, false);
                                    });
                                }, false);
                            })();
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- delete modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate method="POST" action="index.php">
                        <input type="hidden" name="snoDelete" id="snoDelete"></input>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="mtitledelete" name="title" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="mdescriptiondelete" rows="3" name="description" required style="display:none;"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Delete Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">PHP CRUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- form -->
    <div class="container my-4">
        <h2>Add a Note</h2>
        <form class="needs-validation" novalidate method="POST" action="index.php">
            <div class="mb-3">
                <label for="title">Note title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter note title
                </div>
            </div>
            <div class="mb-3">
                <label for="description">Note description</label>
                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter note description
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Add Note</button>
        </form>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </div>

    <div class="container my-4">
        <?php
        $sql2 = "SELECT * FROM `notes`";
        $result2 = mysqli_query($conn, $sql2);
        $count = 0;
        echo '<table id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
        while ($row = mysqli_fetch_assoc($result2)) {
            $count += 1;
            echo '<tr>
                            <th>' . $count . '</th>
                            <td class="title">' . $row["title"] . '</td>
                            <td  class="description">' . $row["description"] . '</td>
                            <td>' . $row["tstamp"] . '</td>
                            <td>
                                <button type="button" class="edit btn btn-primary" data-toggle="modal" data-target="#editmodal" id="sno" value="' . $row["sno"] . '">Edit</button> 
                                <button type="button" class=" delete btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Delete</button>
                            </td>
                        </tr>';
        }
        echo '</tbody></table>';
        ?>
    </div>


    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- datatables css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- datatables js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- resubmission form stopping script -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script>
        $(document).ready(() => {
            // after clicking edit button
            $(".edit").click(function() {
                var $t = $(this).closest("tr") // Finds the closest row <tr> 
                    .find(".title") // Gets a descendent with class="title"
                    .text(); // Retrieves the text within <td>
                var $d = $(this).closest("tr") // Finds the closest row <tr> 
                    .find(".description") // Gets a descendent with class="description"
                    .text(); // Retrieves the text within <td>
                var $i = $(this).closest("tr") // Finds the closest row <tr> 
                    .find("#sno") // Gets a descendent with id="sno"
                    .val(); // Retrieves the text within <td>
                $("#mtitle").val($t);
                $("#mdescription").val($d);
                $("#snoEdit").val($i);
            });
            $(".delete").click(function() {
                var $t = $(this).closest("tr") // Finds the closest row <tr> 
                    .find(".title") // Gets a descendent with class="title"
                    .text(); // Retrieves the text within <td>
                var $d = $(this).closest("tr") // Finds the closest row <tr> 
                    .find(".description") // Gets a descendent with class="description"
                    .text(); // Retrieves the text within <td>
                var $i = $(this).closest("tr") // Finds the closest row <tr> 
                    .find("#sno") // Gets a descendent with id="sno"
                    .val(); // Retrieves the text within <td>
                $("#mtitledelete").val($t);
                $("#mdescriptiondelete").val($d);
                $("#snoDelete").val($i);
            });
        });
    </script>
</body>

</html>