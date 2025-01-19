<!DOCTYPE html>
<html lang="en">
<?php
    include("connection/connect.php");
    error_reporting(0);
    session_start();
?>

<head>
    <title>Menu</title>
    <?php include('./common/head.php') ?>
</head>

<body>

    <?php include('./common/header.php') ?>
    <div class="page-wrapper">
        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
            <div class="container"> </div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <section class="menu-page">
            <div class="container">
                <div class="menu-filter">
                    <span class="filter-btn" onclick="filterItems('all')">All</span>
                    <span class="filter-btn" onclick="filterItems('drinks')">Drinks</span>
                    <span class="filter-btn" onclick="filterItems('burger')">Burgers</span>
                    <span class="filter-btn" onclick="filterItems('coffee')">Coffee</span>
                    <span class="filter-btn" onclick="filterItems('salads')">Salads</span>
                    <span class="filter-btn" onclick="filterItems('sandwiches')">Sandwiches</span>
                    <span class="filter-btn" onclick="filterItems('submarine')">Submarine</span>
                    <span class="filter-btn" onclick="filterItems('wrap')">Wraps</span>
                </div>

                <div class="menu-items">
                    <div class="row">
                        <!-- Drinks -->
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/images.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Blue Lagoon</div>
                                <div class="col-md-3">LKR : 1690.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/fresh-orange-juice-glass-dark-background_865967-226416.avif" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Grenadine Mojito</div>
                                <div class="col-md-3">LKR : 1885.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/mimosa_400.webp" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Sunrise Mimosa</div>
                                <div class="col-md-3">LKR : 1775.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/blue-virjin-mojito.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Blue Curaçao Mojito</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/powerpoint-template-450w.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Strawberry Grenadine Mocktail</div>
                                <div class="col-md-3">LKR : 1820.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/fresh-lime-juice-served-glass-refreshing-homemade-lemonade-mint-rustic-wooden-table-selective-focus-image-88080928.webp" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Fresh lime juice</div>
                                <div class="col-md-3">LKR : 1235.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/800wm.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Fresh mango juice</div>
                                <div class="col-md-3">LKR : 975.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/download.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Fresh passion fruit juice</div>
                                <div class="col-md-3">LKR : 1105.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/images (3).jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Strawberry mint mojitho</div>
                                <div class="col-md-3">LKR : 1547.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/mango-mojito-with-mango-slices-mint-served-cocktail-glass-tropical-island-background_875755-15020.avif" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Mango milkshake</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/mimosa_400.webp" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Very berry</div>
                                <div class="col-md-3">LKR : 1885.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/images (2).jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Templers vanilla classic frappe</div>
                                <div class="col-md-3">LKR : 1885.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/800wm.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Mango smoothie</div>
                                <div class="col-md-3">LKR : 1885.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item drinks">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/beverages/images (3).jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Strawberry banana smoothie</div>
                                <div class="col-md-3">LKR : 2015.00</div>
                            </div>
                        </div>

                        <!-- Burger -->
                        <div class="col-md-6 mb-2 food-item burger">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/burger/veggie burger.avif" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Veggie Burger</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item burger">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/burger/beef burger.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Beef Burger</div>
                                <div class="col-md-3">LKR : 2405.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item burger">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/burger/grild chicken burger.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Crispy Chicken Burger</div>
                                <div class="col-md-3">LKR : 2275.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item burger">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/burger/grild chicken burger.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Grilled Chicken Burger</div>
                                <div class="col-md-3">LKR : 2015.00</div>
                            </div>
                        </div>

                        <!-- Coffee -->
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/download.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Hot Latte</div>
                                <div class="col-md-3">LKR : 975.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/download (1).jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Iced latte</div>
                                <div class="col-md-3">LKR : 1105.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/ESPRESSO.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Espresso</div>
                                <div class="col-md-3">LKR : 650.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/flat white.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Flat white</div>
                                <div class="col-md-3">LKR : 1040.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/hot americano.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Hot Americano</div>
                                <div class="col-md-3">LKR : 780.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/iced-americano-7-1.webp" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Iced americano</div>
                                <div class="col-md-3">LKR : 910.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/hot cappuccino.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Hot cappuccino</div>
                                <div class="col-md-3">LKR : 1040.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/Iced-Cappuccino-Recipe_5.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Iced cappuccino</div>
                                <div class="col-md-3">LKR : 1170.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/hot mocha latte.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Hot mocha latte</div>
                                <div class="col-md-3">LKR : 1170.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item coffee">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/coffee/iced mocha latte.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Iced mocha latte</div>
                                <div class="col-md-3">LKR : 1287.00</div>
                            </div>
                        </div>

                        <!-- Salads -->
                        <div class="col-md-6 mb-2 food-item salads">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/salads/Tomato and cucamber salad.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Tomato and cucumber salad</div>
                                <div class="col-md-3">LKR : 1495.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item salads">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/salads/Teriyaki chicken salad.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Teriyaki chicken salad</div>
                                <div class="col-md-3">LKR : 2275.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item salads">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/salads/cranberry apple chicken salad.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Cranberry apple chicken salad</div>
                                <div class="col-md-3">LKR : 2535.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item salads">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/salads/Shrimp-Avocado-Salad.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Shrimp and avocado salad</div>
                                <div class="col-md-3">LKR : 2730.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item salads">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/salads/Thai beef salad.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Thai beef salad</div>
                                <div class="col-md-3">LKR : 2860.00</div>
                            </div>
                        </div>

                        <!-- Sandwiches -->
                        <div class="col-md-6 mb-2 food-item sandwiches">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/sandwiches/Fried_Egg_Sandwich_with_Cheese_and_Bacon.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Egg and cheese sandwich</div>
                                <div class="col-md-3">LKR : 1235.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item sandwiches">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/sandwiches/beef steak sandwiches.avif" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Beef Steak Sandwiches</div>
                                <div class="col-md-3">LKR : 1755.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item sandwiches">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/sandwiches/chees and tomato sandwiches.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Cheese and tomato sandwich</div>
                                <div class="col-md-3">LKR : 1235.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item sandwiches">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/sandwiches/ham and cheese sandwiches.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Ham and Chesse Sandwiches</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item sandwiches">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/sandwiches/thanduri  chicken sandwiches.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Tandoori chicken sandwich</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>

                        <!-- Submarine -->
                        <div class="col-md-6 mb-2 food-item submarine">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/submarine/italian-veggie-submarine_tasteover.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Veggie Submarine</div>
                                <div class="col-md-3">LKR : 1365.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item submarine">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/submarine/beef steak  submarine.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Beef Steak Submarine</div>
                                <div class="col-md-3">LKR : 2015.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item submarine">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/submarine/devild chicken  submarine.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Deviled chicken submarine</div>
                                <div class="col-md-3">LKR : 1625.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item submarine">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/submarine/devild prown  submarine.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Deviled prawns submarine</div>
                                <div class="col-md-3">LKR : 1885.00</div>
                            </div>
                        </div>

                        <!-- Wrap -->
                        <div class="col-md-6 mb-2 food-item wrap">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/wrap/thandoori chicken wraps.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Thandoori Chicken Wraps</div>
                                <div class="col-md-3">LKR : 2405.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item wrap">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/wrap/spicy prawn wraps.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Spicy Prawn Wraps</div>
                                <div class="col-md-3">LKR : 2795.00</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 food-item wrap">
                            <div class="row image-for-text">
                                <div class="col-md-4"><img src="images/food/wrap/beef steak wraps.jpg" class="image-for-food" alt=""></div>
                                <div class="col-md-5">Beef Steak Wraps</div>
                                <div class="col-md-3">LKR : 2405.00</div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <br />
            </div>
        </section>
        <style>
            .menu-filter {
                margin-bottom: 20px;
                text-align: center;
            }

            .filter-btn {
                padding: 10px 20px;
                margin: 5px;
                border: none;
                /* background-color: #4caf50; */
                color: black;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .image-for-food {
                width: 180px;
                height: 180px;
                object-fit: cover;
                object-position: center center;
            }

            .image-for-text {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .filter-btn:hover {
                background-color: #45a049;
            }

            .food-item.hidden {
                display: none;
            }
        </style>
        <script>
            function filterItems(category) {
                const items = document.querySelectorAll('.food-item');

                items.forEach(item => {
                    if (category === 'all') {
                        item.classList.remove('hidden');
                    } else {
                        if (item.classList.contains(category)) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    }
                });
            }
        </script>
        <?php include('./common/footer.php') ?>
        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
</body>

</html>