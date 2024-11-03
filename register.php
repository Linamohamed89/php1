<!-- استيراد ملفات -->
<!-- هذان السطران يقومان بتحميل ملفي "header.php" و"config.php". الأول عادة يحتوي على كود HTML لعناصر الرأس، والثاني يحتوي على إعدادات قاعدة البيانات أو متغيرات التكوين. -->

<?php require "includes/header.php"; ?>
<?php require "config.php";?>


<!-- هنا يتم التحقق مما إذا كان هناك مستخدم مسجّل الدخول (إذا كانت جلسة المستخدم تحتوي على اسم مستخدم). إذا كان الأمر كذلك، يتم إعادة توجيه المستخدم إلى الصفحة الرئيسية "index.php". -->
<?php 
  if (isset($_SESSION['username'])){
    header("location: index.php");
  }


  if(isset($_POST['submit'])){//هذا الجزء يتحقق مما إذا تم إرسال النموذج (إذا تم الضغط على زر "submit").
    // يتم التحقق من عدم ترك أي حقل فارغ (البريد الإلكتروني، اسم المستخدم، وكلمة المرور). إذا كان أحد هذه الحقول فارغًا، يتم عرض رسالة تفيد بوجود مدخلات فارغة.
    if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] ==''){
      echo "some inputs are empty";
    }else{
      // إذا كانت جميع الحقول مليئة، يتم تخزين القيم في متغيرات، ثم يتم إعداد استعلام لإدراج البيانات في جدول "users". كلمة المرور تُخزن بعد تشفيرها باستخدام password_hash.
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];
    
    $insert = $conn->prepare("INSERT INTO users (email,username,mypassword) VALUES (:email , :username, :mypassword)");
    
    $insert -> execute([
      ':email' => $email,
      ':username' => $username,
      ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
    ]);
    }
  }
   ?>

<!-- نموذج التسجيل -->

<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
<!-- عند الضغط على زر "register"، سيتم إرسال البيانات إلى نفس الصفحة (register.php) باستخدام طريقة POST. -->
    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">register</button>
    <h6 class="mt-3">Aleardy have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>
<!-- استيراد تذييل الصفحة -->
<?php require "includes/footer.php"; ?>
