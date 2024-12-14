<h3 class="orange-text" style = "font-weight: bold;">Dahsboard</h3>

	<div class="row">
	<div class="col s4">
		  <div class="card orange">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title">Pengaduan Masuk<b class="right"><?php echo $jlmmember; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>

		<div class="col s4">
		  <div class="card red">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='KONFIRMASI'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title white-text"> <a href="index.php?p=pengaduan">Pengaduan Baru<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>
		
		<div class="col s4">
		  <div class="card red">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='proses'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title white-text"> <a href="index.php?p=proses">Pengaduan Proses<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>	

		<div class="col s4">
		  <div class="card teal">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='SELESAI'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title white-text"> <a href="index.php?p=selesai">Pengaduan Selesai<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>

		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM tanggapan WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title white-text"> <a href="index.php?p=respon">Respon<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>
	</div>

	<style>
		.card a{
			color: white;
		}
	</style>