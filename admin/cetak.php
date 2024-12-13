<h1 style="text-align: center;">SIPEMA</h1>
<h2 style="text-align: center;">Laporan Pengaduan Mahasiswa</h2>

<div class="filter-section" style="margin-bottom: 20px; text-align: center;">
  <!-- Filter by Month -->
  <select id="filterMonth" style="padding: 5px; margin-right: 10px;">
    <option value="">Bulan</option>
    <option value="1">Januari</option>
    <option value="2">Februari</option>
    <option value="3">Maret</option>
    <option value="4">April</option>
    <option value="5">Mei</option>
    <option value="6">Juni</option>
    <option value="7">Juli</option>
    <option value="8">Agustus</option>
    <option value="9">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
  </select>

  <!-- Filter by Week -->
  <select id="filterWeek" style="padding: 5px; margin-right: 10px;">
    <option value="">Minggu</option>
    <option value="1">Minggu 1</option>
    <option value="2">Minggu 2</option>
    <option value="3">Minggu 3</option>
    <option value="4">Minggu 4</option>
  </select>
  
  <!-- Filter by year -->
  <select id="filterYear" style="padding: 5px; margin-right: 10px;">
    <option value="">Tahun</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
  </select>

  <button onclick="applyFilters()" style="padding: 5px 10px; background-color: blue; color: white; border: none; cursor: pointer;">Apply Filters</button>
  <button onclick="printReport()" style="padding: 5px 10px; background-color: green; color: white; border: none; cursor: pointer;">Print</button>
</div>

<div id="filter-info" style="text-align: center; margin-bottom: 20px;"></div>

<table id="reportTable" border="2" style="width: 100%; height: 10%; border-collapse: collapse; text-align: center;">
  <thead>
    <tr>
      <td>No</td>
      <td>NIM Pelapor</td>
      <td>Nama Pelapor</td>
      <td>Tanggal Masuk</td>
      <td>Isi Laporan</td>
	  <td>Foto</td>
	  <td>Nama Petugas</td>
      <td>Respon Petugas</td>
      <td>Tanggal Respon</td>
      <td>Respon lanjut</td>
      <td>Tanggal Respon Lanjut</td>
      <td>Status</td>
    </tr>
  </thead>
  <tbody>
    <?php 
      include '../conn/koneksi.php';
      $no = 1;
      $query = mysqli_query($koneksi, "SELECT * FROM pengaduan 
        INNER JOIN mahasiswa ON pengaduan.nik = mahasiswa.nim 
        LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan 
        LEFT JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas 
        LEFT JOIN tanggapan_lanjut ON tanggapan_lanjut.id_pengaduan = pengaduan.id_pengaduan
        ORDER BY tgl_pengaduan DESC");
      while ($r = mysqli_fetch_assoc($query)) { ?>
      <tr data-date="<?php echo $r['tgl_pengaduan']; ?>">
        <td><?php echo $no++; ?></td>
        <td><?php echo $r['nim']; ?></td>
        <td><?php echo $r['nama']; ?></td>
        <td><?php echo $r['tgl_pengaduan']; ?></td>
        <td><?php echo $r['isi_laporan']; ?></td>
		<td><?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?></td>
		<td><?php echo $r['nama_petugas'] == null ? 'Belum direspon Petugas' : $r['nama_petugas']; ?></td>
        <td><?php echo $r['tanggapan'] == null ? 'Belum direspon Petugas' : $r['tanggapan']; ?></td>
        <td><?php echo $r['tgl_tanggapan'] == null ? 'Belum direspon Petugas' : $r['tgl_tanggapan']; ?></td>
        <td><?php echo $r['tanggapan_lanjut'] == null ? 'Belum ada respon lanjut dari petugas' : $r['tanggapan_lanjut']; ?></td>
        <td><?php echo $r['tgl_tanggapan_lanjut'] == null ? 'Belum ada respon lanjut dari petugas' : $r['tgl_tanggapan_lanjut'] ; ?></td>
        <td><?php echo $r['status']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  const applyFilters = () => {
    const month = document.getElementById('filterMonth').value;
    const week = document.getElementById('filterWeek').value;
    const year = document.getElementById('filterYear').value;
    const rows = document.querySelectorAll('#reportTable tbody tr');

    rows.forEach(row => {
      const date = new Date(row.getAttribute('data-date'));
      const rowMonth = date.getMonth() + 1;
      const rowWeek = Math.ceil(date.getDate() / 7);
      const rowYear = date.getFullYear();

      const monthMatch = !month || rowMonth == month;
      const weekMatch = !week || rowWeek == week;
      const yearMatch = !year || rowYear == year;

      row.style.display = monthMatch && weekMatch && yearMatch ? '' : 'none';
    });

    const filterInfo = document.getElementById('filter-info');
    const monthText = month ? `Bulan ${document.getElementById('filterMonth').options[document.getElementById('filterMonth').selectedIndex].text}` : 'Semua Bulan';
    const weekText = week ? `Minggu ${week}` : 'Semua Minggu';
    const yearText = year ? `Tahun ${year}` : 'Semua Tahun';
    filterInfo.innerText = `Laporan untuk ${monthText}, ${weekText}, ${yearText}`;
  };

  const printReport = () => {
    const filterSection = document.querySelector('.filter-section');
    filterSection.style.display = 'none';
    window.print();
    filterSection.style.display = 'block';
  };
</script>
