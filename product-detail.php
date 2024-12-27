<?php 
include('connection/connection.php');
session_start();
// Query product
$sql = "SELECT 
            tb_product.id AS product_id, 
            tb_product.title, 
            tb_product.image, 
            tb_product.price, 
            tb_product.detail,
            tb_type_product.title AS type_title 
        FROM tb_product 
        LEFT JOIN tb_type_product 
        ON tb_product.type_product_id = tb_type_product.id";

$query_product = mysqli_query($connection,$sql);
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $sql_view = "UPDATE tb_product SET view = view+1 WHERE id = '$id'";
    $query_view = mysqli_query($connection,$sql_view);
    // เรีกยข้อมูลรายการสินค้าอื่นๆ ที่ไม่ใช้ id ที่ส่งมา
    $sql_product = $sql." WHERE tb_product.id != '$id' ORDER BY tb_product.id DESC LIMIT 4";
    $query_product = mysqli_query($connection, $sql_product);


    //เรียกข้อมูลสินค้าจาก id ที่ส่งมา
    $sql .= " WHERE tb_product.id = '$id'";

}
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/navbar/navbrproduct-detail.php'); ?>

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
    color: #fff ;
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

<div class="container my-5">
    
    <h1 class="text-center">รายละเอียดสินค้า</h1>
    <div class="row">

        <style>
          /* รูปภาพหลัก */
            #preview {
                display: block;
                margin: 0 auto; /* ให้รูปภาพอยู่ตรงกลาง */
                border-radius: 15px; /* มุมโค้ง */
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* เงารอบๆ รูป */
                transition: transform 0.3s ease; /* การแอนิเมชันเมื่อมีการ hover */
            }

            #preview:hover {
                transform: scale(1.05); /* ขยายขนาดเมื่อ hover */
            }

            /* กรอบสำหรับแกลเลอรี่ */
            .d-flex {
                display: flex;
                gap: 10px; /* เว้นระยะห่างระหว่างรูป */
                overflow-x: auto; /* ทำให้สามารถเลื่อนรูปได้ */
                padding: 10px 0;
                
            }

            .d-flex img {
                border-radius: 10px; /* มุมโค้ง */
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* เงารอบๆ รูป */
                transition: transform 0.3s ease, box-shadow 0.3s ease; /* การแอนิเมชัน */
                cursor: pointer;
            }

            .d-flex img:hover {
                transform: scale(1.1); /* ขยายขนาดเมื่อ hover */
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* เพิ่มเงาเมื่อ hover */
            }

            /* การปรับขนาดรูปเมื่ออยู่ในโหมดมือถือ */
            @media (max-width: 768px) {
                .d-flex {
                    flex-wrap: wrap; /* รูปแบบเลย์เอาต์แบบกริด */
                    justify-content: space-around; /* กระจายรูปให้เท่าๆ กัน */
                }

                .d-flex img {
                    width: 45%; /* ปรับขนาดรูปในมือถือ */
                }

                #preview {
                    width: 90%; /* ปรับขนาดรูปในมือถือ */
                }
            }

        </style>

        <div class="col-12 col-md-6">
            <br>
            <img id="preview" src="admin/upload/product/<?=$result['image']?>" class="img-fluid" alt="Product Image" style="margin-left: -120px !important;" width="80%">
            <?php 
                $sql = "SELECT * FROM tb_product_gallery  WHERE id_product = '$id'";
                $query = mysqli_query($connection,$sql);
            ?>
            <div class="d-flex overflow-auto mt-5" style="margin-left: -190px !important;" >
            <img src="admin/upload/product/<?=$result['image']?>" alt="" class="img-fluid me-3" width="30%" onclick="preview(this.src)" style="cursor: pointer;">
                <?php foreach($query as $key => $value):?>
                    <img src="admin/upload/product/<?=$value['image']?>" alt="" class="img-fluid me-3" width="30%" style="cursor: pointer;"
                    onclick="preview(this.src)">
                <?php endforeach;?>
            </div>
        </div>


        

        <div class="col-12 col-md-6 mt-5" >
        <h2 style="margin-left: -150px;"><strong>ชื่อสินค้า:</strong> <?= $result['title'] ?></h2>
            <h2 style="margin-left: -150px;"><strong>ประเภท:</strong> <?= $result['type_title'] ?></h2>
            <h2 style="margin-left: -150px;"><strong>ราคา:</strong> ฿<?= number_format($result['price']) ?> บาท</h2>
            <h2 style="margin-left: -150px;"><strong>รายละเอียด</strong><br> <?= nl2br($result['detail']) ?></h2>
        </div>
    </div>
    <h2 class="text-center mt-5">รายการสินค้าอื่นๆ</h2>

    <div class="row mt-5">
            <?php foreach ($query_product as $product): ?>
                <div class="col-12 col-md-4 col-lg-4 p-4">
                    <div class="card mt-2" style="width: 18rem;">
                        <img src="admin/upload/product/<?=$product['image']?>" class="card-img-top" alt="Product Image">
                        <div class="card-body" > 
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <p class="card-text">ประเภท : <?= htmlspecialchars($product['type_title']) ?></p>
                            <p class="card-text">ราคา : <?= number_format($product['price']) ?> บาท</p>
                            <center class="mt-2">
                            <a href="product-detail.php?id=<?=$product['product_id']?>" class="btn btn-dark">ดูลายละเอียด</a>
                            </center>
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
<script type="text/javascript">
function preview(src){
    // console.log(src);
    document.getElementById('preview').src = src;
}

</script>
</body>
</html>
