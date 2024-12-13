<table class="responsive-table" border="1" style="width: 100%;">
	<tr>
		<td><h4 class="orange-text hide-on-med-and-down">Daftar Laporan</h4></td>
		
	</tr>
	<tr>
		<td>
			
			<table border="3" class="responsive-table striped highlight">
				<tr>
					<td>No</td>
					<td>NIM</td>
					<td>Nama</td>
					<td>Tanggal Masuk</td>
					<td>Isi Laporan</td>
					<td>Foto</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN mahasiswa ON pengaduan.nik=mahasiswa.nim LEFT JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan LEFT JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas LEFT JOIN tanggapan_lanjut ON pengaduan.id_pengaduan=tanggapan_lanjut.id_pengaduan  WHERE pengaduan.nik='".$_SESSION['data']['nim']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nim']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['isi_laporan']; ?></td>
						<td><?php 
								if($r['foto']=="kosong"){ ?>
								<b>Tidak Ada Foto</b>
							<?php	}else{ ?>
								<img width="100" src="../img/<?php echo $r['foto']; ?>">
							<?php }
								 ?>   </td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Detail</a> 
							<!-- <a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a></td> -->
<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
				<b>NIM : </b><?php echo $r['nim']; ?></p>
            	<b>Dari : </b><?php echo $r['nama']; ?></p>
            	<b>Petugas : </b><?php echo $r['nama_petugas']; ?></p>
				<b>Tanggal Masuk : </b><?php echo $r['tgl_pengaduan']; ?></p>
				<?php if($r['status'] == 'PROSES') { ?>
					<b>Tanggal Ditanggapi : </b><?php echo $r['tgl_tanggapan']; ?></p>
				<?php } elseif($r['status'] == 'SELESAI') { ?>
					<b>Tanggal Ditanggapi : </b><?php echo $r['tgl_tanggapan_lanjut']; ?></p>
				<?php } else { ?>
					<b>Tanggal Ditanggapi : </b>Tidak Ada</p>
				<?php } ?>
				<br><b>Foto :</b>
				<br>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan :</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<br><b>Respon :</b>
				<p><?php echo $r['tanggapan']; ?></p>
				<br><b>Respon Lanjut :</b>
				<p><?php echo $r['tanggapan_lanjut']; ?></p>

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
	
	 if(isset($_POST['kirim'])){
	 	$nim = $_SESSION['data']['nim'];
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
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nim','".$_POST['laporan']."','$nama','KONFIRMASI')");

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
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nim','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>