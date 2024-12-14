<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "admin"){
		header('location:../index.php');
	}
 ?>
  <!DOCTYPE html>
  <html>
    <head>
    	<title>Aplikasi Pengaduan mahasiswa</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      
      
      <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );
      
      </script>

    </head>

    <body style="background:url(../img/.jpg); background-size: cover;">

    <div class="row">
      <div class="col s12 m3">
          <ul id="slide-out" class="sidenav sidenav-fixed">
			<style>
				.sidenav-fixed{
					background-color: #000000;
					color: #ffffff;
				}
				.sidenav-fixed li i{
					color: #ffffff;
				}
				.sidenav-fixed li a:hover{
					background-color: #ff7043;
					color: #ffffff;
					font-weight: bold;
					font-size: 16px;
					margin-left: 10px;
					margin-right: 10px;
					padding: 10px;
					border-radius: 10px;
					text-align: center;
					display: flex;
					align-items: center;
					justify-content: center;
					text-decoration: none;
					text-transform: uppercase;
					margin-bottom: 10px;
					margin-top: 10px;
					transition: all 0.3s ease;
					cursor: pointer;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				}
				.sidenav-fixed li a{
					color: #ffffff;
					font-weight: bold;
				}
			</style>
              <li>
                  <div class="user-view">
                      <div style="display: flex; align-items: center; justify-content:  margin: 10px;">
                        <a href="index.php?p=dashboard"><img class="circle" src="../img/logo.png"></a>
                        <span style="font-size: 20px; font-weight: bold; margin-left: 10px;">SIPEMA</span>
                      </div>
                      <a href="index.php?p=profile"><span class="orange-text name"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></span></a>
                  </div>
              </li>
              <li><a href="index.php?p=dashboard"><i class="material-icons" style="color: #ffffff;">dashboard</i>Dashboard</a></li>
              <li><a href="index.php?p=mahasiswa"><i class="material-icons" style="color: #ffffff;">featured_play_list</i>Daftar Mahasiswa</a></li>
              <li><a href="index.php?p=pengaduan"><i class="material-icons" style="color: #ffffff;">report</i>Pengaduan Baru</a></li>
              <li><a href="index.php?p=proses"><i class="material-icons" style="color: #ffffff;">report_problem</i>Pengaduan Proses</a></li>
              <li><a href="index.php?p=selesai"><i class="material-icons" style="color: #ffffff;">check_circle</i>Pengaduan Selesai</a></li>
              <li><a href="index.php?p=respon"><i class="material-icons" style="color: #ffffff;">question_answer</i>Respon</a></li>
              <li><a href="index.php?p=user"><i class="material-icons" style="color: #ffffff;">account_box</i>Daftar Petugas</a></li>
              <li><a href="index.php?p=laporan"><i class="material-icons" style="color: #ffffff;">book</i>Laporan</a></li>
              <li>
                  <div class="divider"></div>
              </li>
			  <li><a class="waves-effect" href="index.php?p=profile"><i class="material-icons" style="color: #ffffff;">account_circle</i>Profile</a></li>
              <li><a class="waves-effect" href="../index.php?p=logout"><i class="material-icons" style="color: #ffffff;">logout</i>Logout</a></li>
          </ul>

          <a href="#" data-target="slide-out" class="btn sidenav-trigger"><i class="material-icons" style="color: #ffffff;">menu</i></a>
      </div>

      <div class="col s12 m9">
        
	<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="mahasiswa"){
			include_once 'mahasiswa.php';
		}
		elseif(@$_GET['p']=="mahasiswa_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE nim='".$_GET['nim']."'");
			if($query){
				header('location:index.php?p=mahasiswa');
			}
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
		if($data['status']=="KONFIRMASI"){
			$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			header('location:index.php?p=pengaduan');
		}
		elseif($data['status']=="PROSES"){
			$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			header('location:index.php?p=pengaduan');
		}
		elseif($data['status']=="SELESAI"){
			$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			if($delete){
				$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}	
		}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="proses"){
			include_once 'proses.php';
		}
		elseif(@$_GET['p']=="selesai"){
			include_once 'selesai.php';
		}

		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=respon');
			}
		}
		elseif(@$_GET['p']=="user"){
			include_once 'user.php';
		}
		elseif(@$_GET['p']=="user_input"){
			include_once 'user_input.php';
		}
		elseif(@$_GET['p']=="user_edit"){
			include_once 'user_edit.php';
		}
		elseif(@$_GET['p']=="user_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='".$_GET['id_petugas']."'");
			if($query){
				header('location:index.php?p=user');
			}
		}
		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
		elseif(@$_GET['p']=="profile"){
			include_once 'profile.php';
		}
	 ?>

      </div>


    </div>




      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });

      </script>

    </body>
  </html>