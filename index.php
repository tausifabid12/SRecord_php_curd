<?php

$insert = false;
//INSERT INTO `srecord` (`sno`, `sname`, `sid`, `cname`, `stestimonial`, `edate`) VALUES ('1', 'Tausif Muftasin Abid', '2820044', 'Chemistry', 'Abid is vary good boy and a decent student.', current_timestamp());
//Connect to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentRecord";

//creat connection
$conn = mysqli_connect($servername, $username, $password, $database);

//testing the connection

if(!$conn){
    echo "connection was not successfull because" . mysqli_connect_error();
}

// incerting data form html from
// echo $_POST['snoEdit'];
// echo $_GET['update'];
// exit();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['snoEdit'])){
    
    //update the record
    $sno = $_POST['snoEdit'];
    $sname = $_POST['snameEdit'];
    $sid = $_POST['sidEdit'];
    $cname = $_POST['cnameEdit'];
    $Address = $_POST['addressEdit'];

    $sql = "UPDATE `srecord` SET `sname` = '$sname', `sid` = '$sid' , `cname` = '$cname', `stestimonial` = '$Address'  WHERE `srecord`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    
}else{


    $sname = $_POST['sname'];;
    $sid = $_POST['sid'];
    $cname = $_POST['cname'];
    $Address = $_POST['address'];

    $sql = "INSERT INTO `srecord` (`sname`, `sid`, `cname`, `stestimonial`) VALUES ('$sname', '$sid', '$cname ', '$Address')";
    $result = mysqli_query($conn, $sql);
    if($result){
         $insert = true;
    }
}
}


?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- data table css link  -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    <title>Hello, world!</title>
</head>

<body>

    <!-- edit modal  -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/phpCurd_project/index.php" method="post">
                        <h3 class="text-success fw-bold pb-4">Edit Record</h3>
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="sname" class="form-label fw-bold text-success">Student Name</label>
                            <input type="text" class="form-control" id="snameEdit" name="snameEdit"
                                placeholder="Please enter Student Name">
                        </div>
                        <div class="mb-3">
                            <label for="sid" class="form-label fw-bold text-success">Student Id</label>
                            <input type="text" class="form-control" id="sidEdit" name="sidEdit"
                                placeholder="Please enter Student Id">
                        </div>
                        <div class="mb-3">
                            <label for="cname" class="form-label fw-bold text-success">Class</label>
                            <input type="text" class="form-control" id="cnameEdit" name="cnameEdit"
                                placeholder="Please enter class name">
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label fw-bold text-success">Address</label>
                            <textarea class="form-control" id="addressEdit" name="addressEdit" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <!-- START OF NAVBAR  -->

    <nav class="navbar navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand ps-4" href="#">S. record</a>
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-success bg-opacity-25">
                    <h5 class="offcanvas-title text-success" id="offcanvasNavbarLabel">S. record</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active text-success" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="#">Contact us</a>
                        </li>
                    </ul>
                    <form class="d-flex ">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


    <!-- end of navbar  -->
    <?php 
         if($insert){
             echo '<div class="alert alert-success alert-dismissible fade show" role="alert container mt-5" >
             Your data has been submited <strong>Successfully</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
         }
    
    
    ?>

    <div class="container mt-5 pt-5">
        <form action="/phpCurd_project/index.php" method="post">
            <h3 class="text-success fw-bold pb-4">Student Record</h3>
            <div class="mb-3">
                <label for="sname" class="form-label fw-bold text-success">Student Name</label>
                <input type="text" class="form-control" id="sname" name="sname" placeholder="Please enter Student Name">
            </div>
            <div class="mb-3">
                <label for="sid" class="form-label fw-bold text-success">Student Id</label>
                <input type="text" class="form-control" id="sid" name="sid" placeholder="Please enter Student Id">
            </div>
            <div class="mb-3">
                <label for="cname" class="form-label fw-bold text-success">Class</label>
                <input type="text" class="form-control" id="cname" name="cname" placeholder="Please enter class name">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-bold text-success">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success ">Submit</button>
        </form>
    </div>

    <div class="container pt-5 mt-5">


        <table class="table table-striped table-hover " id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="text-success">Serial Number</th>
                    <th scope="col" class="text-success">Student Name</th>
                    <th scope="col" class="text-success">Student Id</th>
                    <th scope="col" class="text-success">Class Name</th>
                    <th scope="col" class="text-success">Address</th>
                    <th scope="col" class="text-success">Actions</th>
                </tr>


            </thead>
            <tbody>
                <?php

                        $sno = 1;
        
                            $sql = 'SELECT * FROM `srecord`';
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){

                                echo '  <tr>
                                <th scope="row">' . $sno . '</th>
                                <td >' . $row['sname'] . '</td>
                                <td>' . $row['sid'] .'</td>
                                <td>' . $row['cname'] .'</td>
                                <td>' . $row['stestimonial'] . '</td>
                                <td>' . '<button class="btn btn-sm btn-success edit "  id= '. $row['sno'] .' data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>  <button class="btn btn-sm btn-success delete "  id= d'. $row['sno'] .'>Delete</button>'.'</td>
                            </tr';

                            $sno = $sno + 1;
                        
                        } 
                         
                    ?>

            </tbody>
        </table>



    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });


    </script>

    <script>
        let edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
                let tr = e.target.parentNode.parentNode;
                let studentName = tr.getElementsByTagName("td")[0].innerText;
                let studentId = tr.getElementsByTagName("td")[1].innerText;
                let classNmae = tr.getElementsByTagName("td")[2].innerText;
                let address = tr.getElementsByTagName("td")[3].innerText;
                
                snameEdit.value = studentName;
                sidEdit.value = studentId;
                 cnameEdit.value = classNmae;
                 addressEdit.value = address;
                 snoEdit.value = e.target.id;
                 console.log(e.target.id);


                
                

            })
        });


        let deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
               sno =e.target.id.substr(1,);

                if(confirm("press a button")){
                    console.log('yes')
                    window.location = `/phpCurd_project/index.php?delete= ${sno}`;
                }else{
                    console.log('no')
                }
                
                

            })
        });
        </script>

</html>