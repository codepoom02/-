<?php 
session_start();

include('connection/connection.php');

if (isset($_POST) && !empty($_POST)){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM tb_user WHERE user = ? AND pass = ? AND status = 0";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $result = mysqli_fetch_assoc($query);
        $_SESSION['user_id'] = $result['id'];
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ',
                    text: 'ยินดีต้อนรับ!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#4BB543',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'index.php';
                });
            });
        </script>
        ";
        exit();
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'login.php';
                });
            });
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/navbar/navbarlogin.php'); ?>

<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>เข้าสู่ระบบ</p></h1>
    <div class="container mb-5">
        <div class="row">
            <div class="col-6 offset-3">
               <form action="" method="post">
                <div class="form-group mb-3">
                    <label class="form-label">ชื่อผู้ใช้</label>
                    <input id="user" name="user" type="text" class="form-control" required>
                    <div class="form-text">กรอกชื่อผู้ใช้</div>
                </div>

                <div class="form-group mb-3">
                    <label  class="form-label">รหัสผ่าน</label>
                    <input id="pass" name="pass" type="password" class="form-control" required>
                    <div class="form-text">กรอกรหัสผ่าน</div>
                </div>
  
                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
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
