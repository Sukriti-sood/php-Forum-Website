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
    <?php include './partials/_dbconnect.php'?>
    <div class="content">
        <?php 
        $catId=$_GET['catid'];
        $sql="SELECT * FROM `Categories` WHERE `Category_Id` =" .$catId;

        $result=mysqli_query($conn,$sql); 
        while($row=mysqli_fetch_assoc($result)) {
            $cat_name=$row['Category_Name'];
            $catg_des=$row['Category_Description']; 
        } 
        
        ?>
        <div class="p-5 my-3 mb-4 bg-light rounded-3 container">
            <div class="container-fluid py-5">
                <h1 class="display-5">Welcome to <?php echo $cat_name?> Forums</h1>
                <p class="col-md-8 fs-4"><?php echo $catg_des?></p>
                <hr class="mxy-4">
                <p>It is a peer to peer forum and It has Some Rules</p>
                <button class="btn btn-primary btn-lg" type="button">More</button>
            </div>
        </div>


        <div class="container">
            <h1 class="py-2">Browse Questions</h1>

            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="./images/user-default.png" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0">Question Title</h5>
                    This is some content from a media component. You can replace this with any content and adjust it as
                    needed.
                </div>
            </div>
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="./images/user-default.png" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0">Question Title</h5>
                    This is some content from a media component. You can replace this with any content and adjust it as
                    needed.
                </div>
            </div>
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="./images/user-default.png" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0">Question Title</h5>
                    This is some content from a media component. You can replace this with any content and adjust it as
                    needed.
                </div>
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