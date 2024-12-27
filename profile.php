<?php  
include('connection/connection.php');
session_start();
$id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เก็บข้อมูลฟอร์ม
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $birthday = mysqli_real_escape_string($connection, $_POST['birthday']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);


    // SQL Insert
    $sql = sprintf("UPDATE tb_user SET firstname = '%s', lastname = '%s', gender = '%s', birthday = '%s', age = '%s', address = '%s', 
    email = '%s', phone = '%s' WHERE id ='%s'",$firstname,$lastname,$gender,$birthday,$age,$address,$email,$phone,$id);
    // echo $sql;
    // exit();
    $query = mysqli_query($connection, $sql);
    // Bind parameters
    if ($query) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
                    text: 'ยินดีต้อนรับ!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#4BB543',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'profile.php';
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
                    title: 'แก้ไขข้อมูลไม่สำเร็จ',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'profile.php';
                });
            });
        </script>
        ";
    }
}
// print_r($_SESSION);
// exit();


$sql = sprintf("SELECT * FROM tb_user WHERE id = '%s'",$id);
// echo $sql;
// exit();
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">
<?php include('includes/head.php'); ?>

<body>

<?php include('includes/navbar/nabarprofile.php'); ?>

<style>

</style>
<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>ข้อมูลส่วนตัว</p></h1>
    <div class="container mb-5">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post" >
                    <div class="form-group mb-3" >
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="firstname" class="form-label">ชื่อ <span class="text-danger">*</span></label>
                                <input value="<?=$result['firstname']?>" id="firstname" autocomplete="off" name="firstname" type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                                <input value="<?=$result['lastname']?>" id="lastname" name="lastname" type="text" class="form-control" required >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="gender" class="form-label">เพศ</label>
                                <select value="" id="gender" name="gender" class="form-control" required>
                                    <option value="" disabled>เลือกเพศ</option>
                                    <option value="ชาย" <?=$result['gender'] == 'ชาย'? 'selected' : ''?> >ชาย</option>
                                    <option value="หญิง" <?=$result['gender'] == 'หญิง'? 'selected' : ''?>>หญิง</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="birthday" class="form-label">เดือน/วัน/ปีเกิด</label>
                                <input value="<?=$result['birthday']?>" id="birthday" name="birthday" type="date" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                                <input value="<?=$result['age']?>" id="age" name="age" type="number" class="form-control" 
                                    oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่ <span class="text-danger">*</span></label>
                        <textarea id="address" name="address" class="form-control" rows="3" required>
                        <?=$result['address']?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">อีเมล</label>
                            <input value="<?=$result['email']?>" id="email" name="email" type="email" class="form-control" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="phone" class="form-label">เบอร์ติดต่อ <span class="text-danger">*</span></label>
                            <input  value="<?=$result['phone']?>" id="phone" name="phone" type="tel" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user" class="form-label">ชื่อผู้ใช้ <span class="text-danger">*</span></label>
                        <input value="<?=$result['user']?>" id="user" name="user" type="text" class="form-control" disabled>
                    </div>

                    <!-- <div class="mb-3">
                        <label  class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                        <input  id="password" name="pass" type="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                        <input id="confirm_password" name="confirm_password" type="password" class="form-control"required >
                    </div> -->

                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูลส้วนตัว</button>
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
