<?php  
include('connection/connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เก็บข้อมูลฟอร์ม
    $old_pass = mysqli_real_escape_string($connection, $_POST['old_pass']);
    $pass = mysqli_real_escape_string($connection, $_POST['pass']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // ตรวจสอบรหัสผ่านเก่า
    $check_old_pass_sql = "SELECT * FROM tb_user WHERE id = '$id' AND pass = '$old_pass'";
    $check_old_pass_query = mysqli_query($connection, $check_old_pass_sql);

    if (mysqli_num_rows($check_old_pass_query) === 0) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'รหัสผ่านไม่ตรงกัน',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'changepassword.php';
                });
            });
        </script>
        ";
        exit();
    }

    // ตรวจสอบรหัสผ่านใหม่และยืนยันรหัสผ่าน
    if ($pass !== $confirm_password) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'รหัสผ่านใหม่ไม่ตรงกัน!',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'changepassword.php';
                });
            });
        </script>
        ";
        exit();
    }

    // อัปเดตรหัสผ่านใหม่
    $update_pass_sql = "UPDATE tb_user SET pass = '$pass' WHERE id = '$id'";
    if (mysqli_query($connection, $update_pass_sql)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                    text: 'ข้อมูลได้รับการอัปเดตเรียบร้อยแล้ว!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#4BB543',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'changepassword.php';
                });
            });
        </script>
        ";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'changepassword.php';
                });
            });
        </script>
        ";
    }
}

// ดึงข้อมูลผู้ใช้
$sql = "SELECT * FROM tb_user WHERE id = '$id'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/navbar/nabarchangepassword.php'); ?>

<style>

</style>
<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>เปลี่ยนแปลงรหัสผ่าน</p></h1>
    <div class="container mb-5">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post" >
                    <div class="form-group mb-3" >
                    
                    <div class="mb-3">
                        <label  class="form-label">รหัสผ่านเก่า <span class="text-danger">*</span></label>
                        <input  id="password" name="old_pass" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">รหัสผ่าน | ใหม่<span class="text-danger">*</span></label>
                        <input  id="password" name="pass" type="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน | ใหม่<span class="text-danger">*</span></label>
                        <input id="confirm_password" name="confirm_password" type="password" class="form-control"required >
                    </div> 

                    <button type="submit" class="btn btn-primary">ยืนยันการเปลี่ยนรปัสผ่าน</button>
                </form>
            </div>
        </div>

    </div>


<!-- footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
