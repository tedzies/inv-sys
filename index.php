<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Hardware Inventory</title>
</head>

<body>
    <nav class="navbar navbar-expand-md justify-content-between position-fixed navbar-dark bg-dark w-100">
        <span class="navbar-brand mb-0 h1"><a class="home" href="homepage.php">HARDWARE INVENTORY</a></span>
    </nav>
    <div class="row h-100 w-100 align-items-center justify-content-center">
        <div class="card" style="width: 24rem;">
            <img src="https://plus.unsplash.com/premium_photo-1675979621109-7ad71d35b9e1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1016&q=80" class="card-img-top rounded h-25 img-fluid my-3" alt="...">
            <form action="ceklogin.php" method="post">
                <div class="card-body d-flex flex-column align-items-center p-0">
                    <h5 class="card-title fw-bold">HARDWARE INVENTORY</h5>
                    <p class="card-text fw-medium">LOGIN</p>
                    <div class="input-group flex-nowrap mb-1">
                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap my-1">
                        <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Password" aria-describedby="addon-wrapping">
                    </div>
                    <div class="d-flex flex-column w-100 my-3">
                        <button class="btn btn-primary m-1" type="submit" id="log-in-button">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>