<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SEKOLAH</title>

        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">

        <script src="./assets/js/jquery-3.7.1.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">SEKOLAH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-sm btn-primary" href="javascript:void()" data-toggle="modal" data-target="#formadd">Add</a>
                </li>
              </ul>
              
            </div>
        </nav>
        <div class="container-fluid mt-3">
          <div id="list">

          </div>
        </div>

        <!-- form add  -->
        <div class="modal fade" id="formadd" tabindex="-1" role="dialog" aria-labelledby="formaddLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="" method="post">
                <div class="modal-header">
                  <h5 class="modal-title" id="formaddLabel">Add Siswa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" aria-describedby="fullName" placeholder="Full Name">
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" aria-describedby="kelas" placeholder="Kelas">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="alamat" placeholder="Alamat">
                  </div>
                  <div class="form-group">
                    <label for="walimurid">Wali Murid</label>
                    <input type="text" class="form-control" id="walimurid" name="walimurid" aria-describedby="walimurid" placeholder="Wali Murid">
                  </div>
                  <div class="form-group">
                    <label for="walikelas">Wali Kelas</label>
                    <input type="text" class="form-control" id="walikelas" name="walikelas" aria-describedby="walikelas" placeholder="Wali Kelas">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "http://localhost:8080/api/siswa",
                method: "GET",
                success: function (data) {
                    var list = "";
                    data.forEach(item => {
                      list = list + '<div class="card mr-2" style="width: 18rem;"><div class="card-body"><h5 class="card-title">'+item.fullName+'</h5><p class="card-text"> <br><label>Kelas</label> : '+item.kelas+' <br><label>Alamat</label> : '+item.alamat+' </p><a href="javascript:void()" class="card-link">Update</a><a href="javascript:void()" class="card-link">Delete</a></div></div>';
                    });
                    $("#list").html(list);
                }
            });
        });
        function save() {
          $.ajax({
                url: "http://localhost:8080/api/siswa",
                method: "POST",
                dataType:'JSON',
                data: {
                  "fullName":$("#fullName").val(),
                  "kelas":$("#kelas").val(),
                  "alamat":$("#alamat").val(),
                  "walimurid":$("#walimurid").val(),
                  "walikelas":$("#walikelas").val()
                },
                success: function (data) {
                  location.reload();
                }
            });
        }
    </script>
</html>