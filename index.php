<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $token = "QUErSjB0MU5kRERBRGIxQ3N5K2xQSVpSZms5NDZBRDdkdWswK2dWcE42WFR0bFkyWDJGcGlybzcyTDJ0cThDUmZMUTA5NjJ1Wkp4RUFWVkN6eTdwcCtyZjYzcjhsdmtPZGVyQ1RsbnVuZTBES09OejA0YzdwZ1pwMmxWQjRtQy9DOGQyOGZqbUZtdE9IWU1VQkpMUExmZFFSa0g0Z0xsUGI3NEkxV3VUNzVtZ25oQXNhL01WTlZjeE82YVZ1bW1Y";
    $header = array("Authorization: Bearer " . $token);

    $emailpengirim = $_POST["email_pengirim"];
    $emailpenerima = $_POST["email_penerima"];
    $jumlahkirim = $_POST["amount"];
    $catatan = $_POST["catatan"];
    $nama = $_POST["nama_pengirim"];
    $tokenmu = $_POST["token_pengirim"];
    $warnaapk = $_POST["warnaapk"];
    $nama_aplikasi = $_POST["nama_aplikasi"];
    $id_user = $_POST["id_pengirim"];
    $biaya_admin = 0;
    $total_jumlah_kurang = $jumlahkirim + $biaya_admin;

    $post_body_tambah = array(
        "email_user" => $emailpenerima,
        "tipe" => "tambah",
        "jumlah" => $jumlahkirim,
        "catatan_saldo" => "Terima Saldo dari $emailpengirim | Catatan : ( $catatan )",
    );

    $post_body_kurang = array(
        "email_user" => $emailpengirim,
        "tipe" => "kurang",
        "jumlah" => $total_jumlah_kurang,
        "catatan_saldo" => "Kirim Saldo ke $emailpenerima + Biaya Admin Rp 0",
    );

    $ch_tambah = curl_init();
    curl_setopt($ch_tambah, CURLOPT_URL, "https://bukaolshop.net/api/v1/member/saldo");
    curl_setopt($ch_tambah, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch_tambah, CURLOPT_POST, TRUE);
    curl_setopt($ch_tambah, CURLOPT_POSTFIELDS, http_build_query($post_body_tambah));
    curl_setopt($ch_tambah, CURLOPT_RETURNTRANSFER, true);
    $hasil_tambah = curl_exec($ch_tambah);

    if (curl_errno($ch_tambah)) {
        echo 'Error:' . curl_error($ch_tambah);
    }
    curl_close($ch_tambah);

    $ch_kurang = curl_init();
    curl_setopt($ch_kurang, CURLOPT_URL, "https://bukaolshop.net/api/v1/member/saldo");
    curl_setopt($ch_kurang, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch_kurang, CURLOPT_POST, TRUE);
    curl_setopt($ch_kurang, CURLOPT_POSTFIELDS, http_build_query($post_body_kurang));
    curl_setopt($ch_kurang, CURLOPT_RETURNTRANSFER, true);
    $hasil_kurang = curl_exec($ch_kurang);

    if (curl_errno($ch_kurang)) {
        echo 'Error:' . curl_error($ch_kurang);
    }
    curl_close($ch_kurang);

    $respons_tambah = json_decode($hasil_tambah, true);
    $respons_kurang = json_decode($hasil_kurang, true);

    if ($respons_tambah["code"] == 200 && $respons_kurang["code"] == 200) {
        // Saldo berhasil diubah
        echo "<br>";
        echo '<!DOCTYPE html>
<html>
<head>
  <title>Transfer Berhasil</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
 <script src="https://yassgeneret.000webhostapp.com/saldorupiah/saldorupiah.js" type="text/javascript"></script>
 

 
    <style>img[alt="www.000webhost.com"]{display:none;}</style>
<style>
        body{
      background-color: #fff;
      margin: 0;
    }

         .header-roadpedia{
       position:absolute;
       width: 100%;
       background: #1565C0;
       height: 100px;
       top: 0;
       margin-top: 0px;
       padding: 10px;
       z-index: -2;
    }
        
      .box-roadpediamarket{
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        }
     
   .box-roadpediamarket img{
            width: 100px;

        }
        
.box-roadpediamarket p{
    font-size: 14px;
    color: grey;
    margin-bottom: 0px;
}
 
 
    h6 {
      font-size: 14px;
    }
.line {
    position: relative;
    height: 2px;
    width: 100%;
    margin: 12px 0;
    background-color: transparent; /* Menghapus warna latar belakang */
    background-image: linear-gradient(to right, #b7b7b7 50%, transparent 0%);
    background-position: 0 0;
    background-size: 5px 5px; /* Mengatur jarak antara garis putus-putus */
}
.bg-button{
  width: 100%;
  position:fixed;
  height:60px;
  float: left;
  margin: 0 auto;
  border: none;
  background-color: #fff;
  color: white;
  padding: 10px;
  text-align: center;
  border-radius: 0px;
  bottom: 0%;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)}
.button{
  width: 45%;
  position:fixed;
  float: left;
  margin-left: 1%;
  border: none;
  background-color: #1565C0;
  color: white;
  padding: 10px;
  text-align: center;
  border-radius: 5px;
  border: 1px solid #1565C0;
  bottom: 1%;
}
.button-outline{
  width: 45%;
  position:fixed;
  float: left;
  margin-left: 3%;
  border: none;
  background-color: transparent;
  color: black;
  padding: 8px;
  text-align: center;
  border-radius: 5px;
  border: 3px solid #1565C0;
  bottom: 1%;
}
h7{
  font-size:14px;
  color: #747474;
  font-weight: 500;
}
h8{
  font-size:14px;
  color: #0a0a0a;
}
h9{
  font-size:16px;
  color: #000;
  font-weight: bold;
}
.dashed-line {
  width: 100%;
  border-bottom: 2px dashed #ccc; 
  margin: 15px 0; 
}
      .keluar{
  width: 100%;
  border: 1px solid #1565C0;
  color: #00897B;
  font-weight: bold;
  background-color: #fff;
        border-radius: 5px;
        box-shadow: rgb(220, 220, 233)  1px 1px 5px;
}
  .ziz33 {
      border: none;
      border: 2px dashed rgba(0, 0, 0, 0.25);
      margin: 0
    }
  </style>
</head>
          <div class="header-roadpedia">
    <div class="box-roadpediamarket">
    
            <center>
    <img src="https://telegra.ph/file/6ff862b6fec06481b9fba.jpg" alt="" style="width:32%;border-radius:0%;">
              
        </center>
                  <br>
           <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
           
        <h7>'. $nama_aplikasi . '</h7>

          </div>

          <div style="float:right">
              <h7>ID ' . $id_user . ' </h7>
          </div>
          </div>
        <hr style="margin-top:10px;">
        
        <div style="margin-top:-30px;">
            
   <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <br>
 <img src="https://cdn-icons-png.flaticon.com/128/8888/8888205.png" alt="" style="width:15px;margin-left:2%"><h style="font-size:13px;"> Transfer Saldo</h><h5 style="font-size:16px;">Pembayaran ke ' . $emailpenerima . '</h5>

          </div>
          <div style="float:right">
          </div>
          </div>
                                 <div style="display:flex;justify-content:space-between;align-items:center;background-color: #E8F5FE;height:35px;padding-top: 10px">
          <div style="float:left;;margin:5px;">
              <h6 style="font-size: 16px;">Total Bayar:</h6>
          </div>
          
          <div style="float:right;margin:5px;">
              <h6 id="bayar" style="font-size: 16px;color:black;font-weight:500;">Rp' . $total_jumlah_kurang . '</h6>
          </div>
          </div>
          
          <div style="display:flex;justify-content:space-between;align-items:center;">      
          <div style="float:left">
              <h7>Metode Pembayaran:</h7>
          </div>
          
          <div style="float:right">
              <h8>Saldo</h8>
          </div>
          
     </div>
            <hr style="margin-top:10px;">
            <h9>Detail Transaksi</h9>
         <div style="display:flex;justify-content:space-between;align-items:center;">      
          <div style="float:left">
              <h7 onclick="copyContent()">ID Perubahan:</h7> 
          </div>
         <div style="float:right">
<h8>' . $respons_tambah["id_perubahan"] . '</h8>
          </div>
     </div>

              <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <h7>Tujuan:</h7>
          </div>
          
          <div style="float:right">
              <h8>' . $emailpenerima . '</h8>
          </div>
          </div>
          
          
            <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <h7>Saldo Dikirim:</h7>
          </div>
          
          <div style="float:right">
              <h8 id="kirim">' . $jumlahkirim . '</h8>
          </div>
          </div>
         <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
           <h7>Total Bayar:</h7>
          </div>
                              
          <div style="float:right">
              <h8 id="total-bayar">' . $total_jumlah_kurang . '</h8>
                 </div>
          </div>
           <div class="line"></div>
     <h9>Informasi Pengguna</h9>
     
                   <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <h7>Nama Pengguna:</h7>
          </div>
          
          <div style="float:right">
              <h8>' . $nama . '</h8>
          </div>
          </div>
          
                        <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <h7>Token:</h7>
          </div>
          
          <div style="float:right">
              <h8>' . $tokenmu . '</h8>
          </div>
          </div>
          
                        <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="float:left">
              <h7>ID User:</h7>
          </div>
          
          <div style="float:right">
              <h8>' . $id_user . '</h8>
          </div>
          </div>
          
   
        
                                  <div style="display:flex;justify-content:space-between;align-items:center;">

          <div style="float:left">

              <h7>Biaya Admin:</h7>
          </div>
          
          <div style="float:right">
              <h8>Rp 0</h8>
          </div>
          </div>
          
          
    <div class="line"></div>
         
               <center>
                      <font color="ff0000">
<b><p style="font-size: 15px;color: #1565C0;">Transfer saldo Berhasil dilakukan</p></b>
                      
                      
            <a href="https://wiramapayment.olshopku.com//akun/?page=catatan_saldo">
<button class="keluar">CEK RIWAYAT TRANSFER</button></a>
     </a>
    </div>
        </div>
        </div>
   
        </center>

</body>
</html>
';
    } else {
        // Saldo tidak berhasil diubah, menampilkan pesan error
        echo '
       <!DOCTYPE html>
<html lang="in">
<head>
   <body style="background-color:#2196f3;">
    <meta charset="UTF-8">
    <title>Transfer Gagal</title>
    
 <link
   href="https://fonts.googleapis.com/css2?family=Acme&family=Caveat:wght@400;500;600;700&family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,500;1,600;1,700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mochiy+Pop+One&family=Nerko+One&family=Open+Sans:wght@300;400;500;600;700&family=Oswald:wght@200;300;400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Secular+One&display=swap"
  rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- GAMPEDIA X CODINGASIK -->
     
    <style>
    body {
   background-color: blue;
  }
:root {
    --primary-color: #1565C0;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    
}
.box-detail{

 background: white;

 padding: 25px;
 border-radius: 15px;
 margin-top: 15px;
 box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}

detol{
    background: #e10900;
}

    img[alt="www.000webhost.com"] {
        display:none;
      }

    </style>
     
    <script src="https://cdn.jsdelivr.net/gh/danizevaro/javascript@main/style/buyer/rwt.min.js"></script>
</head>
<body>
    <header>
 
 
 
 <section>
     
        <div style="margin-top: 15px;background: white;" class="main-menu">
 
 
 <div style="background: #fff;">
<h4 style="color: #000;  ">Gagal Transfer Saldo</h4>
<h6 style="color: #d21a00;  ">Yahh Saldo Tidak Terkirim.</h6>
</div>
<br><br>
<div class="main-item">
    
     
    <br>
    <img src="https://cdn-icons-png.flaticon.com/512/1304/1304038.png" alt="">
        </div>
       
        
            
          
        
        
          <div class="main-item">
            <p style="font-size: 14px;font-weight: bold;margin-top: 1px;color: orangered;margin-bottom: 0px;">Status Pengirim</p>
   <h6 style="margin-bottom: 0px;font-size: 14px;font-weight: 400;">' . $respons_tambah["status"] . '
   </h6>
  </div>
  <div class="main-item">
            <p style="font-size: 14px;font-weight: bold;margin-top: 1px;color: green;margin-bottom: 0px;  ">Status Penerima</p>
   <h6 style="margin-bottom: 0px;font-size: 14px;font-weight: 400; ">' . $respons_kurang["status"] . '</h6>
  </div>
   
 </div>
    
  
   
          
        </div>
      </div>
 
    </div>
  </div>
   
</body>
</html>
';
    }
} else {
    // Jika bukan metode POST, beri pesan error
    echo "Metode tidak diizinkan.";
}
    ?>
