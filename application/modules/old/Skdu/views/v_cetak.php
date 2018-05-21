

<?php 
	/*parameter */
	if ($dataD['vSkduNo']<>'') {
		$nom = $dataD['vSkduNo'];	
	}else{
		$nom = '.....';
	}
	
 ?>


<style type="text/css">
	#outer {
	  width: 100%;
	  text-align: center;
	}

	#inner {
	  display: inline-block;
	  text-decoration: underline;
	  font-size: 24px;
	}

</style>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div id="outer">  
	  <div id="inner">SURAT KETERANGAN</div>
	  Nomor : 503 /<?php echo $nom ?> -YANUM / 2018
	</div>

	<p>
		Camat Pinang Kota Tangerang, menerangkan bahwa 
	</p>
	<table style="margin-left: 5%;">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><b><?php echo $dataD['vPengNama'] ?></b></td>
		</tr>
		<tr>
			<td>NIK</td>
			<td>:</td>
			<td><b><?php echo $dataD['vPengNik'] ?></b></td>
		</tr>
		<tr>
			<td>Tempat / Tgl Lahir</td>
			<td>:</td>
			<td><?php echo $dataD['vPengTempat'] ?>, <?php echo $controller->tanggal_indo($dataD['dPengLahir']); ?></td>
		</tr>
		<tr>
			<td>Pekerjaan</td>
			<td>:</td>
			<td><?php echo $dataD['vPengKerja'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><p><?php echo $dataD['vPengAlamat'] ?></p></td>
		</tr>
	</table>
	
	<p  align='justify'> Benar nama tersebut diatas saat ini membuka / mempunyai usaha / Perusahaan, berdasarkan Surat Keterangan dari <?php echo $dataD['vRefDari'] ?> Nomor : <?php echo $dataD['vRefNo'] ?> dengan keterangan sebagai berikut  :
	</p>

	<table style="margin-left: 5%;">
		<tr>
			<td>Nama Usaha</td>
			<td>:</td>
			<td><b><?php echo '"'.$dataD['vUsName'].'"' ?></td>
		</tr>
		<tr>
			<td>Jenis Usaha</td>
			<td>:</td>
			<td><?php echo $dataD['vUsJenis'] ?></td>
		</tr>
		<tr>
			<td>Bentuk Usaha</td>
			<td>:</td>
			<td><?php echo $dataD['vUsBentuk'] ?></td>
		</tr>
		<tr>
			<td>Alamat Usaha</td>
			<td>:</td>
			<td><p><?php echo $dataD['vUsAlamat'] ?></p></td>
		</tr>
		<tr>
			<td>Jumlah Karyawan</td>
			<td>:</td>
			<!-- <td><?php echo $dataD['iUsKaryawan'] ?> (<?php echo $terbilang ?>) Orang</td> -->
			<td><?php echo $dataD['iUsKaryawan'] ?> (<?php echo $terbilang ?>) Orang</td>
		</tr>
	</table>
	

	<p align='justify'> Demikian Surat Keterangan Domisili Usaha ini dibuat untuk dipergunakan sebagaimana mestinya dan berlaku sampai dengan tanggal <span style="text-decoration: underline;"><b><?php echo $controller->tanggal_indo($dataD['dTglExpired']); ?></b></span> , apabila dikemudian hari keterangan pengakuan yang bersangkutan tidak benar / kadaluarsa dan atau usahanya tidak benar / melanggar hukum dan peruntukannya menimbulkan gangguan pencemaran lingkungan / keresahan / keberatan masyarakat sekitar maka sepenuhnya menjadi tanggung jawab yang bersangkutan tanpa melibatkan aparat kecamatan yang menandatangani, dan Surat Keterangan Domisili Usaha ini dinyatakan tidak berlaku.</p>


	<br>
	<br>
	<div  align="right" style="margin-right: 13%;">Tangerang, <?php echo $controller->tanggal_indo($dataD['dTglBuat']); ?></div>
	<style type="text/css">
		#kiri
		{
			width:50%;
			height:100px;
			/*background-color:#FF0;*/
			float:left;
			text-align: center;
		}
		#kanan
		{
			width:50%;
			height:100px;
			/*background-color:#0C0;*/
			float:right;
			text-align: center;
		}
	</style>

	<div id="kiri">
			Tanda Tangan Ybs
			<?php 
				if ($dataD['iCamat']==1) {

				}else{
					echo "<br>";
				}
			 ?>

			<br>
			<br>
			<br>
			<br>
			<span style="text-decoration: underline;"><b><?php echo $dataD['vPengNama'] ?></b></span> 
	</div>
	<div id="kanan">
		<?php 
			if ($dataD['iCamat']==1) {
				echo "<b>CAMAT PINANG</b>";

			}else{
				echo "<b>A.n.CAMAT PINANG</b>";
				echo "<br>";
				echo '<b>'.$dataD['vDescription'].'</b>';
			}
		 ?>
		
		<br>
		<br>
		<br>
		<br>
		<span style="text-decoration: underline;"><b><?php echo $dataD['vPejabatName'] ?></b></span>
		<br>
		<b><?php echo $dataD['cNip'] ?></b>
	</div>
	
