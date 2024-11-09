<div class="navbar-brand">
    <a href="index.php">
        <h1 class="navbar-heading">Дом кино</h1>
    </a>
</div>
<div class="navbar-container">
    <nav class="navbar">
        <div class="burger-menu" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Афиша</a></li>
            <li><a href="about.php">О нас</a></li>
            <li><a href="contact-us.php">Где нас найти</a></li>
            <li><a href="cart.php">Корзина</a></li>
        </ul>
    </nav>
</div>

<script>
    function toggleMenu() {
        const menu = document.querySelector('.navbar-menu');
        menu.classList.toggle('active');
    }
</script>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .navbar-heading {
        margin: 0;
        font-size: 2rem;
    }

    .burger-menu {
        display: none;
        cursor: pointer;
    }

    .navbar i {
        font-size: 1.5rem;
    }

    .navbar-menu {
        display: flex;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .navbar-menu li {
        padding: 10px;
    }

    @media (max-width: 768px) {
        .navbar-menu {
            display: none;
            flex-direction: column;
            text-align: center;
            background-color: #fff;
            position: absolute;
            top: 56px;
            left: -255px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 300px;
            z-index: 1000;
        }

        .navbar-menu.active {
            display: flex;
        }

        .burger-menu {
            display: block;
            margin-top: 2em;
        }
    }
</style>