<!DOCTYPE html>
<html lang="en">
<head>
   <title>Registration</title>
   <?php include('./common/head.php') ?>
</head>

<body>
   <div style="background-image: url('images/pimg.jpg');background-size: cover;background-repeat: no-repeat;background-position: center;">
      <?php include('./common/header.php') ?>
      <div class="page-wrapper">
         <section class="contact-page inner-page">
            <div class="container ">
               <div class="row ">
                  <div class="col-md-12">
                     <div class="widget">
                        <div class="widget-body">
                           <form action="" method="post">
                              <h2 class="register-h2">Register</h2>
                              <div class="row">
                                 <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">User-Name</label>
                                    <input class="form-control" type="text" name="username" id="example-text-input">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input class="form-control" type="text" name="firstname" id="example-text-input">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input class="form-control" type="text" name="lastname" id="example-text-input-2">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input class="form-control" type="text" name="phone" id="example-tel-input-3">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Confirm password</label>
                                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2">
                                 </div>
                                 <div class="form-group col-sm-12">
                                    <label for="exampleTextarea">Delivery Address</label>
                                    <textarea class="form-control" id="exampleTextarea" name="address" rows="3"></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-4">
                                    <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php include('./common/footer.php') ?>
      </div>
</body>

</html>