<header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
        <div class="container">
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
            <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/icn.png" alt=""> </a>

        </div>
    </nav>
</header>

<header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2">
                            <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" style="width: 50px; height: 50px; object-fit: cover;"> </a>
                        </div>
                        <div class="col-md-7">
                            <div class="collapse navbar-toggleable-md" id="mainNavbarCollapse">
                                <ul class="nav navbar-nav " style="margin-left: 2rem;">
                                    <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link active" href="menu.php">Menu <span class="sr-only"></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                                    <?php
                                    if (empty($_SESSION["user_id"])) {
                                        echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							                  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                                    } else {
                                        echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                        echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 float-lg-right">
                            <button class="book-table-button">
                                Book a table
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </nav>
</header>