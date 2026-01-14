<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
      }
      body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #dfdfdf;

      }
      .login-box{
        display: flex;
        justify-content: center;
        flex-direction: column;
        width: 440px;
        height: 480px;
        padding: 30px;
      }
      .login-header{
        text-align: center;
        margin: 20px 0 40px 0;
      }
      .login-header header{
        color: #333;
        font-size: 30px;
        font-weight: 600;
      }
      .input-box .input-field{
        width: 100%;
        height: 60px;
        font-size: 17px;
        padding: 0 25px;
        margin-bottom: 15px;
        border-radius: 30px;
        border: none;
        box-shadow: 0px 5px 10px 1px rgba(0, 0, 0, 0.15);
        outline: none;
        transition: .3s;
      }
      ::placeholder{
        font-weight: 500;
        color: #222;
      }
      .input-field:focus{
        width: 105%;
      }
      .input-submit{
        position: relative;
      }
     
      .submit-btn {
  width: 100%;
  height: 60px;
  background: #222;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  transition: .3s;
  color: #fff; /* <-- this makes the text white */
  font-size: 16px;
  font-weight: bold;
}

.submit-btn:hover {
  background: #000;
  transform: scale(1.05); /* Fixed: transform instead of transition */
}

    </style>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
  <form method="post" action="<?php echo base_url('Main/checkLogin'); ?>" class="login-box">
    <div class="login-header">
      <header>LOGIN</header>  
    </div>

    <div class="input-box">
      <input type="text" name="username" class="input-field" placeholder="Username" required>
    </div>

    <div class="input-box">
      <input type="password" name="password" class="input-field" placeholder="Password" required>
    </div>

    <div class="input-submit">
      <input type="submit" class="submit-btn" value="Login">
    </div>
  </form>

<!-- Flash Success Message via SweetAlert -->
<!-- Include jQuery and SweetAlert2 (once only per page) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $this->session->flashdata('error'); ?>',
        });
    <?php elseif ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= $this->session->flashdata('success'); ?>',
        });
    <?php endif; ?>
</script>

  </body>
</html>

