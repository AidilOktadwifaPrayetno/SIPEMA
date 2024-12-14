<?php
require_once '../conn/koneksi.php';
session_start();
?>

<table class="responsive-table" border="1" style="width: 100%;">
	<tr>
		<td><h4 class="orange-text" style="font-weight: bold;">PROFILE</h4></td>
		
	</tr>
	<tr>
		<td>
			
			<table border="3" class="responsive-table striped highlight">
				<tr>
					<td>NIM</td>
					<td>Nama</td>
                    <td>No Telp</td>
					<td>Username</td>
                    <td>Password</td>
                    <td>Opsi</td>
				</tr>
				<?php 
					$no=1;
                    $query = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE nim='".$_SESSION['data']['nim']."'");
                    while ($r=mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td><?php echo $r['nim']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['telp']; ?></td>
						<td><?php echo $r['username']; ?></td>
						<td><?php echo $r['password'] == 'kosong' ? 'kosong' : '******';  ?></td>
						<td>
                            <a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Edit</a> 
                           
 <!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
                <form method="POST">
                    <label>Nama :</label>
                    <input type="text" name="nama" value="<?php echo $r['nama']; ?>">
                    <label>No Telp :</label>
                    <input type="text" name="telp" value="<?php echo $r['telp']; ?>">
                    <label>Username :</label>
                    <input type="text" name="username" value="<?php echo $r['username']; ?>">
                    <label>Password :</label>
                    <input type="text" name="password" value="<?php echo $r['password']; ?>">
                    <input type="submit" name="edit" value="Edit" class="btn left">
                </form>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table>
<?php 
	
	 if(isset($_POST['edit'])){
	 	$nim = $_SESSION['data']['nim'];
	 	$nama = $_POST['nama'];
	 	$telp = $_POST['telp'];
	 	$username = $_POST['username'];
	 	$password = $_POST['password'];

	 	$query = mysqli_query($koneksi,"UPDATE mahasiswa SET nama='$nama', telp='$telp', username='$username', password='$password' WHERE nim='$nim'");

	 	if($query){
	 		echo "<script>alert('Data Mahasiswa Telah Diubah')</script>";
	 		echo "<script>location='index.php?p=dashboard';</script>";
	 	}
	 }

 ?>


