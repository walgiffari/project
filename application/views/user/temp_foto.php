<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg-8">
 <form method="POST" >
        <input type="radio" name="radio-1"> <img src="<?=base_url('assets/');?>templates/templates/templates1.jpeg">



                    <button type="submit" class="btn btn-primary" style="width:100px;">Pilih</button>

</form>


<?php

if (isset($_POST['radio-1'])) {

    $db_host = 'localhost'; // Nama Server
    $db_user = 'root'; // User Server
    $db_pass = ''; // Password Server
    $db_name = 'project'; // Nama Database

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die('Gagal terhubung MySQL: ' . mysqli_connect_error());
    }

    $sql = 'SELECT * from user_templates';
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

    $img = imagecreatefromjpeg("./assets/templates/foto/1.jpg");

    $fontsize = 25;

    $fontsizee = 15;

    $color = imagecolorallocatealpha($img, 15, 0, 0, 0);

    $text = $row['suami'];
    $text2 = $row['istri'];
    $text3 = $row['alamat'];

    $width = imagesx($img);
    $height = imagesy($img);

    $text_size = imagettfbbox($fontsize, 0, realpath('assets/font/arial.ttf'), $text);

    $text_size2 = imagettfbbox($fontsize, 0, realpath('assets/font/arial.ttf'), $text2);

    $text_size3 = imagettfbbox($fontsize, 0, realpath('assets/font/arial.ttf'), $text3);

    $text_width = max($text_size[2], $text_size[4]) - min($text_size[0], $text_size[6]);
    $text_height = $text_size[5];

    $text_widthh = max([$text_size2[2], $text_size2[4]]) - min([$text_size2[0], $text_size2[6]]);
    $text_heightt = max([$text_size2[1], $text_size2[1]]) - min([$text_size2[0], $text_size2[0]]);

    $centerX = CEIL(($width - $text_width) / 2);
    $centerY = CEIL(($height - $text_height) / 2);

    $centerXX = CEIL(($width - $text_widthh) / 2);
    $centerYY = CEIL(($height - $text_heightt) / 2);

    if ($centerX < 0) {$centerX = 0;}
    if ($centerY < 0) {$centerY = 0;}

    if ($centerXX < 0) {$centerXX = 0;}
    if ($centerYY < 0) {$centerYY = 0;}

    imagettftext($img, $fontsize, 0, 195, 260, $color, realpath('assets/font/arial.ttf'), $text);

    imagettftext($img, $fontsize, 0, 110, 193, $color, realpath('assets/font/arial.ttf'), $text2);

    imagettftext($img, $fontsizee, 0, 85, 320, $color, realpath('assets/font/arial.ttf'), $text3);

    imagejpeg($img, "./assets/templates/foto/temp1.jpg", 100);

    redirect('/user/download');

}

?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->