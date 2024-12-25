<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VG - Home</title>
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="w-full h-full bg-[#EDEDED]">


    <header class="h-[75px] w-full bg-white flex items-center justify-between px-20 max-sm:px-5">
        <a href="index.php"><img src="img/Group 1.svg" alt="Logo"></a>
        <i id="burgerButton" class="fa-solid fa-bars text-textSpecial text-2xl"></i>
        <ul class="menu flex items-center gap-8 text-lg font-medium text-[#424141] static max-lg:absolute max-lg:top-0 max-lg:left-0 max-lg:w-full max-lg:h-full max-lg:bg-white max-lg:flex-col max-lg:justify-center max-lg:gap-16 max-lg:hidden">
            <li class="absolute hidden left-10 top-10 text-textSpecial text-2xl max-lg:block closeMenu"><i class="fa-solid fa-xmark"></i></li>
            <li><a class="hover:text-[#EB3223] transition-all duration-300" href="index.php">Home</a></li>
            <li><a class="hover:text-[#EB3223] transition-all duration-300" href="#bestTrips">activities</a></li>
            <li><a class="hover:text-[#EB3223] transition-all duration-300" href="#about">About</a></li>
            <li><a class="hover:text-[#EB3223] transition-all duration-300" href="#contact">Contact</a></li>
            <li class="ml-8 max-lg:ml-0"><a class="sign w-[150px] h-[45px] flex justify-center items-center rounded-[5px] text-white" href="#">Sign up</a></li>
        </ul>
    </header>

    
    <section class="w-full h-[calc(100vh-75px)] flex">
        <div class="homeContent h-full w-1/2 flex flex-col justify-center pl-20 gap-5 max-lg:w-full max-lg:items-center max-lg:pl-0">
            <h5 class="text-lg font-semibold">welcome to,</h5>
            <h1 class="text-5xl font-bold max-sm:text-3xl"><span>VG</span> travel platform!</h1>
            <p class="text-base text-[#505050] max-lg:text-center max-lg:px-[10vw]">Plan your trips effortlessly with us. Explore exclusive deals on flights, hotels, and tours, and customize your travel experience in just a few clicks.</p>
            <a class="w-[200px] h-[50px] rounded-[5px] flex justify-center items-center bg-white border-[3px] border-textSpecial mt-10 text-textSpecial hover:bg-textSpecial hover:text-white transition-all duration-200" href="pages/activities.php">Get your trip now!</a>
        </div>
        <div class="homePicture w-1/2 h-full flex justify-center items-center max-lg:hidden">
            <img class="w-[30vw]" src="img/plane ticket.svg" alt="Plan ticket">
        </div>
    </section>
    
    <section id="bestTrips" class="bestTrips min-h-[60vh]">
        <div class="title h-[40px] w-full flex justify-center items-center"><h2 class="text-4xl font-bold text-textSpecial">Best Trip Plans</h2></div>
        <div class="cardsSection py-20 flex flex-wrap justify-center gap-20">
            <div class="card w-full max-w-[300px] min-h-[500px] bg-white hover:translate-y-[-5px] hover:scale-105">
                <div class="h-auto max-h-[50%] w-full">
                    <img class="min-w-full max-h-full" src="img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                </div>
                <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                    <h2 class="text-lg">Experience the Magic of Santorini</h2>
                    <p class="text-sm">Santorini’s iconic views and sunsets offer the perfect escape Santorini’s iconic views and sunsets offer the perfect escape ...</p>
                    <div class="w-full flex flex-col items-center gap-2"><a class="h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white" href="#">Learn More</a><h6>(152) orders</h6></div>
                </div>
            </div>
            <div class="card w-full max-w-[300px] min-h-[500px] bg-white hover:translate-y-[-5px] hover:scale-105">
                <div class="h-auto max-h-[50%] w-full">
                    <img class="min-w-full max-h-full" src="img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                </div>
                <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                    <h2 class="text-lg">Experience the Magic of Santorini</h2>
                    <p class="text-sm">Santorini’s iconic views and sunsets offer the perfect escape Santorini’s iconic views and sunsets offer the perfect escape ...</p>
                    <div class="w-full flex flex-col items-center gap-2"><a class="h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white" href="#">Learn More</a><h6>(152) orders</h6></div>
                </div>
            </div>
            <div class="card w-full max-w-[300px] min-h-[500px] bg-white hover:translate-y-[-5px] hover:scale-105">
                <div class="h-auto max-h-[50%] w-full">
                    <img class="min-w-full max-h-full" src="img/Thailand aesthetics ___ _ _ Have the trip of a… 1-1.svg" alt="">
                </div>
                <div class="min-h-[50%] w-full flex flex-col justify-evenly gap-2 p-2">
                    <h2 class="text-lg">Experience the Magic of Santorini</h2>
                    <p class="text-sm">Santorini’s iconic views and sunsets offer the perfect escape Santorini’s iconic views and sunsets offer the perfect escape ...</p>
                    <div class="w-full flex flex-col items-center gap-2"><a class="h-[40px] w-[180px] bg-textSpecial flex justify-center items-center text-white" href="#">Learn More</a><h6>(152) orders</h6></div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about w-full min-h-[60vh] px-40 max-xl:px-20 max-lg:px-0">

        <div class="title h-[40px] w-full flex justify-center items-center"><h2 class="text-4xl font-bold text-textSpecial mb-16">About us</h2></div>

        <div class="w-full min-h-[350px] flex  max-md:flex-col max-md:gap-10">
            <div class="w-1/2 flex flex-col justify-center gap-5 pl-36 max-lg:pl-10 max-sm:pl-0 max-md:w-full max-md:h-1/2 max-md:items-center">
                <h3 class="text-2xl font-semibold">Who Are We?</h3>
                <p class="max-w-[300px] max-md:text-center">We are a dedicated travel agency focused on providing high-quality services and a modern user experience. Our mission is to make booking trips simple, efficient, and enjoyable.</p>
            </div>
            <div class="w-1/2 flex justify-center items-center max-md:w-full max-md:h-1/2">
                <img class="w-[40%]" src="img/Man looking at map during camping trip.svg" alt="Man looking at map during camping trip">
            </div>
        </div>
        <div class="w-full min-h-[350px] flex flex-row-reverse  max-md:flex-col max-md:gap-10">
            <div class="w-1/2 flex flex-col justify-center gap-5 pl-36 max-lg:pl-10 max-sm:pl-0 max-md:w-full max-md:h-1/2 max-md:items-center">
                <h3 class="text-2xl font-semibold">Our Vision:</h3>
                <p class="max-w-[300px] max-md:text-center">We aim to become your trusted partner for all your travel needs. Whether you're dreaming of exotic destinations or peaceful getaways, we’re here to guide you every step of the way.</p>
            </div>
            <div class="w-1/2 flex justify-center items-center max-md:w-full max-md:h-1/2">
                <img class="w-[40%]" src="img/Man looking at map during camping trip-1.svg" alt="Man looking at map during camping trip">
            </div>
        </div>
        <div class="w-full min-h-[350px] flex  max-md:flex-col max-md:gap-10">
            <div class="w-1/2 flex flex-col justify-center gap-5 pl-36 max-lg:pl-10 max-sm:pl-0 max-md:w-full max-md:h-1/2 max-md:items-center">
                <h3 class="text-2xl font-semibold">Our Values:</h3>
                <p class="max-w-[300px] max-md:text-center">Transparency, innovation, and customer satisfaction are at the heart of what we do. We are committed to offering personalized solutions to ensure every traveler has a unique and memorable experience.</p>
            </div>
            <div class="w-1/2 flex justify-center items-center max-md:w-full max-md:h-1/2">
                <img class="w-[40%]" src="img/Man looking at map during camping trip-2.svg" alt="Man looking at map during camping trip">
            </div>
        </div>
    </section>

    <section class="startSign flex min-h-[100px] w-full my-20 max-lg:flex-col max-lg:gap-10">
        <div class="w-1/2 flex justify-center items-center max-lg:w-full">
            <p class="text-xl w-1/2 text-center text-textSpecial">Explore the world with us and enjoy a unique, unforgettable travel experience tailored just for you.</p>
        </div>
        <div class="w-1/2 flex justify-center items-center max-lg:w-full">
            <div class="w-[60%] h-[70px] bg-white rounded-[50px] overflow-hidden flex justify-between p-1 max-sm:w-[80%]">
                <input placeholder="Enter your email" type="text" class="w-[60%] h-full border-none outline-none pl-6">
                <button class="w-[40%] h-full bg-textSpecial rounded-[50px] text-white text-lg font-semibold">Start now</button>
            </div>
        </div>
    </section>


    <footer id="contact" class="w-full min-h-[450px] bg-[#212121] flex flex-col items-center justify-between">
        <div class="footerTop w-[90%] h-[100px] border-b-2 border-textSpecial flex items-center justify-between px-4">
            <img src="img/Group 1.svg" alt="Logo To Do List">
            <div class="socialMedia flex gap-5 text-3xl text-textSpecial max-sm:text-xl">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>

        <div class="footerContent text-white w-[90%] grid grid-cols-3 grid-rows-[250px] max-md:grid-cols-2 max-md:grid-rows-[250px 250px] max-sm:grid-cols-1 max-sm:grid-rows-[250px 250px 250px]">
            <ul class="flex flex-col items-center p-10 gap-5">
                <li class="text-xl font-bold">Liens utiles</li>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <ul  class="flex flex-col items-center p-10 gap-5">
                <li class="text-xl font-bold">Nos servicess</li>
                <li>Gestion des trips</li>
                <li>Organisation du temps</li>
                <li>Articles et conseils</li>
            </ul>
            <ul  class="flex flex-col items-center p-10 gap-5">
                <li class="text-xl font-bold">À propos</li>
                <li>Description courte</li>
                <li>Qui sommes-nous</li>
            </ul>
        </div>

        <div class="bottomFooter text-white w-full h-20 flex justify-center items-center">
            <h5>© 2024 Wassim Yazza. All rights reserved</h5>
        </div>
    </footer>

    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
    <script src="js/scrip.js"></script>
</body>
</html>