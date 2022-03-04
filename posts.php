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
    <?php include_once './includes/function.php'; ?>
    <?php require_once 'includes/nav.php'; ?>

    <?php
    require_once './includes/db.php';

    $single_id = $_GET['id'];
    $data = "SELECT * from articles where id = '{$single_id}'";
    $query = mysqli_query($connection, $data);
    $row = mysqli_fetch_assoc($query);
    $category_id = $row['category_id'];
    // echo $category_id;

    ?>
    <?php

    $article_img = getimages($connection, $row['id']);

    ?>

    <div class="container my-5">
        <div class="row">
            <div class="card mb-3 col-md-8">
                <div class="card-title my-3">
                    <span class="badge badge-pill mb-3 bg-dark text-white pr-2 pl-2 pt-2 pb-2 ml-0"><?php echo getCategory($connection, $category_id); ?></span>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($article_img as $img) {
                            ?>
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="./images/<?= $img['image'] ?>" alt="First slide">
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['content'] ?></p>
                    <p class="card-text"><small class="text-muted"><?php echo $row['created_at']; ?></small></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Related Posts</h2>
        <div class="row">
            <?php
                $query = "SELECT * from articles where category_id ={$row['category_id']} ORDER BY id DESC";
                $run = mysqli_query($connection, $query);
                while ($res = mysqli_fetch_assoc($run)) {
                    if($res['id']==$row['id']){
                        continue;
                    }
                    ?>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/computer.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="posts.php?id=<?=$row['id']?>" class="card-title"><?php echo $res['title']; ?></a>
                                    <p class="card-text"><?php echo $res['content']; ?></p>
                                    <p class="card-text"><small class="text-muted"><?=date('F js, Y',strtotime($res['created_at'])); ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        <?php
                }


        ?>
        </div>
    </div>


    <?php require_once './includes/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>