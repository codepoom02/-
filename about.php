<?php 
include('connection/connection.php');
session_start();
$id= 1;
$sql = "SELECT * FROM tb_about WHERE id = '$id'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/navbar/navbarabout.php'); ?>


<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>เกี่ยวกับเรา</p></h1>
    <div class="container mb-5">
        <div class="row">
        <div class="col-12">
                <h2><p class="text-decoration-underline">ชื่อ</p></h2>
                <p class="textbreak fs-5"><?=nl2br($result['name'])?></p>
            </div>
            <div class="col-12">
                <h2><p class="text-decoration-underline">ข้อมูลเกี่ยวกับเรา</p></h2>
                <p class="textbreak fs-5"><?=nl2br($result['description'])?></p>
            </div>
            
            <div class="col-12">
                <h2><p class="text-decoration-underline">ที่อยู่</p></h2>
                <p class="textbreak fs-5"><?=nl2br($result['address'])?></p>
            </div>
            <div class="col-12">
                <h2><p class="text-decoration-underline">อีเมลย์</p></h2>
                <p class="textbreak fs-5"><?=nl2br($result['email'])?></p>
            </div>
            <div class="col-12">
                <h2><p class="text-decoration-underline">เบอร์ติดต่อ</p></h2>
                <p class="textbreak fs-5"><?=nl2br($result['phone'])?></p>
            </div>
        </div>
    </div>


<!-- footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
