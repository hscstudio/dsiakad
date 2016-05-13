<?php
/**
 * Created by PhpStorm.
 * User: hafid
 * Date: 5/13/2016
 * Time: 5:16 PM
 */

//print_r($mahasiswa);
?>
<table class="table table-condensed">
	<tr><th style="width:150px;">Nama</th><td><?= $mahasiswa->name ?></td></tr>
	<tr><th>NIM</th><td><?= $mahasiswa->nim ?></td></tr>
	<tr><th>JURUSAN</th><td><?= $mahasiswa->jurusan->name ?></td></tr>
	<tr><th>IJAZAH</th><td><?= $nilai->ijazah ?></td></tr>
	<tr><th>SKRIPSI</th><td><?= $nilai->skripsi ?></td></tr>
	<tr><th>TOTAL SKS</th><td><?= $nilai->sks ?></td></tr>
	<tr><th>TOTAL NILAI</th><td><?= $nilai->nilai ?></td></tr>
</table>

<table class="table table-condensed table-bordered">
	<tr>
		<th>NO</th>
		<th>MATA KULIAH</th>
		<th>SKS</th>
		<th>NILAI</th>
		<th>TOTAL</th>
	</tr>
<?php
$no = 1;
$sks = 0;
$nilai = 0;
$sub_total = 0;
foreach ($studis as $studi){
	$sks += $studi->matakuliah->sks;
	$nilai += $studi->nilai;
	$sub_total += ($studi->matakuliah->sks * $studi->nilai);
	?>
	<tr>
		<td><?= $no++; ?></td>
		<td><?= $studi->matakuliah->name; ?></td>
		<td><?= $studi->matakuliah->sks; ?></td>
		<td><?= $studi->nilai; ?></td>
		<td><?= $studi->matakuliah->sks*$studi->nilai; ?></td>
	</tr>
	<?php
}
?>
	<tr>
		<td></td>
		<td>TOTAL</td>
		<td><?= $sks; ?></td>
		<td><?= $nilai; ?></td>
		<td><?= $sub_total; ?></td>
	</tr>
</table>
