<?php
require '../database.php';
require '../classes/user.php';

session_start();

if (isset($_SESSION['id'])) {
    $db = new Database();
    $cnx = $db->getConnection();

    $userId = $_SESSION['id'];
    $userClass = new User($cnx);
    $user = $userClass->getUserById($userId);

    if ($user['role'] != 'admin' && $user['role'] != 'sAdmin') {
        session_destroy();
        header("Location: ../login/login.php");
        exit;
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['delete'])) {
        $getId = $_POST['delete'];
        $sql = $cnx->prepare("DELETE FROM client WHERE id_client = :id");
        $sql->bindParam(':id', $getId);
        $sql->execute();
    }

    if (isset($_POST['block'])) {
        $getId = $_POST['block'];
        $sql = $cnx->prepare("UPDATE client SET status = 'banned' WHERE id_client = :id");
        $sql->bindParam(':id', $getId);
        $sql->execute();
    }

    if (isset($_POST['searchSubmit'])) {
        $getSearch = $_POST['Search'];
        $sql = $cnx->prepare("SELECT * FROM client WHERE role != 'sAdmin' AND (nom LIKE :search OR prenom LIKE :search)");
        $sql->bindValue(':search', '%' . $getSearch . '%');
    } else {
        $sql = $cnx->prepare("SELECT * FROM client WHERE role != 'sAdmin'");
    }
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_ASSOC);

} else {
    session_destroy();
    header("Location: ../login/login.php");
    exit;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-[#EDEDED]">
    <header class="fixed top-0 left-0 h-[75px] w-full bg-white flex items-center justify-between px-20 max-sm:px-10 z-30">
        <a href="../index.php"><img src="../img/Group 1.svg" alt="Logo"></a>
        <div class="flex items-center gap-5">
            <h3>Hello <?php echo $user['prenom']; ?>!</h3>
            <i id="bar" class="fa-solid fa-bars text-2xl"></i>
        </div>
    </header>

    <aside class="fixed left-0 top-[75px] h-[calc(100vh-75px)] z-30 w-[300px] bg-white overflow-hidden max-lg:w-0 transition-all duration-300">
        <ul class="mt-10 flex flex-col">
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="addActivities.php"><i class="fa-solid fa-circle-plus mr-5"></i>Add activity</a></li>
            <li class="h-[50px] flex pl-10 items-center text-lg"><a href="activities.php"><i class="fa-solid fa-calendar-days mr-5"></i>Activities</a></li>
            <li class="h-[50px] flex pl-10 items-center bg-[#FF9C9C] text-lg"><a href="users.php"><i class="fa-solid fa-user mr-5"></i>Users</a></li>
            <li id="logout" class="h-[50px] flex pl-10 items-center text-lg cursor-pointer">
            <form method="post"><button name="logout"><i class="fa-solid fa-arrow-right-from-bracket mr-5"></i>Logout</button></form>
        </li>
        </ul>
        <script>document.getElementById("logout").onclick = ()=>{location.replace("../index.php")}</script>
    </aside>

    <section class="content h-full w-full pl-[300px] flex flex-col items-center gap-16 max-lg:p-0">
        <div class="topContent w-full flex justify-between mt-[150px] px-16 max-lg:px-10 max-sm:px-0 max-sm:flex-col max-sm:justify-start max-sm:gap-9 max-sm:items-center">
            <h1 class="text-2xl text-textSpecial">All users</h1>
            <form method="post" class="w-[250px] h-[40px] bg-white flex items-center rounded-[5px] overflow-hidden">
                <input name="Search" type="text" placeholder="Search..." class="w-[80%] h-full border-none outline-none pl-4">
                <button name="searchSubmit" class="w-[20%] h-full"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Users</h2>

            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-200 overflow-auto">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">First Name</th>
                            <th class="py-4 px-6 text-left font-medium">Last Name</th>
                            <th class="py-4 px-6 text-left font-medium">Email</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-center"><?php echo $user['prenom']; ?></td>
                                <td class="text-center"><?php echo $user['nom']; ?></td>
                                <td class="text-center"><?php echo $user['email']; ?></td>
                                <td class="text-center"><?php echo $user['status']; ?></td>
                                <td class="text-center">
                                    <form method="post">
                                        <?php if ($user['status'] == 'active'): ?>
                                            <button name="delete" value="<?php echo $user['id_client']; ?>" class="h-[40px] bg-red-500 rounded-[5px] text-white">Delete</button>
                                            <button name="block" value="<?php echo $user['id_client']; ?>" class="h-[40px] bg-red-500 rounded-[5px] text-white">Block</button>
                                        <?php else: ?>
                                            <button name="delete" value="<?php echo $user['id_client']; ?>" class="h-[40px] bg-red-500 rounded-[5px] text-white">Delete</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    
    <script src="../js/scrip.js"></script>
</body>
</html>
