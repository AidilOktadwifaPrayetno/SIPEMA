        <div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text" style="font-weight: bold;">DAFTAR MAHASISWA</h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1"><i class="material-icons">add</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
					<th>No</th>
					<th>NIM</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Telp</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM mahasiswa ORDER BY nim ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nim']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp']; ?></td>
			<td><a class="btn teal modal-trigger" href="#regis_edit?nim=<?php echo $r['nim'] ?>">Edit</a> <a onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" class="btn red" href="index.php?p=regis_hapus&nim=<?php echo $r['nim'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="regis_edit?nim=<?php echo $r['nim'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nim">NIM</label>
					<input id="nim" type="number" name="nim" value="<?php echo $r['nim']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// Check if data already exists
					$checkQuery = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='".$_POST['nim']."' OR username='".$_POST['username']."' AND nim != '".$r['nim']."'");
					if(mysqli_num_rows($checkQuery) > 0){
						echo "<script>alert('Ada data yang sama'); location='index.php?p=mahasiswa';</script>";
					} else {
						$update=mysqli_query($koneksi,"UPDATE mahasiswa SET nim='".$_POST['nim']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nim='".$r['nim']."' ");
						if($update){
							echo "<script>alert('Data Tersimpan'); location='index.php?p=mahasiswa';</script>";
						}
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nim">NIM</label>
					<input id="nim" type="number" name="nim">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
					$password = $_POST['password'];

					// Check if data already exists
					$checkQuery = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='".$_POST['nim']."' OR username='".$_POST['username']."'");
					if(mysqli_num_rows($checkQuery) > 0){
						echo "<script>alert('Data sudah ada')</script>";
					} else {
						$query=mysqli_query($koneksi,"INSERT INTO mahasiswa VALUES ('".$_POST['nim']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
						if($query){
							echo "<script>alert('Data Tersimpan')</script>";
							echo "<script>location='location:index.php?p=registrasi';</script>";
						}
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>