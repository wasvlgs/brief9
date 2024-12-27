<?php
require '../database.php';
require '../classes/reservation.php';

session_start();


if (!isset($_SESSION['id'])) {
    session_destroy();
    echo '<script>location.replace("../login/login.php")</script>';
}

$getId = $_SESSION['id'];


$database = new Database();
$cnx = $database->getConnection();
$reservation = new Reservation($cnx);


if (isset($_POST['remove'])) {
    $reservationId = strip_tags($_POST['remove']);
    if ($reservation->removeReservation($reservationId)) {
        echo '<script>
            document.getElementById("success").style.display = "flex";
            setTimeout(() => {
                document.getElementById("success").style.display = "none";
                location.replace("reservation.php");
            }, 1000);
        </script>';
    } else {
        echo '<script>
            document.getElementById("error").style.display = "flex";
            setTimeout(() => {
                document.getElementById("error").style.display = "none";
            }, 1000);
        </script>';
    }
}


$searchResults = [];
if (isset($_POST['searchSubmit'])) {
    $search = htmlspecialchars($_POST['Search']);
    $searchResults = $reservation->getReservationsByClient($getId, $search);
} else {
    $searchResults = $reservation->getReservationsByClient($getId);
}

if(isset($_POST['logout'])){
    session_destroy();
    echo '<script>location.replace("../index.php")</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VG - Home</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-[#EDEDED]">
    <header class="fixed top-0 left-0 h-[75px] w-full bg-white flex items-center justify-between px-20 max-sm:px-10 z-30">
        <a href="../index.php"><img src="../img/Group 1.svg" alt="Logo"></a>
        <div class="flex items-center gap-5"><h3>Hello <?php
            $getUser = $cnx->prepare("SELECT prenom FROM client WHERE ID_client = :id");
            $getUser->bindParam(":id", $_SESSION['id']);
            if ($getUser->execute()) {
                $user = $getUser->fetch(PDO::FETCH_ASSOC);
                echo $user['prenom'];
            }
        ?>!</h3><i id="bar" class="fa-solid fa-bars text-2xl"></i></div>
    </header>


    <div id="success" class="w-full z-50 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
        Reservation removed successfully!
    </div>
    <div id="error" class="w-full z-50 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">
        Error, try again!
    </div>

    <aside class="fixed left-0 top-[75px] h-[calc(100vh-75px)] z-30 w-[300px] bg-white overflow-hidden max-lg:w-0 transition-all duration-300">
        <ul class="mt-10 flex flex-col">
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="reservation.php"><i class="fa-solid fa-circle-check mr-5"></i>Reservations</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg cursor-pointer">
                <form method="post"><button name="logout"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</button></form>
            </li>
        </ul>
    </aside>

    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">
        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">All Reservations</h1>
            <form method="post" class="w-[250px] h-[40px] bg-white flex items-center rounded-[5px] overflow-hidden">
                <input name="Search" type="text" placeholder="Search..." class="w-[80%] h-full border-none outline-none pl-4">
                <button name="searchSubmit" class="w-[20%] h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">My Reservations</h2>
            <div class="bg-white shadow-md rounded-lg overflow-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">Title</th>
                            <th class="py-4 px-6 text-left font-medium">Reservation Date</th>
                            <th class="py-4 px-6 text-left font-medium">Price</th>
                            <th class="py-4 px-6 text-left font-medium">Type</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        foreach ($searchResults as $item) {
                            $statusClass = ($item['statut'] == "En attente") ? "amber-400" : (($item['statut'] == "confirmée") ? "green-600" : "red-600");
                            echo '<tr class="border-t">
                                <td class="py-4 px-6">' . $item['titre'] . '</td>
                                <td class="py-4 px-6">' . $item['date_reservation'] . '</td>
                                <td class="py-4 px-6">$' . $item['prix'] . '</td>
                                <td class="py-4 px-6">' . $item['type'] . '</td>
                                <td class="py-4 px-6 text-' . $statusClass . ' font-medium">' . $item['statut'] . '</td>
                                <td class="py-4 px-6 text-center">
                                    <form method="post"><button name="remove" value="' . $item['id_reservation'] . '" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600">Cancel</button></form>
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../js/scrip.js"></script>
</body>
</html>
