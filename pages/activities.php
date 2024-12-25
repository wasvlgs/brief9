<?php



    require '../database.php';



    if(isset($_POST['submit'])){
        $getFName = $_POST['FName'];
        $getLName = $_POST['LName'];
        $getEmail = $_POST['email'];
        $getNumber = $_POST['tel'];
        $getAdress = $_POST['add'];
        $getNaissance = $_POST['dn'];
        $getReserve = $_POST['dr'];
        $getIdReserve = $_POST['submit'];

        if($cnx){
            $sql = $cnx->prepare("INSERT INTO client(nom,prenom,email,telephone,adress,date_naissance) VALUES('$getLName','$getFName','$getEmail','$getNumber','$getAdress','$getNaissance')");
            if($sql->execute()){
                $getData = $cnx->prepare("SELECT * FROM client WHERE email = '$getEmail'");
                $getData->execute();
                $getResult = $getData->get_result();
                $getuser = $getResult->fetch_assoc();
                $getID = $getuser['id_client'];


                $sql2 = $cnx->prepare("INSERT INTO reservation(id_client,id_activite,date_reservation,statut) VALUES('$getID','$getIdReserve','$getReserve','En attente')");
                $sql2->execute();
            }
            
        }
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
        <div class="flex items-center gap-5"><h3>Hello User!</h3><i id="bar" class="fa-solid fa-bars text-2xl"></i></div>
    </header>

    <aside class="fixed left-0 top-[75px] h-[calc(100vh-75px)] z-30 w-[300px] bg-white overflow-hidden max-lg:w-0 transition-all duration-300">
        <ul class="mt-10 flex flex-col">
            <li id="closeMenu" class="text-xl absolute right-5 top-1 text-textSpecial hidden max-lg:block"><span><i class="fa-solid fa-xmark"></i></span></li>
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="reservation.php"><i class="fa-solid fa-circle-check mr-5"></i>Reservations</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg  cursor-pointer"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</li>
        <script>document.getElementById("logout").onclick = ()=>{location.replace("../index.php")}</script>

        </ul>
    </aside>


    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">

        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">All activities</h1>
            <form method="post" class="w-[250px] h-[40px] bg-white flex items-center rounded-[5px] overflow-hidden">
                <input name="Search" type="text" placeholder="Search..." class="w-[80%] h-full border-none outline-none pl-4"><button name="searchSubmit" class="w-[20%] h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        

        <div class="afficheContent w-[98%] h-full bg-white p-10 max-sm:p-4 flex flex-wrap gap-10 justify-center">


            <?php




            if(isset($_POST['searchSubmit'])){
                $getSearch = $_POST['Search'];
                $sql = $cnx->prepare("SELECT * FROM activite WHERE titre LIKE '%$getSearch%'");
            }else{
                $sql = $cnx->prepare("SELECT * FROM activite");
            }

                if($sql->execute()){
                    $result = $sql->get_result();

                    foreach($result as $item){
                        $getActiviteId = $item['id_activite'];
                        $getItems = $cnx->prepare("SELECT * FROM reservation WHERE id_activite = $getActiviteId");
                        $getItems->execute();
                        $itemsResult = $getItems->get_result();
                        $getCount = $itemsResult->num_rows;
                        echo '<div class="card w-full max-w-[300px] min-h-[500px] bg-[#EDEDED] hover:translate-y-[-5px] hover:scale-[101%] relative">
                            <div class="h-auto max-h-[50%] w-full">
                                <img class="min-w-full max-h-full" src="../img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                            </div>
                            <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                                <h2 class="text-lg">'.$item['titre'].'</h2>
                                <p class="text-sm">'.$item['description'].'</p>
                                <h5 class="text-sm">$'.$item['prix'].'</h5>
                                <div class="w-full flex flex-col items-center gap-2"><button class="reserve h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white">Reserve</button><h6>('.$getCount.') orders</h6></div>
                            </div>
                            <form method="post" class="reserveSection hidden absolute top-0 left-0 h-full w-full bg-[#ff9c9cea] flex-col justify-center items-center gap-3">
                                <div class="w-[80%] flex gap-2"><input type="text" name="FName" placeholder="First name" class="w-1/2 h-[40px] rounded-[5px] pl-2 outline-none" required><input type="text" name="LName" placeholder="Last name" class="w-1/2 h-[40px] rounded-[5px] pl-2 outline-none" required></div>
                                <input placeholder="Email" name="email" type="text" class="w-[80%] h-[40px] rounded-[5px] pl-5 outline-none">
                                <div class="w-[80%] flex gap-2"><input type="tel" name="tel" placeholder="Number" class="w-1/2 h-[40px] rounded-[5px] pl-2 outline-none" required><input type="text" name="add" placeholder="Adresse" class="w-1/2 h-[40px] rounded-[5px] pl-2 outline-none" required></div>
                                <label class="w-[80%]">Date de naissance:<input name="dn" type="date" class="w-full h-[40px] rounded-[5px] pl-5 outline-none"></label>
                                <label class="w-[80%]">Date de reservation:<input name="dr" type="date" class="w-full h-[40px] rounded-[5px] pl-5 outline-none"></label>
                                <div class="flex flex-col gap-5 w-full items-center"><button name="submit" value="'.$item['id_activite'].'" class="w-[80%] h-[40px] border-[3px] border-white rounded-[5px] hover:bg-white hover:text-[#FF9C9C] transition-all duration-300">Reserve</button>
                                <button type="button" class="closeReserve w-[80%] h-[40px] text-white bg-[red] rounded-[5px] hover:bg-[#a02222] transition-all duration-300">cancel</button></div>
                            </form>
                        </div>';
                    }
                }


            ?>
            
           


        </div>



    </section>

    

    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="../js/scrip.js"></script>
</body>
</html>