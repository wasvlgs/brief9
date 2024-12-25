
<?php



    require '../database.php';


    if(isset($_POST['delete'])){
        $getId = $_POST['delete'];
        if($cnx){
            $sqld = $cnx->prepare("DELETE FROM client WHERE id_client = '$getId'");
            $sqld->execute();
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
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="addActivities.php"><i class="fa-solid fa-circle-plus mr-5"></i>Add activitie</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="users.php"><i class="fa-solid fa-user mr-5"></i>Users</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg  cursor-pointer"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</li>
        </ul>
        <script>document.getElementById("logout").onclick = ()=>{location.replace("../index.php")}</script>
    </aside>


    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">

        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">All users</h1>
            <form method="post" class="w-[250px] h-[40px] bg-white flex items-center rounded-[5px] overflow-hidden">
                <input name="Search" type="text" placeholder="Search..." class="w-[80%] h-full border-none outline-none pl-4"><button name="searchSubmit" class="w-[20%] h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        

        <div class="afficheContent w-[98%] h-full bg-white p-10 max-sm:p-4 flex flex-wrap gap-10 justify-start overflow-x-auto">


            <table class="w-full h-full" >
                <thead>
                    <tr class="text-xl">
                        <th class="w-[20%] text-start min-w-[100px]">Full Name</th>
                        <th class="w-[20%] text-start min-w-[150px]">Email</th>
                        <th class="w-[20%] text-start min-w-[100px]">Number</th>
                        <th class="w-[20%] text-start min-w-[100px]">Adresse</th>
                        <th class="w-[20%] text-start min-w-[100px]">Delete</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                    
                    if($cnx){
                        if(isset($_POST['searchSubmit'])){
                            $getSearch = $_POST['Search'];
                            $sql = $cnx->prepare("SELECT * FROM client WHERE nom LIKE '%$getSearch%' OR prenom LIKE '%$getSearch%'");
                        }else{
                            $sql = $cnx->prepare("SELECT * FROM client");
                        }

                        if($sql->execute()){
                            $getResult = $sql->get_result();
                            foreach($getResult as $item){
                                echo '<tr>
                        <td>'.$item['prenom'].' '.$item['nom'].'</td>
                        <td>'.$item['email'].'m</td>
                        <td style="padding:0px 50px;">'.$item['telephone'].'</td>
                        <td>'.$item['adress'].'</td>
                        <td style="padding:0px 20px;"><form method="post"><button name="delete" value="'.$item['id_client'].'" style="width: 45px;" class="h-[40px] bg-[red] rounded-[5px] text-white"><i class="fa-solid fa-trash"></i></button></form></td>
                    </tr>';
                            }
                        }
                    }



                ?>
                    <!-- <tr>
                        <td>Wassim Yazza</td>
                        <td>wassim@gmail.com</td>
                        <td>0600000000</td>
                        <td>Safi, Miftah el khair</td>
                        <td><form><button style="width: 45px;" class="h-[40px] bg-[red] rounded-[5px] text-white"><i class="fa-solid fa-trash"></i></button></form></td>
                    </tr>

                    <tr>
                        <td>Wassim Yazza</td>
                        <td>wassim@gmail.com</td>
                        <td>0600000000</td>
                        <td>Safi, Miftah el khair</td>
                        <td><form><button style="width: 45px;" class="h-[40px] bg-[red] rounded-[5px] text-white"><i class="fa-solid fa-trash"></i></button></form></td>
                    </tr>
                    <tr>
                        <td>Wassim Yazza</td>
                        <td>wassim@gmail.com</td>
                        <td>0600000000</td>
                        <td>Safi, Miftah el khair</td>
                        <td><form><button style="width: 45px;" class="h-[40px] bg-[red] rounded-[5px] text-white"><i class="fa-solid fa-trash"></i></button></form></td>
                    </tr> -->

                    
                    
                </tbody>
                

            </table>

           


        </div>



    </section>

    

    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="../js/scrip.js"></script>
</body>
</html>