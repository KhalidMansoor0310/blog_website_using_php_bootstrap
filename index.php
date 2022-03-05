<?php

require_once './includes/function.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Blog Website - PHP</title>
</head>

<body>
    <?php require_once './includes/nav.php'; ?>
    <!-- posts  -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8">
                <?php
                include_once './includes/db.php';
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $post_per_page = 3;
                // $result = (2-1)*5 = 5;
                $result = ($page - 1) * $post_per_page;

                //code for search
                if(isset($_GET['search'])){
                    $key = $_GET['search'];
                    $data = "SELECT * from articles WHERE title LIKE '%$key%' ORDER BY id DESC LIMIT $result,$post_per_page";
                }
                else{
                    $data = "SELECT * from articles ORDER BY id DESC LIMIT $result,$post_per_page";
                }
                $query = mysqli_query($connection, $data);
                while ($row = mysqli_fetch_assoc($query)) {
                    $category_id = $row['category_id'];
                ?>
                    <div class="row">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
<<<<<<< HEAD
                                    <span class="badge badge-pill bg-dark text-white pr-2 pl-2 pt-2 pb-2 ml-0"><?php echo getCategory($connection,$category_id);?></span>
                                    <?php 
                                    
                                    $article_img = getimages($connection,$row['id']);
                                    foreach($article_img as $img){
                                        ?>
                                        <img src="images/<?=$img['image'];?>" class="img-fluid rounded-start" alt="...">
                                    <?php
                                    }
                                    ?>
=======
                                    <img src="images/event-3.jpg" class="img-fluid rounded-start" alt="...">
>>>>>>> 0c616a766389ed9fdf109fbff9359f4cef030676
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="./posts.php?id=<?php echo $row['id']; ?>" class="card-title"><?php echo $row['title']; ?></a>
                                        <p class="card-text"><?php echo $row['content']; ?></p>
                                        <p class="card-text"><small class="text-muted"><?php echo $row['created_at']; ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">Featured</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card my-4">
                    <h5 class="card-header">Featured</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="card my-4">
                    <h5 class="card-header">Featured</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $q = "SELECT * from articles";
        $r = mysqli_query($connection,$q);
        $total_articles = mysqli_num_rows($r);
        $total_pages = ceil($total_articles/$post_per_page);
        // echo $total_pages;
        if($page>1){
            $switch="";
        }else{
            $switch="disabled";
        }
        if($page<$total_pages){
            $nswitch="";
        }else{
            $nswitch="disabled";
        }

    
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination text-center justify-content-center">
            <li class="page-item <?php echo $switch;?>"><a class="page-link" href="?page=<?php echo $page-1;?>">Previous</a></li>
            <?php 
            for($opage = 1; $opage<$total_pages; $opage++){
                ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $opage?>"><?=$opage?></a></li>
               <?php
            }
            
            
            ?>
            <li class="page-item <?php echo $nswitch;?>"><a class="page-link" href="?page=<?php echo $page+1;?>">Next</a></li>

        </ul>
    </nav>

    <?php require_once './includes/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>