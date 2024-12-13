<?php
require_once '../conn/koneksi.php';
?>

<table class="responsive-table" border="1" style="width: 100%;">
	<tr>
		<td><h4 class="orange-text hide-on-med-and-down">Profile</h4></td>
		
	</tr>
	<tr>
		<td>
			
			<table border="3" class="responsive-table striped highlight">
				<tr>
					<td>ID Petugas</td>
					<td>Nama Petugas</td>
                    <td>No Telp</td>
					<td>Username</td>
                    <td>Password</td>
                    <td>Opsi</td>
				</tr>
				<?php 
					$no=1;
                    $query = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
                    while ($r=mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td><?php echo $r['id_petugas']; ?></td>
						<td><?php echo $r['nama_petugas']; ?></td>
						<td><?php echo $r['telp_petugas']; ?></td>
						<td><?php echo $r['username']; ?></td>
						<td><?php echo $r['password'] == 'kosong' ? 'kosong' : '******';  ?></td>
						<td>
                            <a class="btn blue modal-trigger" href="#tanggapan&id_petugas=<?php echo $r['id_petugas'] ?>">Edit</a> 
                           
 <!-- ditanggapi -->
        <div id="tanggapan&id_petugas=<?php echo $r['id_petugas'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
                <form method="POST">
                    <label>Nama :</label>
                    <input type="text" name="nama_petugas" value="<?php echo $r['nama_petugas']; ?>">
                    <label>No Telp :</label>
                    <input type="text" name="telp_petugas" value="<?php echo $r['telp_petugas']; ?>">
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
	 	$id_petugas = $_SESSION['data']['id_petugas'];
	 	$nama_petugas = $_POST['nama_petugas'];
	 	$telp = $_POST['telp_petugas'];
	 	$username = $_POST['username'];
	 	$password = $_POST['password'];

	 	$query = mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='$nama_petugas', telp_petugas='$telp', username='$username', password='$password' WHERE id_petugas='$id_petugas'");

	 	if($query){
	 		echo "<script>alert('Data Petugas Telah Diubah')</script>";
	 		echo "<script>location='index.php?p=dashboard';</script>";
	 	}
	 }

 ?>
