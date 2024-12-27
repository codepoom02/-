<?php  
include('connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // ตรวจสอบข้อมูลที่ส่งมาว่าไม่ว่างเปล่า
    if (empty($_POST['pass']) || empty($_POST['confirm_password'])) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกรหัสผ่านและยืนยันรหัสผ่าน',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'register.php';
                });
            });
        </script>
        ";
        
    }


    
    // ตรวจสอบความตรงกันของรหัสผ่าน
    if ($pass !== $confirm_pass) {
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
                    window.location.href = 'register.php';
                });
            });
        </script>
        ";
        exit();
    }

    // เก็บข้อมูลฟอร์ม
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $birthday = mysqli_real_escape_string($connection, $_POST['birthday']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $user = mysqli_real_escape_string($connection, $_POST['user']);
    $hashed_pass = $pass; // บันทึกรหัสผ่านตรงๆ (ไม่แนะนำ)


    // SQL Insert
    $sql = "INSERT INTO tb_user (
                firstname, lastname, gender, birthday, age, address, email, phone, user, pass
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssisssss', $firstname, $lastname, $gender, $birthday, $age, $address, $email, $phone, $user, $hashed_pass);

    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'สมัครสมาชิกสำเร็จ',
                    text: 'ยินดีต้อนรับ!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#4BB543',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'login.php';
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
                    title: 'สมัครสมาชิกไม่สำเร็จ',
                    text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#FF6F61',
                    color: '#fff',
                    timerProgressBar: true
                }).then(function() {
                    window.location.href = 'register.php';
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

<?php include('includes/navbar/nabarregister.php'); ?>

<style>

</style>
<h1 class="my-5 py-5 text-center bg-secondary bg-geadient text-white" style="border-top: 1px solid with;"><p>สมัครสมาชิก</p></h1>
    <div class="container mb-5">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post" >
                    <div class="form-group mb-3" >
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="firstname" class="form-label">ชื่อ <span class="text-danger">*</span></label>
                                <input id="firstname" autocomplete="off" name="firstname" type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="lastname" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                                <input id="lastname" name="lastname" type="text" class="form-control" required >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="gender" class="form-label">เพศ</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="" selected disabled>เลือกเพศ</option>
                                    <option value="ชาย" >ชาย</option>
                                    <option value="หญิง" >หญิง</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="birthday" class="form-label">เดือน/วัน/ปีเกิด</label>
                                <input id="birthday" name="birthday" type="date" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                                <input id="age" name="age" type="number" class="form-control" 
                                    oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);" required>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่ <span class="text-danger">*</span></label>
                        <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">อีเมล</label>
                            <input id="email" name="email" type="email" class="form-control" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="phone" class="form-label">เบอร์ติดต่อ <span class="text-danger">*</span></label>
                            <input id="phone" name="phone" type="tel" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user" class="form-label">ชื่อผู้ใช้ <span class="text-danger">*</span></label>
                        <input id="user" name="user" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">รหัสผ่าน <span class="text-danger">*</span></label>
                        <input id="password" name="pass" type="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                        <input id="confirm_password" name="confirm_password" type="password" class="form-control"required >
                    </div>

                    <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
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
