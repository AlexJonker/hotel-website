<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/restaurant.css">
    <link rel="stylesheet" href="/styling/footer.css">
    <title>Restaurant - Hotel De Zonne Vallei</title>
    <link rel="icon" href="/assets/favicon.ico">
</head>

<body>

<?php include("../assets/navbar.html"); ?>


    <div class="hero-container">
        <div class="hero-content-wrapper">
            <h1>Welkom in ons Restaurant</h1>
            <p>Geniet van ontbijt, lunch, diner en een gezellige bar in Hotel De Zonne Vallei.</p>
            <div class="hero-button-container">
                <a href="#menu">Bekijk Menu</a>
                <a id="h-btn-2" href="#reserveren">Reserveren</a>
            </div>
        </div>
    </div>

    <section class="about-section">
        <div class="about-content-wrapper">
            <h2>Over het Restaurant</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius iure quasi aut architecto eum, mollitia et corrupti ipsa eligendi, perferendis quo ratione magnam pariatur saepe, dolorum natus eaque tempora voluptas?</p>
        </div>
    </section>

    <section class="about-section">
        <div class="about-content-wrapper">
            <h2>Openingstijden</h2>
            <p><strong>Ontbijt:</strong> Mon – Fri: 6:30am – 10:30am | Sat – Sun: 7am – 11am</p>
            <p><strong>Lunch:</strong> Mon – Fri: 12pm – 2:30pm | Sat – Sun: 12pm – 3pm</p>
            <p><strong>Diner:</strong> Mon – Fri: 6pm – 10pm | Sat – Sun: 6pm – 10:30pm</p>
            <p><strong>Bar:</strong> Tues – Sat: 5pm – 11:30pm</p>
        </div>
    </section>

    <section class="about-section2" id="menu">
        <div class="about-content-wrapper">
            <h2>Menu</h2>
            <ul style="list-style: none; padding: 0;">
                <li>Voorgerecht: Tomatensoep</li>
                <li>Hoofdgerecht: Gegrilde Zalm</li>
                <li>Nagerecht: Chocolade Mousse</li>
            </ul>
        </div>
    </section>

    <section class="about-section" id="reserveren">
        <div class="about-content-wrapper">
            <h2>Maak een Reservering</h2>
            <p>Bel ons: 1-800-000-0000</p>
            <a class="about-button" href="tel:18000000000">Nu reserveren</a>
        </div>
    </section>

<?php include("../assets/footer.html"); ?>

</body>

</html>
