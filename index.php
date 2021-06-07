<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <title>phpForum</title>
</head>

<body>
    <?php include './partials/_header.php' ?>
    <?php include './partials/_dbconnect.php' ?>
    <div class="content">

        <!-- Slider -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/coding3.jpeg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/coding2.jpeg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/coding1.jpeg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Category Container -->
        <div class="container">

            <h1 class="text-center my-5">phpForum - Categories</h1>


            <div class="row">
                <!-- Fetch all the Categories -->
                <?php
                $sql="SELECT * FROM `Categories`";
                $result=mysqli_query($conn,$sql);
                    //    Use a for loop to iterate throught Categories 
                while($row=mysqli_fetch_assoc($result))
                {
                    $id = $row['Category_Id'];
                    $cat=$row['Category_Name'];
                    $catg_des=$row['Category_Description'];
                    echo '
                    
                    <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" height="250" src="./images/'.$cat.'.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">'.$cat.'</a></h5>
                            <p class="card-text">'.substr($catg_des,0,100).'...</p>
                            <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Thread</a>
                        </div>
                    </div>
                </div>
                    
                    ';
                }
                ?>
          



            </div>
        </div>

    </div>
    <?php include './partials/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>