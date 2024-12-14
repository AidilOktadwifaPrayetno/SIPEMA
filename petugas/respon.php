<div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text" style="font-weight: bold;">Respon</h3>
          </div>
        </div>
		
<!-- Filter Section -->
<div class="row" style="margin-bottom: 20px;">
  <div class="col s12 m4">
    <label for="filterMonth">Filter by Month:</label>
    <select id="filterMonth" class="browser-default">
      <option value="">All Months</option>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
  </div>
  <div class="col s12 m4">
    <label for="filterWeek">Filter by Week:</label>
    <select id="filterWeek" class="browser-default">
      <option value="">All Weeks</option>
      <option value="1">Week 1</option>
      <option value="2">Week 2</option>
      <option value="3">Week 3</option>
      <option value="4">Week 4</option>
    </select>
  </div>

  <!-- Filter by Year -->
  <div class="col s12 m4">
    <label for="filterYear">Filter by Year:</label>
    <select id="filterYear" class="browser-default">
      <option value="">All Years</option>
      <option value="2024">2024</option>
      <option value="2025">2025</option>
      <option value="2026">2026</option>
    </select>
  </div>

  <div class="col s12 m4" style="margin-top: 25px;">
    <button class="btn blue" onclick="applyFilters()">Apply Filters</button>
    <button class="btn green" onclick="resetFilters()">Reset</button>
  </div>
</div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Petugas</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Respon</th>
				<th>Tanggal Respon Lanjut</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan 
		INNER JOIN mahasiswa ON pengaduan.nik=mahasiswa.nim 
		INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan 
		INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas LEFT JOIN tanggapan_lanjut ON pengaduan.id_pengaduan=tanggapan_lanjut.id_pengaduan 
		ORDER BY tanggapan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { 
      $date = new DateTime($r['tgl_pengaduan']);
      ?>
		<tr data-month="<?php echo $date->format('n'); ?>" 
        data-week="<?php echo ceil($date->format('j') / 7); ?>" 
        data-year="<?php echo $date->format('Y'); ?>">
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nim']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['tgl_tanggapan_lanjut'] == null ? 'Belum ada respon lanjut dari petugas' : $r['tgl_tanggapan_lanjut']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn blue modal-trigger" href="#more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Detail</a>
    </td> 

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
			<b>NIM :</b> <?php echo $r['nim']; ?></p>
            	<b>Dari :</b> <?php echo $r['nama']; ?></p>
            	<b>Petugas :</b> <?php echo $r['nama_petugas']; ?></p>
				<b>Tanggal Masuk :</b> <?php echo $r['tgl_pengaduan']; ?></p>
				<b>Tanggal Ditanggapi :</b> <?php echo $r['tgl_tanggapan']; ?></p>
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
				<br><b>Tanggal Respon :</b>
				<p><?php echo $r['tgl_tanggapan'] == null ? 'Belum direspon Petugas' : $r['tgl_tanggapan']; ?></p>
				<br><b>Respon :</b>
				<p><?php echo $r['tanggapan'] == null ? 'Belum direspon Petugas' : $r['tanggapan']; ?></p>
				<br><b>Tanggal Respon Lanjut :</b>
				<p><?php echo $r['tgl_tanggapan_lanjut'] == null ? 'Belum ada respon lanjut dari petugas' : $r['tgl_tanggapan_lanjut']; ?></p>
				<br><b>Respon Lanjut :</b>
				<p><?php echo $r['tanggapan_lanjut'] == null ? 'Belum ada respon lanjut dari petugas' : $r['tanggapan_lanjut']; ?></p>
				
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <script>
  const applyFilters = () => {
    const month = document.getElementById('filterMonth').value;
    const week = document.getElementById('filterWeek').value;
    const rows = document.querySelectorAll('#example tbody tr');
    const year = document.getElementById('filterYear').value;

    rows.forEach(row => {
      const rowMonth = row.getAttribute('data-month');
      const rowWeek = row.getAttribute('data-week');
      const rowYear = row.getAttribute('data-year');

      const monthMatch = !month || rowMonth == month;
      const weekMatch = !week || rowWeek == week;
      const yearMatch = !year || rowYear == year;

      row.style.display = monthMatch && weekMatch && yearMatch ? '' : 'none';
    });
  };

  const resetFilters = () => {
    document.getElementById('filterMonth').value = '';
    document.getElementById('filterWeek').value = '';
    document.getElementById('filterYear').value = '';
    applyFilters();
  };
</script>
