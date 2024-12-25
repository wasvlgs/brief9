

<?php



    require '../database.php';


    if(isset($_POST['submitActivite'])){
        $getTitre = $_POST['titre'];
        $getDesc = $_POST['desc'];
        $getDist = $_POST['dist'];
        $getPrix = $_POST['prix'];
        $getDateS = $_POST['dateS'];
        $getDateE = $_POST['dateE'];
        $getPdispo = $_POST['pdispo'];



        if($cnx){
            $sql = $cnx->prepare("INSERT INTO activite(titre,description,destination,prix,date_debut,date_fin,places_disponibles) VALUES('$getTitre', '$getDesc', '$getDist', $getPrix, '$getDateS', '$getDateE',$getPdispo)");
            $sql->execute();
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
            <li class="h-[50px] flex pl-10 items-center text-lg bg-[#FF9C9C]"><a href="addActivities.php"><i class="fa-solid fa-circle-plus mr-5"></i>Add activitie</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="users.php"><i class="fa-solid fa-user mr-5"></i>Users</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg  cursor-pointer"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</li>
        <script>document.getElementById("logout").onclick = ()=>{location.replace("../index.php")}</script>

        </ul>
    </aside>


    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">

        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">Add activitie</h1>
        </div>
        

        <div class="afficheContent w-[98%] h-full bg-white p-10 max-md:p-5 max-sm:p-3 flex flex-wrap gap-10 justify-center">

            <form  method="post" class="w-full h-full flex flex-col justify-center items-center gap-5 py-4 px-10 max-md:px-5 max-sm:px-0">
                <input name="titre" type="text" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350]" placeholder="Title" required>
                <textarea name="desc" class="w-full h-[100px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350] resize-none" placeholder="Description" required></textarea>
                <input name="dist" type="text" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350]" placeholder="Distination" required>
                <input name="prix" type="number" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350]" placeholder="Prix ($)" required>
                <label class="w-full text-[#acabab]">Date start:<input name="dateS" type="date" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350] focus:text-black" required></label>
                <label class="w-full text-[#acabab]">Date end:<input name="dateE" type="date" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350] focus:text-black" required></label>
                <input name="pdispo" type="number" class="w-full h-[50px] border-b-2 border-[#d3d3d3] outline-none pl-4 focus:border-[#50f350]" placeholder="Places disponibles" required>



                <button name="submitActivite" class="w-[200px] h-[45px] rounded-[5px] border-[3px] border-textSpecial text-textSpecial font-bold mt-10 hover:bg-textSpecial hover:text-white transition-all duration-300">Add activity</button>
            </form>

        </div>



    </section>

    

    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="../js/scrip.js"></script>
</body>
</html>