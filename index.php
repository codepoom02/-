<?php 
include('connection/connection.php');
session_start();
// Query type product
$sql = "SELECT * ,tb_product.title,tb_type_product.title AS type_title FROM tb_product LEFT JOIN tb_type_product ON tb_product.type_product_id = tb_type_product.id";
$query_type_product = mysqli_query($connection, $sql);

// Query product
$sql = "SELECT * ,tb_product.title,tb_type_product.title AS type_title FROM tb_product LEFT JOIN tb_type_product ON tb_product.type_product_id = tb_type_product.id";
$query_product = mysqli_query($connection, $sql);

//รายการสินค้าแนะนำ
$sql .= " ORDER BY view DESC LIMIT 3";
$query_recommend = mysqli_query($connection,$sql)
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/loader.php'); ?>
<?php include('includes/navbar/navbarindex.php'); ?>

<!-- Slide-banner -->
<?php include('includes/silde-baner.php'); ?>

<!-- Product types -->
 <div class="bg-secondary bg-gradient">
 <div class="container my-5 text-center">
    <h1 class="py-5 text-white">สินค้าแนะนำ</h1>
    <div class="row">
        <?php foreach ($query_recommend as $product): ?>
        <div class="col-12 col-lg-4 px-4 text-center pb-4">
            <div class="card" style="width: 18rem;">
                <img src="admin/upload/product/<?=$product['image']?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title "><?= $product['title'] ?></h5>
                    <p class="card-text">ประเภท : <?=($product['type_title']) ?></p>
                    <p class="card-text ">ราคา  <?=number_format( $product['price']) ?> บาท</p>
                    <a href="product-detail.php?id=<?=$product['id']?>" class="btn btn-dark text-center">ดูลายละเอียด</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
 </div>
 </div>
<div class="container my-5 text-center">
    <h1>รายการสินค้า</h1>
</div>
<style>
.Product-types {
    display: flex;
    justify-content: space-between; /* Evenly spaces the items */
    margin-bottom: 2rem; /* Adds space below the navigation */
}

.Product-types .nav-item {
    margin-right: 1.5rem; /* Adds space between nav items */
}
.Product-types img{
    height: 400px;
    width: 400px;
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: scale(1.05); /* Slight zoom effect */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Add a subtle shadow on hover */
}

.card-body {
    padding: 1.25rem; /* Adds padding inside the card */
}

.card-title {
    font-size: 1.25rem; /* Slightly larger title */
}

.card-text {
    font-size: 1.1rem; /* Price text size */
}

.list-group{
    margin-top: 25px;
}
.list-group-item{
    width: 300px !important;
    margin-left: -100px ;
    text-align: center;
    
    
}

.list-group-item:hover{
    background-color: #a78f16;
}
.group-item{
    background-color: black;
    color: #fff;
}
.group-item:hover {
    background-color: black;
    color: #fff;
}
.activd-list-menu-custom{
    background-color: lightgray;
}



/* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #f4f4f9;
    color: #333;
    font-size: 16px;
    line-height: 1.6;
}

/* Container Styling */
.container {
    padding: 2rem 5%;
}

/* Heading Styles */
h1, h2 {
    font-weight: 700;
    color: #333;
    margin-bottom: 2rem;
}

/* Product Detail Styles */
h1.text-center {
    font-size: 2.5rem;
    color: #333;
}

h2 {
    font-size: 1.8rem;
    margin-left: 0;
    color: #555;
}

h2 strong {
    color: #b74b4b;
}

h2 + h2 {
    margin-top: 1.5rem;
}

/* Product Image Styles */
.img-fluid {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Product List Section */
h2.text-center.mt-5 {
    font-size: 2rem;
    color: #444;
    margin-bottom: 2rem;
}

/* Product Card Styles */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.card-img-top {
    border-radius: 10px 10px 0 0;
    object-fit: cover;
    height: 250px;
}

.card-body {
    padding: 1.5rem;
    background-color: #fff;
}

.card-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #333;
}

.card-text {
    font-size: 1rem;
    color: #777;
}

.card-body a {
    display: inline-block;
    padding: 0.8rem 2rem;
    background-color: #b74b4b;
    color: white;
    font-size: 1rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.card-body a:hover {
    background-color: #9e3f3f;
    transform: scale(1.05);
}

/* Responsive Styles */
@media (max-width: 768px) {
    h1.text-center {
        font-size: 2rem;
    }

    h2.text-center.mt-5 {
        font-size: 1.5rem;
    }

    .row {
        margin: 0;
    }

    .col-12.col-md-6 {
        text-align: center;
    }

    .col-12.col-md-6 h2 {
        margin-left: 0;
    }

    .col-12.col-md-6 img {
        margin-top: 1rem;
        width: 100%;
    }
}

@media (max-width: 576px) {
    .card {
        margin-bottom: 1rem;
    }

    .card-body a {
        padding: 0.5rem 1.5rem;
    }
}


</style>
</style>
<!-- Products -->
<div class="container">
    <div class="row">
        <?php foreach ($query_product as $product): ?>
        <div class="col-12 col-lg-4 p-4 text-center">
            <div class="card" style="width: 18rem;">
                <img src="admin/upload/product/<?=$product['image']?>" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title "><?= $product['title'] ?></h5>
                    <p class="card-text">ประเภท : <?=($product['type_title']) ?></p>
                    <p class="card-text ">ราคา  <?=number_format( $product['price']) ?> บาท</p>
                    <a href="product-detail.php?id=<?=$product['id']?>" class="btn btn-dark text-center">ดูลายละเอียด</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
