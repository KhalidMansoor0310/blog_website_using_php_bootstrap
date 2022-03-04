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
  <?php require_once 'includes/nav.php'; ?>

  <?php
    require_once './includes/db.php';

    $single_id = $_GET['id'];
    $data = "SELECT * from articles where id = '{$single_id}'";
    $query = mysqli_query($connection, $data);
    $row = mysqli_fetch_assoc($query);

?>
    <div class="container my-5">
        <div class="row">
            <div class="card mb-3">
                <img src="images/about/about-us.jpg" class="card-img-top" style="height: 400px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title'];?></h5>
                    <p class="card-text"><?php echo $row['content']?></p>
                    <p class="card-text"><small class="text-muted"><?php echo $row['created_at'];?></small></p>
                </div>
            </div>
        </div>
    </div>


    <?php require_once './includes/footer.php';  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>