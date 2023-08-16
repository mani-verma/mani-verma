<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'formdata';

$conn = mysqli_connect($host, $user, $password, $dbname) or die();

$sql =  "SELECT `userid`, `name`, `email`, `age`, `gender` FROM `userdata`";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
<style>
    .container {
        display: flex;
        justify-content: space-between;
    }
</style>

<body>
    <p class="h2 text-center mt-2">Form</p>
    <div class="d-flex justify-content-around align-content-center mt-5">
        <form>
            <div class="form-group row">
                <label class=" col-form-label">Name : </label>
                <input class="form-control" type="text" id="name" name="name" autocomplete="off" placeholder="Enter your name" />
            </div>
            <div class="form-group row">
                <label class=" col-form-label">E-mail : </label>
                <input class="form-control" type="email" id="email" name="email" autocomplete="off" placeholder="Enter e-mail " />
            </div>
            <div class="form-group row">
                <label class=" col-form-label">Age : </label>
                <input class="form-control" type="number" id="age" name="age" autocomplete="off" placeholder="Enter your age" />
            </div>
            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="gender" value="M" id="male" checked />
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="F" id="female" />
                <label class="form-check-label" for="female">Female</label>
            </div><br><br>
            <div class="text-center">
                <input class="btn btn-primary btn-lg" type="submit" name="Submit" id="submitBtn" />
            </div>
        </form>
        <div class="w-50 pl-0">
            <table class="table table-sm table-striped ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="user">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) { //printing rows after fetching data from qury result
                        echo "<tr>";
                        echo "<td>" . $row['userid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td><div class='btn-group'>
                                        <button class='btn btn-danger delBtn btn-sm' onclick='delUser(" . $row["userid"] . ")'>Delete</button>
                                        <button class='btn btn-info delBtn btn-sm' onclick='update(" . $row["userid"] . ")'>Update</button>
                                </div>
                    </td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>

    // Function to Delete User
        function delUser(id) {
            console.log(id);

            const form = {
                delBtn: document.getElementById('id'),
                name: document.getElementById('name'),
                email: document.getElementById('email')
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("user").innerHTML = xhttp.responseText;
                }
            };

            const requestData = `delBtn=${form.delBtn}&userid=${id}&name=${form.name.value}&email=${form.email.value}`;

            xhttp.open('POST', 'form.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(requestData);
            console.log(xhttp.responseText);


        }
// Function for Update User
        function update(id) {
            console.log(id);

            if (document.getElementById('male').checked) {
                gen = "M";
            } else if (document.getElementById('female').checked) {
                gen = "F";
            }

            const form = {
                updateBtn: document.getElementById('id'),
                name: document.getElementById('name'),
                email: document.getElementById('email'),
                age: document.getElementById('age'),
                gender: gen
            };

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("user").innerHTML = xhttp.responseText;
                }
            };

            const requestData = `updateBtn=${form.updateBtn}&userid=${id}&name=${form.name.value}&email=${form.email.value}&age=${form.age.value}&gender=${form.gender}`;
            console.log(requestData);
            xhttp.open('POST', 'form.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(requestData);
            console.log(xhttp.responseText);


        }

//Submitting Form 

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (document.getElementById('male').checked) {
                gen = "M";
            } else if (document.getElementById('female').checked) {
                gen = "F";
            }
            const form = {
                name: document.getElementById('name'),
                email: document.getElementById('email'),
                age: document.getElementById('age'),
                gender: gen
            }


            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("user").innerHTML = xhttp.responseText;
                    form.name.value = "";
                    form.email.value = "";
                    form.age.value = "";
                }
            };

            const requestData = `submit=${submitBtn}&name=${form.name.value}&email=${form.email.value}&age=${form.age.value}&gender=${form.gender}`;

            console.log(requestData);
            xhttp.open('POST', 'form.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(requestData);
            console.log(xhttp.responseText);
        });
       
    </script>

</body>

</html>