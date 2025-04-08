<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>De Webshop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Voeg Tailwind CSS toe via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Voeg een leuke font toe (bijvoorbeeld Google Fonts) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="font-poppins">
    <!-- Navigation-->
    <nav class="bg-blue-900 p-4">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a class="text-white text-2xl font-bold" href="/">De Webshop</a>
            
            <!-- Button for mobile view -->
            <button class="text-white md:hidden" id="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links (hidden on mobile) -->
            <div id="navbar-menu" class="hidden md:flex space-x-6 text-white">
                <a class="hover:text-yellow-500" href="/products">Producten</a>
                <a class="hover:text-yellow-500" href="/categories">Categorieen</a>
                <a class="hover:text-yellow-500" href="/coupons">Coupons</a>
                <a class="hover:text-yellow-500" href="/roles">Rollen</a>
                <a class="hover:text-yellow-500" href="/users">Gebruikers</a>
                <a class="hover:text-yellow-500" href="/reviews">Reviews</a>
                <a class="hover:text-yellow-500" href="/cart">&#xF242;</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    {{$slot}}

    <!-- Footer-->
    <footer class="bg-blue-900 py-5 mt-10">
        <div class="container mx-auto text-center">
            <p class="text-white">Copyright &copy; Webshop 2025</p>
        </div>
    </footer>

    <!-- JavaScript for mobile toggle -->
    <script>
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            const navbarMenu = document.getElementById('navbar-menu');
            navbarMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
