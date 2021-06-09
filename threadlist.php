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
    <?php 
    include './partials/_dbconnect.php';
    ?>
    <?php 
        $catId=$_GET['catid'];
        $sql="SELECT * FROM `Categories` WHERE `Category_Id` =" .$catId;

        $result=mysqli_query($conn,$sql); 
        while($row=mysqli_fetch_assoc($result)) {
            $cat_name=$row['Category_Name'];
            $catg_des=$row['Category_Description']; 
         } 


    ?>
    


    <div class="content">

    <?php
        session_start();
        $catId=$_GET['catid'];
        $showalert=false;
        $showError=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST')
       {   
           if($_SESSION['loggedin']){

            $th_title=$_POST['title'];
            $th_desc=$_POST['desc'];
            $user_id=$_SESSION['user_id'];
            $sql= "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_user_Id`, `thread_categ_Id`, `timestamp`) 
            VALUES ( '$th_title', '$th_desc', '$user_id', '$catId', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showalert=true;
            }
            else
            {
                $error=mysqli_error($conn);
                echo '
                
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>'.$error.'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                ';
            }
            if($showalert)
            {
                echo '
                
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> Your thread has been added 🎉.Please wait for Community Respond
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                ';
            }

           }
           else
           {
            echo '
                
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Login , First</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            ';
           }
           
        }
        ?>
        <div class="p-5 my-3 mb-4 bg-light rounded-3 container">
            <div class="container-fluid py-2">
                <h1 class="display-5">Welcome to <?php echo $cat_name?> Forums</h1>
                <p class="col-md-8 fs-4"><?php echo $catg_des?></p>
                <hr class="mxy-4">
                <p>It is a peer to peer forum and It has Some Rules</p>
                <button class="btn btn-primary btn-lg" type="button">More</button>
            </div>
        </div>

        <div class="container">
            <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
                <h1 class="py-2">Start a Discussion</h1>
                <div class="mb-3">
                    <label for="title" class="form-label">Problem</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                    <div id="problemhelp" class="form-text">Keep title as short as possible.</div>
                </div>
                <div class="form-floating">
                    <textarea name="desc" class="form-control" placeholder="Leave a comment here" id="desc"></textarea>
                    <label for="floatingTextarea">Elaborate Your Problem</label>
                </div>
                <button type="submit" class="btn my-2 btn-success">Submit</button>
            </form>
        </div>
        <div class="container" id="ques">
            <h1 class="py-2">Browse Questions</h1>

            <?php 
            $catId=$_GET['catid'];
            $sql='SELECT * FROM `threads` WHERE `thread_categ_Id` ='.$catId;

            $result=mysqli_query($conn,$sql); 
            $noresult=true;
            while($row=mysqli_fetch_assoc($result)) {
                $id=$row['thread_id'];
                $noresult=false;
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $user_id=$row['thread_user_Id'];
                $thread_time=$row['timestamp'];
                $time=date('M j,Y',strtotime($thread_time));
                $sql2 ="SELECT * FROM `users` WHERE `user_id` = ".$user_id;
                $userresult=mysqli_query($conn,$sql2);
                if($userresult)
                {
                    while($row=mysqli_fetch_assoc($userresult))
                    {
                        $user_name=$row['user_name'];
                        echo 
                        '<div class="d-flex my-3">
                            <div class="flex-shrink-0">
                                <img src="./images/user-default.png" width="34px" alt="...">
                            </div>
                            <div class="flex-grow-1 ms-3">
                            <p class="fw-bold mb-1">'.$user_name.' at '.$time.'</p>
                                <h5 class="mt-0"><a href="thread.php?thread_id='.$id.'">'.$title.'</a></h5>
                                '.$desc.'
                            </div>
                        </div>';   
                    }
                }
                else
                {

            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>'.mysqli_error($conn).'</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
                }

             

            } 
        
            if($noresult)
            {

            echo '
            <div class="p-5 my-3 mb-4 bg-light rounded-3 container">
            <div class="container-fluid py-1">
                <p class="display-5">No Thread Found</p>
                <p class="col-md-8 fs-4">Be the First Person to ask a question</p>
            </div>
        </div>
            ';
            }

        ?>



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