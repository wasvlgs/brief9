<?php
require '../database.php';
require '../classes/user.php'; 

session_start();

$database = new Database();
$cnx = $database->getConnection();
$userObj = new User($cnx);

if(isset($_SESSION['id'])) {
    $getUser = $userObj->getUserById($_SESSION['id']);


    if ($getUser['role'] == "admin") {
        $div = ''; 
    } else if ($getUser['role'] == "sAdmin") {
        $div = '<li class="h-[50px] flex pl-10 items-center text-lg"><a href="addAdmin.php"><i class="fa-solid fa-circle-plus mr-5"></i>Add admin</a></li>';
    } else {
        session_destroy();
        echo '<script>location.replace("../login/login.php")</script>';
    }
} else {
    session_destroy();
    echo '<script>location.replace("../login/login.php")</script>';
}

if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>location.replace("../index.php")</script>';
    exit;
}


if (isset($_POST['edit'])) {
    $getId = $_POST['edit'];
    $getTitre = $_POST['titre'];
    $getDesc = $_POST['desc'];
    $getDist = $_POST['dist'];
    $getPrix = $_POST['prix'];
    $getDateS = $_POST['dateS'];
    $getDateE = $_POST['dateE'];
    $getPdispo = $_POST['pdispo'];

 
    $sql = $cnx->prepare("UPDATE activite SET titre = :titre, description = :desc, destination = :dist, prix = :prix, date_debut = :dateS, date_fin = :dateE, places_disponibles = :pdispo WHERE id_activite = :id");
    $sql->bindParam(':titre', $getTitre);
    $sql->bindParam(':desc', $getDesc);
    $sql->bindParam(':dist', $getDist);
    $sql->bindParam(':prix', $getPrix);
    $sql->bindParam(':dateS', $getDateS);
    $sql->bindParam(':dateE', $getDateE);
    $sql->bindParam(':pdispo', $getPdispo);
    $sql->bindParam(':id', $getId);
    $sql->execute();
}


if (isset($_POST['delete'])) {
    $getId = $_POST['delete'];
    $sql = $cnx->prepare("DELETE FROM activite WHERE id_activite = :id");
    $sql->bindParam(':id', $getId);
    $sql->execute();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-[#EDEDED]">
    <header class="fixed top-0 left-0 h-[75px] w-full bg-white flex items-center justify-between px-20 max-sm:px-10 z-30">
        <a href="../index.php"><img src="../img/Group 1.svg" alt="Logo"></a>
        <div class="flex items-center gap-5">
            <h3>Hello <?php echo $getUser['prenom']; ?>!</h3>
            <i id="bar" class="fa-solid fa-bars text-2xl"></i>
        </div>
    </header>

    <aside class="fixed left-0 top-[75px] h-[calc(100vh-75px)] z-30 w-[300px] bg-white overflow-hidden max-lg:w-0 transition-all duration-300">
        <ul class="mt-10 flex flex-col">
            <li id="closeMenu" class="text-xl absolute right-5 top-1 text-textSpecial hidden max-lg:block"><span><i class="fa-solid fa-xmark"></i></span></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="addActivities.php"><i class="fa-solid fa-circle-plus mr-5"></i>Add activity</a></li>
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="users.php"><i class="fa-solid fa-user mr-5"></i>Users</a></li>
            <?php echo $div; ?>
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
                if (isset($_POST['searchSubmit'])) {
                    $getSearch = $_POST['Search'];
                    $sql = $cnx->prepare("SELECT * FROM activite WHERE titre LIKE :search");
                    $sql->bindValue(':search', '%' . $getSearch . '%');
                } else {
                    $sql = $cnx->prepare("SELECT * FROM activite");
                }

                if ($sql->execute()) {
                    foreach ($sql as $item) {
                        $getActiviteId = $item['id_activite'];
                        $getItems = $cnx->prepare("SELECT * FROM reservation WHERE id_activite = :id_activite");
                        $getItems->bindParam(':id_activite', $getActiviteId);
                        $getItems->execute();
                        $getCount = $getItems->rowCount();
                        echo '
                        <div class="card w-full max-w-[300px] min-h-[500px] bg-[#EDEDED] hover:translate-y-[-5px] hover:scale-[101%] relative">
                            <div class="h-auto max-h-[50%] w-full">
                                <img class="min-w-full max-h-full" src="../img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                            </div>
                            <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                                <h2 class="text-lg">'.$item['titre'].'</h2>
                                <p class="text-sm">'.$item['description'].'</p>
                                <div class="w-full flex flex-col items-center gap-2">
                                    <button class="reserve h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white">Edit</button>
                                    <h6>('.$getCount.') orders</h6>
                                </div>
                            </div>
                            <form method="post" class="reserveSection hidden absolute top-0 left-0 h-full w-full bg-[#ff9c9cea] flex-col justify-center items-center gap-2">
                                <input name="titre" placeholder="Title" type="text" value="'.$item['titre'].'" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <textarea name="desc" placeholder="Description" class="w-[80%] h-[80px] rounded-[5px] pl-5" style="resize: none;">'.$item['description'].'</textarea>
                                <input name="dist" placeholder="Destination" value="'.$item['destination'].'" type="text" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <input name="prix" placeholder="Price ($)" value="'.$item['prix'].'" type="number" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <input name="dateS" type="date" value="'.$item['date_debut'].'" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <input name="dateE" type="date" value="'.$item['date_fin'].'" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <input name="pdispo" placeholder="Available places" value="'.$item['places_disponibles'].'" type="number" class="w-[80%] h-[40px] rounded-[5px] pl-5">
                                <div class="flex flex-col gap-2 w-full items-center">
                                    <button name="edit" value="'.$item['id_activite'].'" class="w-[80%] h-[40px] border-[3px] border-white rounded-[5px] hover:bg-white hover:text-[#FF9C9C] transition-all duration-300">Edit</button>
                                    <button name="delete" value="'.$item['id_activite'].'" class="w-[80%] h-[40px] border-[3px] border-white rounded-[5px] hover:bg-white hover:text-[#FF9C9C] transition-all duration-300">Remove</button>
                                    <button type="button" class="closeReserve w-[80%] h-[40px] text-white bg-[red] rounded-[5px] hover:bg-[#a02222] transition-all duration-300">Cancel</button>
                                </div>
                            </form>
                        </div>';
                    }
                }
            ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
