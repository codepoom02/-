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

<?php include('includes/navbar/navbarcontact.php'); ?>

<style>
    
</style>
<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>ติดต่อเรา</p></h1>
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h2><p class="text-decoration-underline">ข้อมูติดต่อเรา</p></h2>
                <p class="textbreak fs-5">ชื่อ :<?=$result['name']?></p>
                <p class="textbreak fs-5">ที่อยู่ :<?=$result['address']?></p>
                <p class="textbreak fs-5">Emai :<?=$result['email']?></p>
                <p class="textbreak fs-5">เบอร์โทร :<?=$result['phone']?></p>
                
                <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4693.4690940677065!2d99.9642416852339!3d8.429003111182407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3053013c41bc139b%3A0xea53b8e76db508d3!2sOld%20City%20Wall%2C%20Nakhon%20Si%20Thammarat!5e0!3m2!1sen!2sth!4v1734502050855!5m2!1sen!2sth" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
            </div>
            
        </div>
    </div>


<!-- footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
