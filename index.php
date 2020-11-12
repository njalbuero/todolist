<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
}

include "includes/dbconnection.php";

$query = $db->query("SELECT * FROM accounts where isLoggedIn = 1");
while ($result = $query->fetch_assoc()) {
    $userid = $result['user_id'];
    $fullname = $result['fullname'];
    $avatar = $result['avatar'];
}
$query2 = $db->query("SELECT * FROM tasks");
$count = 0;
while ($result = $query2->fetch_assoc()) {
    $count++;
}
?>

<html>

<head>
    <title>To-do List</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/390049b6e3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 border-right" id="left-pane">
                <h3><?= $fullname ?></h3>
                <div class="image">
                    <img src="img_uploads/<?= $avatar ?>" height="200px" width="200px">
                </div>

                <div class="changePhoto">
                    <div>
                        <button class="btn btn-normal purple" type="button" data-toggle="collapse" data-target="#uploadImg" aria-expanded="false" aria-controls="collapseExample">
                            Change Photo
                        </button>
                    </div>
                    <div class="collapse" id="uploadImg">
                        <div class="card card-body">
                            <form class="no-margin-bottom" action="img_submit.php?userid=<?= $userid ?>" enctype="multipart/form-data" method="POST">
                                <div class="custom-file mb-3 ">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <input type="submit" class="btn btn-normal purple inside-card-button pull-right" />
                            </form>
                        </div>
                    </div>
                </div>

                <div class="logout">
                    <button onclick="logout()" class="btn btn-normal red" id="btn_logout">Logout</button>
                </div>

            </div>
            <div class="col-md-8">
                <div class="container" id="tasks">
                    <h1>Tasks</h1>
                    <form class="no-margin-bottom" action="addTask_submit.php" method="POST">
                        <div class="input-group mb-3 no-margin-bottom">
                            <div class="input-group-prepend">
                                <button class="btn" type="submit"><i id="add" class="fas fa-plus"></i></i></button>
                            </div>
                            <input type="text" name="task" placeholder="Add task here" class="form-control" id="addTaskInput" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </form>
                    <ul class="list-group">
                        <?php $query2 = $db->query("SELECT * FROM tasks");
                        for ($i = 0; $i < $count; $i++) {
                            $result2 = $query2->fetch_assoc()
                            ?>
                            <li class="list-group-item">
                                <?= $result2['content'] ?>
                                <button id="checkOnLoad" onclick="checkOnLoad(this)" style="font-size:0px; visibility: hidden;"></button>
                                <button class="btn pull-left check unchecked" onclick="check(this,<?= $result2['isDone'] ?>,<?= $result2['task_id'] ?>)"><i class="fas fa-check"></i></button>
                                <script>
                                    function checkOnLoad(li) {
                                        var taskArray = Array.from(document.querySelectorAll("li"));
                                        var checkArray = Array.from(document.querySelectorAll(".check"));
                                        if (<?= $result2['isDone'] ?>) {
                                            taskArray[<?= $i ?>].style.textDecoration = "line-through";
                                            checkArray[<?= $i ?>].classList.remove("unchecked");
                                        }
                                    }
                                    $("#checkOnLoad").trigger("click");
                                </script>
                                <div class="btn-group pull-right">
                                    <button class="btn" onclick="editTask(<?= $result2['task_id'] ?>, '<?= $result2['content'] ?>')"><i class=" far fa-edit"></i></button>
                                    <button class="btn btn-delete" onclick="deleteTask(<?= $result2['task_id'] ?>)"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const liTasks = Array.from(document.querySelectorAll("li"));
        for (let i = 0; i < liTasks.length; i++) {
            liTasks[i].id = "btn" + i;
        }

        function logout() {
            Swal.fire({
                title: 'Log Out?',
                text: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    location.href = "logout.php";
                }
            })
        }

        function check(btn, isDone, task_id) {
            let checkThis = true;
            if (isDone) {
                checkThis = false;
            }
            location.href = "markTask.php?task_id=" + task_id + "&checkThis=" + checkThis;
        }

        function deleteTask(task_id) {
            location.href = "deleteTask.php?task_id=" + task_id;
        }

        async function editTask(task_id, task_content) {
            const {
                value: text
            } = await Swal.fire({
                title: 'Edit Task',
                input: 'text',
                inputValue: task_content,
                inputAttributes: {
                    'aria-label': 'Edit here'
                },
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write something!'
                    }
                },
                showCancelButton: true
            })

            if (text) {
                location.href = "editTask.php?task_id=" + task_id + "&editedTask=" + text;
            }
        }
    </script>

</body>

</html>