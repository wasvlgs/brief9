<?php
require '../database.php';
require '../classes/activitie.php';
require '../classes/reservation.php';
require '../classes/user.php'; 
session_start();


if (!isset($_SESSION['id'])) {
    session_destroy();
    echo '<script>location.replace("../login/login.php")</script>';
    exit;
}

$getId = $_SESSION['id'];

if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>location.replace("../index.php")</script>';
    exit;
}

$db = new Database();
$cnx = $db->getConnection();


$activityObj = new Activity($cnx);
$reservationObj = new Reservation($cnx);
$userObj = new User($cnx);


$user = $userObj->getUserById($getId);


$searchTerm = isset($_POST['searchSubmit']) ? $_POST['Search'] : '';


if (isset($_POST['submit'])) {
    $reservationDate = $_POST['dr'];
    $activityId = $_POST['submit'];
    $reservationCreated = $reservationObj->createReservation($getId, $activityId, $reservationDate);

    if ($reservationCreated) {
        echo '<script>document.getElementById("success").style.display = "flex"; setTimeout(() => { document.getElementById("success").style.display = "none"; location.replace("activities.php"); }, 1000);</script>';
    } else {
        echo '<script>document.getElementById("error").style.display = "flex"; setTimeout(() => { document.getElementById("error").style.display = "none"; }, 1000);</script>';
    }
}


$activities = $activityObj->getAllActivities($searchTerm);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VG - Home</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-[#EDEDED]">


    <header class="fixed top-0 left-0 h-[75px] w-full bg-white flex items-center justify-between px-20 max-sm:px-10 z-30">
        <a href="../index.php"><img src="../img/Group 1.svg" alt="Logo"></a>
        <div class="flex items-center gap-5">

            <h3>Hello <?php echo htmlspecialchars($user['prenom']); ?>!</h3>
            <i id="bar" class="fa-solid fa-bars text-2xl"></i>
        </div>
    </header>


    <div id="success" class="w-full z-50 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">Reservation succesfuly!</div>
    <div id="error" class="w-full z-50 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">Error try again!</div>


    <aside class="fixed left-0 top-[75px] h-[calc(100vh-75px)] z-30 w-[300px] bg-white overflow-hidden max-lg:w-0 transition-all duration-300">
        <ul class="mt-10 flex flex-col">
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="reservation.php"><i class="fa-solid fa-circle-check mr-5"></i>Reservations</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg cursor-pointer">
                <form method="post"><button name="logout"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</button></form>
            </li>
        </ul>
    </aside>


    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">
        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">All activities</h1>
            <form method="post" class="w-[250px] h-[40px] bg-white flex items-center rounded-[5px] overflow-hidden">
                <input name="Search" type="text" placeholder="Search..." class="w-[80%] h-full border-none outline-none pl-4">
                <button name="searchSubmit" class="w-[20%] h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="afficheContent w-[98%] h-full bg-white p-10 max-sm:p-4 flex flex-wrap gap-10 justify-center">
            <?php
            foreach ($activities as $item) {
                $reservationCount = $activityObj->getReservationCount($item['id_activite']);
                echo '<div class="card w-full max-w-[300px] min-h-[500px] bg-[#EDEDED] hover:translate-y-[-5px] hover:scale-[101%] relative">
                        <div class="h-auto max-h-[50%] w-full">
                            <img class="min-w-full max-h-full" src="../img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                        </div>
                        <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                            <h2 class="text-lg">'.$item['titre'].'</h2>
                            <p class="text-sm">'.$item['description'].'</p>
                            <h5 class="text-sm">$'.$item['prix'].'</h5>
                            <div class="w-full flex flex-col items-center gap-2">
                                <button class="reserve h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white">Reserve</button>
                                <h6>('.$reservationCount.') orders</h6>
                            </div>
                        </div>
                        <form method="post" class="reserveSection hidden absolute top-0 left-0 h-full w-full bg-[#ff9c9cea] flex-col justify-center items-center gap-3">
                            <label class="w-[80%]">Date de reservation:
                                <input name="dr" type="date" class="w-full h-[40px] rounded-[5px] pl-5 outline-none">
                            </label>
                            <div class="flex flex-col gap-5 w-full items-center">
                                <button name="submit" value="'.$item['id_activite'].'" class="w-[80%] h-[40px] border-[3px] border-white rounded-[5px] hover:bg-white hover:text-[#FF9C9C] transition-all duration-300">Reserve</button>
                                <button type="button" class="closeReserve w-[80%] h-[40px] text-white bg-[red] rounded-[5px] hover:bg-[#a02222] transition-all duration-300">cancel</button>
                            </div>
                        </form>
                    </div>';
            }
            ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
