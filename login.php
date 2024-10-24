<?php require "includes/header.php"; ?> <!-- تضمين رأس الصفحة -->
<?php require "config.php"; ?> <!-- تضمين ملف إعدادات الاتصال بقاعدة البيانات -->
<?php

//take the data and to the query استعلام قاعدة البيانات: يتم استخدام استعلام SQL للبحث عن المستخدم الذي يطابق البريد الإلكتروني المدخل.

//fetch the data  يتم جلب بيانات المستخدم باستخدام fetch().

// check for the row count 




//check for the submit ..تحقق مما إذا كان النموذج قد تم إرسال/
if (isset($_POST['submit'])){
   // تحقق مما إذا كانت المدخلات فارغة
  if (empty($_POST['email'] or empty($_POST['password']))){
      echo "some inputs are empty"; // طباعة رسالة تنبه المستخدم بأن المدخلات غير مكتملة
  }else{
     // تخزين بيانات البريد الإلكتروني وكلمة المرور في متغيرات
    $email = $_POST['email'];
    $password = $_POST['password'];

        // إعداد استعلام لجلب بيانات المستخدم من قاعدة البيانات باستخدام البريد الإلكتروني
    $login =$conn->query("SELECT * FROM users WHERE email ='$email'");
    $login -> execute();// تنفيذ الاستعلام
    $data = $login->fetch(PDO::FETCH_ASSOC);// جلب البيانات كمصفوفة
  
    if ($login->rowCount() > 0){
      //use the password_verify function ->they actually check for the right password 
  // هنا يمكن التحقق من كلمة المرور باستخدام دالة password_verify
        if (password_verify($password, $data['mypassword'])) {
            echo "logged in";// تسجيل الدخول ناجح
        } else {
            echo " email or password is wrong ,كلمة المرور خاطئة"; // رسالة خطأ في حالة كلمة مرور خاطئة
        }

    } else {
            echo " email or password is wrong ,كلمة المرور خاطئة"; // رسالة خطأ في حالة كلمة مرور خاطئة
        }
  
  }
}
?>

<main class="form-signin w-50 m-auto">
  <form action="login.php" method="POST">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name ="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
  
    <div class="form-floating">
      <input name ="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name = "submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
