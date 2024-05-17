<?php

require './database/dbConnect.php';

$userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : 0;
//echo $userId;

$getTaskData = $connect->prepare("SELECT `id`, `task`, `process_time`, `active` FROM `task` WHERE `user`='$userId' ORDER BY `process_time` DESC;");
$getTaskData->execute(); //query execute.
$allTaskData = $getTaskData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.


$count = 0;

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    //echo $task;


    // write quriey for get data from database.
    $getData = $connect->prepare("SELECT count(1) as value 
  FROM `task` WHERE `task`='$task' AND `user`='$userId';");
    $getData->execute(); //query execute.
    $allData = $getData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.
    // print_r($allData);

    // get single data fom array.
    foreach ($allData as $data) {
        $count = $data->value; // get password which come from database.
        //echo "data: " . $count;
    }

    if ((!empty($task)) && ($count == 0)) {
        try {
            $statement = $connect->prepare("INSERT INTO `task` (`task`,`user`) 
        VALUES ('$task','$userId');");
            $statement->execute()  or die("Data not insert. Please try again.");
            //echo '<div class="success-msg"><i class="fa fa-check"></i>Data Save!</div>';
            header("Location: /deshbord");
        } catch (Exception $e) {
            // if create problrm when connection, then show error massage
            echo '<div class="error-msg"><i class="fa fa-times-circle"></i>Data not insert. Please try again.</div>';
        }
    } else {
        echo '<div class="warning-msg"><i class="fa fa-warning"></i>sorry your given information is incorrect. please try new.</div>';
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #f5af19, #f12711);
        }

        ::selection {
            color: #fff;
            background: #f12711;
        }

        .wrapper {
            max-width: 405px;
            background: #fff;
            margin: 10px auto;
            border-radius: 7px;
            padding: 28px 0 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .task-input {
            position: relative;
            height: 52px;
            padding: 0 25px;
        }

        .task-input ion-icon {
            position: absolute;
            top: 50%;
            color: #999;
            font-size: 25px;
            transform: translate(17px, -50%);
        }

        .task-input input {
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 18px;
            border-radius: 5px;
            padding: 0 20px 0 53px;
            border: 1px solid #999;
        }

        .task-input input:focus,
        .task-input input.active {
            padding-left: 52px;
            border: 2px solid #f12711;
        }

        .task-input input::placeholder {
            color: #bfbfbf;
        }

        .controls,
        li {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .controls {
            padding: 18px 25px;
            border-bottom: 1px solid #ccc;
        }

        .filters span {
            margin: 0 8px;
            font-size: 17px;
            color: #444444;
            cursor: pointer;
        }

        .filters span:first-child {
            margin-left: 0;
        }

        .filters span.active {
            color: #f12711;
        }

        .clear-btn {
            border: none;
            opacity: 0.9;
            outline: none;
            color: #fff;
            cursor: pointer;
            font-size: 13px;
            padding: 7px 13px;
            border-radius: 4px;
            letter-spacing: 0.3px;
            pointer-events: auto;
            transition: transform 0.25s ease;
            transform: scale(0.93);
            background: linear-gradient(135deg, #f5af19 0%, #f12711 100%);
        }

        .task-box {
            margin-top: 20px;
            margin-right: 5px;
            padding: 0 20px 10px 25px;
        }

        .task-box.overflow {
            overflow-y: auto;
            max-height: 300px;
        }

        .task-box::-webkit-scrollbar {
            width: 5px;
        }

        .task-box::-webkit-scrollbar-track {
            background: #f12711;
            border-radius: 25px;
        }

        .task-box::-webkit-scrollbar-thumb {
            background: #e6e6e6;
            border-radius: 25px;
        }

        .task-box .task {
            list-style: none;
            font-size: 17px;
            margin-bottom: 18px;
            padding-bottom: 16px;
            align-items: flex-start;
            border-bottom: 1px solid #ccc;
        }

        .task-box .task:last-child {
            margin-bottom: 0;
            border-bottom: 0;
            padding-bottom: 0;
        }

        .task-box .task label {
            display: flex;
            align-items: flex-start;
        }

        .task label input {
            margin-top: 7px;
            accent-color: #f12711;
        }

        .task label p {
            user-select: none;
            margin-left: 12px;
            word-wrap: break-word;
        }

        .task label p.checked {
            text-decoration: line-through;
        }

        .task-box .settings {
            position: relative;
        }

        .settings :where(i, li) {
            cursor: pointer;
        }

        .settings .task-menu {
            position: absolute;
            right: -5px;
            bottom: -65px;
            padding: 5px 0;
            background: #fff;
            border-radius: 4px;
            transform: scale(0);
            transform-origin: top right;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease;
            z-index: 10;
        }

        .task-box .task:last-child .task-menu {
            bottom: 0;
            transform-origin: bottom right;
        }

        .task-box .task:first-child .task-menu {
            bottom: -65px;
            transform-origin: top right;
        }

        .task-menu.show {
            transform: scale(1);
        }

        .task-menu li {
            height: 25px;
            font-size: 16px;
            margin-bottom: 2px;
            padding: 17px 15px;
            cursor: pointer;
            justify-content: flex-start;
        }

        .task-menu li:last-child {
            margin-bottom: 0;
        }

        .settings li:hover {
            background: #f5f5f5;
        }

        .settings li i {
            padding-right: 8px;
        }

        @media (max-width: 400px) {
            body {
                padding: 0 10px;
            }

            .wrapper {
                padding: 20px 0;
            }

            .filters span {
                margin: 0 5px;
            }

            .task-input {
                padding: 0 20px;
            }

            .controls {
                padding: 18px 20px;
            }

            .task-box {
                margin-top: 20px;
                margin-right: 5px;
                padding: 0 15px 10px 20px;
            }

            .task label input {
                margin-top: 4px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="task-input">
            <ion-icon name="create-outline" class="fa fa-plus-square"></ion-icon>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="task" placeholder="Add a New Task + Enter">
                <input type="submit" name="submit" hidden />
            </form>

        </div>
        <div class="controls">
            <div class="filters">
                <span class="active" id="all">All</span>
            </div>
            <button class="clear-btn" onclick="javascript:location.href='logout';">Logout</button>
        </div>
        <ul class="task-box">

            <?php foreach ($allTaskData as $taskData) : ?>
                <p style="font-size: 8px;"><?php echo $taskData->process_time; ?></p>
                <li class="task">
                    <label>
                        <form action="" method="post">
                            <input onclick="javascript:location.href='update?id=<?php echo $taskData->id . '&active=N'; ?>';" type="checkbox" id="id" name="checkValue">
                            <input type="hidden" name="" value="<?php echo $taskData->id; ?>">
                        </form>
                        <p style="margin-top: 4px; text-decoration: <?php echo ($taskData->active == 'N') ? 'line-through' : 'none' ?>;"><?php echo $taskData->task; ?></p>
                    </label>
                    <div class="settings">
                        <i onclick="showMenu(this)" class="fa fa-bars"></i>
                        <ul class="task-menu">
                            <li onclick="javascript:location.href='delete?id=<?php echo $taskData->id; ?>';"><i class="fa fa-trash-o"></i>Delete</li>
                        </ul>

                    </div>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</body>

<script>
    function showMenu(selectedTask) {
        let menuDiv = selectedTask.parentElement.lastElementChild;
        menuDiv.classList.add("show");
        document.addEventListener("click", (e) => {
            if (e.target.tagName != "I" || e.target != selectedTask) {
                menuDiv.classList.remove("show");
            }
        });
    }
</script>

</html>