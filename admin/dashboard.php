
<h3 class="orange-text" style="font-weight: bold;">DASHBOARD</h3>

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
		      <span class="card-title">Pengaduan Masuk<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>	

		<div class="col s4">
		    <div class="card red">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='konfirmasi'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title"> <a href="index.php?p=pengaduan" style="color: white;">Pengaduan Baru <b class="right"><?php echo $jlmmember; ?></b></a></span>
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
		      <span class="card-title"> <a href="index.php?p=proses" style="color: white;">Pengaduan Proses <b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>

		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title"> <a href="index.php?p=selesai" style="color: white;">Pengaduan Selesai <b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>

		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM tanggapan");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title white-text"> <a href="index.php?p=respon" style="color: white;">Respon<b class="right"><?php echo $jlmmember; ?></b></a></span>
		      <p></p>
		    </div>
		  </div>
		</div>
	</div>