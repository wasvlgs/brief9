

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/output.css">
</head>




<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Login succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">
  Error try again!
</div>




<body class="bg-gray-50 text-gray-800">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Chef's Culinary Experience</h1>
                <p class="text-gray-500">Log in to your account</p>
            </div>

            <form id="formSignIn" action="#" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-textSpecial"
                    />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-textSpecial"
                    />
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-textSpecial focus:ring-textSpecial border-gray-300 rounded"
                        />
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember Me</label>
                    </div>
                    <a href="#" class="text-sm text-textSpecial hover:underline">Forgot Password?</a>
                </div>

                <button name="submit" type="submit" class="w-full py-3 px-4 bg-textSpecial text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-textSpecial">Log In</button>

                <div class="text-center text-gray-500 text-sm mt-6">or</div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="signup.php" class="text-textSpecial hover:underline">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>



    <?php



session_start();

require_once '../database.php';
require_once '../classes/user.php';


$db = new Database();
$cnx = $db->getConnection();
$user = new User($cnx);

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $loginResult = $user->login($email, $password);

    if ($loginResult === 'admin') {
        echo '<script>document.getElementById("success").style.display = "flex";
        setTimeout(()=>{document.getElementById("success").style.display = "none"; location.replace("../admin/addActivities.php");}, 1000)</script>';
    } else if ($loginResult === 'client') {
        echo '<script>document.getElementById("success").style.display = "flex";
        setTimeout(()=>{document.getElementById("success").style.display = "none"; location.replace("../pages/activities.php");}, 1000)</script>';
    } else {
        echo '<script>document.getElementById("error").style.display = "flex";
        setTimeout(()=>{document.getElementById("error").style.display = "none";}, 1000)</script>';
    }
}
?>




    <script>

        const email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        const password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        document.querySelector("#formSignIn").addEventListener("submit",(event)=>{

        const formElements = event.target.elements;

        let getEmail = formElements['email'];
        let getPassword = formElements['password'];


        getEmail.style.border = "1px solid #d1d5db";
        getPassword.style.border = "1px solid #d1d5db";

        if(!email.test(getEmail.value)){
            event.preventDefault();
            getEmail.style.border = "2px solid red";
        }else if(!password.test(getPassword.value)){
            event.preventDefault();
            getPassword.style.border = "2px solid red";
        }
    })
    </script>
</body>
</html>
