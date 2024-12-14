<table class="responsive-table" border="1" style="width: 100%;">
	<tr>
		<td><h4 class="orange-text" style="font-weight: bold;">TAMBAH PENGADUAN</h4></td>
		
	</tr>
	<tr>
		<td style="padding: 20px;">
			<form method="POST" enctype="multipart/form-data">
				<b>Laporan :</b>
				<textarea class="materialize-textarea" name="laporan" required placeholder="Tulis Laporan"></textarea><br><br>
				<b>Bukti Foto :</b>
				<br>
				<p style="color: red;">Bukti Foto harus berukuran 500KB dalam format jpg, png, atau jpeg !</p>
				<input type="file" name="foto" required><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn">
			</form>
		</td>

		
	</tr>
</table>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nim'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=500000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','$nama','KONFIRMASI')");

		 			if($query){
			 			echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Akuran Gambar Tidak Lebih Dari 500KB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','noImage.png','KONFIRMASI')");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>