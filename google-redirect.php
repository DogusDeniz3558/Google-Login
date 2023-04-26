<?php
require_once 'config.php';
require_once 'google-api.php';
require_once 'google-settings.php';

function Filtrele($deger)
{
    $A = trim($deger);
    $B = strip_tags($A);
    $C = htmlspecialchars($B, ENT_QUOTES);
    return $C;
}

if (isset($_GET['code'])) {

    $gapi = new GooogleLoginApi();
    $data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
    $user = $gapi->GetUserProfileInfo($data['access_token']);
    echo $user['id'];

    $isim    = Filtrele($user['name']);
    $eposta  = Filtrele($user['email']);
    $id      = Filtrele($user['id']);
    $resim   = Filtrele($user['picture']);
    $sifrele = sha1(md5($id . $eposta));


    $varmi   = $db->prepare("SELECT * FROM uyeler WHERE eposta=:e AND googleid=:g");
    $varmi->execute([':e' => $eposta, ':g' => $id]);
    if ($varmi->rowCount()) {

        $guncelle  = $db->prepare("UPDATE uyeler SET isim=:i,resim=:r WHERE eposta=:e AND googleid=:g");
        $guncelle->execute([':i' => $isim, ':r' => $resim, ':e' => $eposta, ':g' => $id]);
    } else {

        $ekle   = $db->prepare("INSERT INTO uyeler SET
            isim    =?,
            eposta  =?,
            sifre   =?,
            resim   =?,
            googleid=?
        ");

        $ekle->execute([
            $isim,
            $eposta,
            $sifrele,
            $resim,
            $id
        ]);
    }


    $_SESSION['oturum'] = true;
    $_SESSION['isim']   = $isim;
    $_SESSION['eposta'] = $eposta;
    $_SESSION['resim']  = $resim;
    header('Location:index.php');
}
