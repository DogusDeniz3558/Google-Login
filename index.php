<?php
require_once 'config.php';
require_once 'google-settings.php';

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Google İle Login</title>
    <style>
        .btn-google {
            color: #545454;
            background-color: #ffffff;
            box-shadow: 0 1px 2px 1px #ddd;
        }
        .btn-google:hover{
            opacity: .7;
            box-shadow: 3px 3px 3px 3px gray;
        }

    </style>
</head>
<body>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin-top: 18%; margin-left: 8%;">

        <?php if (isset($_SESSION['oturum'])) { ?>

            <h2>Hoşgeldiniz, <?php echo $_SESSION['isim']; ?></h2>
            <img src="<?php echo $_SESSION['resim']; ?>" width="200" height="200"/>
            <br>
            <a href="logout.php" class="btn btn-danger mt-5">Çıkış Yap</a>

        <?php } else { ?>
                    <div class="col-md-12">
                        <a href="<?php echo $login_url; ?>" class="btn btn-lg btn-google btn-block text-uppercase btn-outline"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> GOOGLE İLE ÜYE GİRİŞİ YAP</a>
                    </div>

        <?php } ?>



    </div>
    <div class="col-md-4"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
