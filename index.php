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
                  <a class="nav-link btn btn-sm btn-primary" href="javascript:void(0)" onclick="add()">Add</a>
                </li>
              </ul>
              
            </div>
        </nav>
        <div class="container-fluid mt-3">
          <div id="list">

          </div>
        </div>

        <!-- form add  -->
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="formLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="" method="post">
                <input type="hidden" id="id" name="id" value="" />
                <div class="modal-header">
                  <h5 class="modal-title" id="formLabel">Form Siswa</h5>
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

        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detailLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="detailLabel">Form Siswa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="fs-14">
                    <label>Full Name</label> : 
                    <span id="span-fullName"></span>
                  </div>
                  <div class="fs-14">
                    <label>Kelas</label> :
                    <span id="span-kelas"></span>
                  </div>
                  <div class="fs-14">
                    <label>Alamat</label> :
                    <span id="span-alamat"></span>
                  </div>
                  <div class="fs-14">
                    <label>Wali Murid</label> :
                    <span id="span-walimurid"></span>
                  </div>
                  <div class="fs-14">
                    <label>Wali Kelas</label> :
                    <span id="span-walikelas"></span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
                url: "http://localhost:8080/api/siswa",
                method: "GET",
                dataType:'JSON',
                success: function (data) {
                    var list = "";
                    data.forEach(item => {
                      list = list + '<div class="card mr-2" style="width: 18rem;"><div class="card-body"><h5 class="card-title">'+item.fullName+'</h5><p class="card-text"> <br><label>Kelas</label> : '+item.kelas+' <br><label>Alamat</label> : '+item.alamat+' </p><button class="btn btn-warning btn-sm mr-2" onclick="update('+item.id+')">Update</button><button class="btn btn-info btn-sm mr-2" onclick="detail('+item.id+')">Detail</button><button class="btn btn-danger btn-sm" onclic="hapus('+item.id+')">Delete</button></div></div>';
                    });
                    $("#list").html(list);
                }
            });
        });
        function add() {
          document.getElementById("form").reset;
          $("#form").modal("show");
        }
        function save() {
          var id = $("#id").val();
          if (id == '') {
            $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
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
          else
          {
            $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
                url: "http://localhost:8080/api/siswa/"+id,
                method: "PUT",
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
          
        }
        function hapus(id) {
          $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
                url: "http://localhost:8080/api/siswa/"+id,
                method: "DELETE",
                dataType:'JSON',
               
                success: function (data) {
                  location.reload();
                }
            });
        }
        function update(id) {
            $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
                url: "http://localhost:8080/api/siswa/"+id,
                method: "GET",
                dataType:'JSON',
                success: function (data) {
                  document.getElementById("form").reset;
                  $("#id").val(data.id);
                  $("#fullName").val(data.fullName);
                  $("#kelas").val(data.kelas);
                  $("#alamat").val(data.alamat);
                  $("#walimurid").val(data.walimurid);
                  $("#walikelas").val(data.walikelas);
                  $("#form").modal("show");
                }
            });
        }
        function detail(id) {
            $.ajax({
                header:{
                  "Content-Type":"application/json"
                },
                url: "http://localhost:8080/api/siswa/"+id,
                method: "GET",
                dataType:'JSON',
                success: function (data) {
                  $("#span-fullName").html(data.fullName);
                  $("#span-kelas").html(data.kelas);
                  $("#span-alamat").html(data.alamat);
                  $("#span-walimurid").html(data.walimurid);
                  $("#span-walikelas").html(data.walikelas);
                  $("#detail").modal("show");
                }
            });
        }
    </script>
</html>