<?php

class M_penerimaan extends CI_Model
{
	function tampil_data()
	{
		$this->db->select('*');
		$this->db->from('penerimaan');
		$this->db->order_by('id', 'DESC');

		$tanggal = $this->input->post('tanggal', true);
		$tanggalSampai = $this->input->post('tanggal_sampai', true);
		if (isset($tanggal) && isset($tanggalSampai)) {
			$this->db->where('tanggal >=', $tanggal);
			$this->db->where('tanggal <=', $tanggalSampai);
		}
		return $this->db->get();
	}

	function tampil_data_item($idPenerimaan)
	{
		$this->db->select('*');
		$this->db->from('penerimaan_item');
		$this->db->where('penerimaan_id', $idPenerimaan);

		return $this->db->get()->result_array();
	}

	function tampil_data_akun()
	{
		$hasil = $this->db->query("SELECT * FROM akun_pembayaran");
		return $hasil;
	}

	function get_option()
	{
		$this->db->select('*');
		$this->db->from('akun_pembayaran');
		$query = $this->db->get();
		return $query->result();
	}

	function tampil_supplier()
	{
		$hasil = $this->db->query("SELECT * FROM supplier");
		return $hasil;
	}

	function tampil_barang()
	{
		$hasil = $this->db->query("SELECT * FROM produk");
		return $hasil;
	}

	function tampil_total_qty()
	{
		$this->db->select('COALESCE(SUM(total_qty), 0) AS sum_total_qty', FALSE);
		$this->db->from('penerimaan');

		$tanggal = $this->input->post('tanggal', true);
		$tanggalSampai = $this->input->post('tanggal_sampai', true);
		if (isset($tanggal) && isset($tanggalSampai)) {
			$this->db->where('tanggal >=', $tanggal);
			$this->db->where('tanggal <=', $tanggalSampai);
		}

		return $this->db->get();
	}

	function tampil_total_harga()
	{
		$this->db->select('COALESCE(SUM(harga), 0) AS sum_total_harga', FALSE);
		$this->db->from('penerimaan');

		$tanggal = $this->input->post('tanggal', true);
		$tanggalSampai = $this->input->post('tanggal_sampai', true);
		if (isset($tanggal) && isset($tanggalSampai)) {
			$this->db->where('tanggal >=', $tanggal);
			$this->db->where('tanggal <=', $tanggalSampai);
		}

		return $this->db->get();
	}

	function tampil_cetak()
	{
		$this->db->select('*');
		$this->db->from('penerimaan');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function tampil()
	{
		$hasil = $this->db->query("SELECT * FROM `penerimaan` ORDER BY id DESC  LIMIT 1");
		return $hasil;
	}
	public function kode1()
	{
		$this->db->select('RIGHT(penerimaan.no_lpb,2) as no_lpb', FALSE);
		$this->db->order_by('no_lpb', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('penerimaan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia    
			$data = $query->row();
			$kode = intval($data->no_lpb) + 1;
		} else {
			$kode = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('d');
		$batas = str_pad($kode, 4, "LPB", STR_PAD_LEFT);
		$kodetampil = "" . "" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function tampil_datamitra()
	{
		$hasil = $this->db->query("SELECT * FROM daftarmitra");
		return $hasil;
	}

	public function tambahDataPenerimaan($dataPenerimaan, $dataPenerimaanItem)
	{
		$this->db->insert('penerimaan', $dataPenerimaan);
		$penerimaanId = $this->db->insert_id();
		$totalHarga = 0;
		for ($i = 0; $i < count($dataPenerimaanItem['kode']); $i++) {
			$item = [
				"kode" => $dataPenerimaanItem['kode'][$i],
				"nama" => $dataPenerimaanItem['nama'][$i],
				"qty" => $dataPenerimaanItem['qty'][$i],
				"isi_karton" => $dataPenerimaanItem['isi_karton'][$i],
				"total_qty" => $dataPenerimaanItem['total_qty'][$i],
				"harga" => $dataPenerimaanItem['harga'][$i],
				"total_harga" => $dataPenerimaanItem['total_harga'][$i],
				"penerimaan_id" => $penerimaanId,
			];

			$totalHarga += $item['total_harga'];
			$this->db->insert('penerimaan_item', $item);
		}

		$this->db->where('id', $penerimaanId);
		$this->db->update('penerimaan', [
			"total_harga" => $totalHarga
		]);
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function input_data_akun($data, $table)
	{
		$this->db->insert($table, $data);
	}


	public function getPenerimaanById($id)
	{
		return $this->db->get_where('penerimaan', ['id' => $id])->row_array();
	}
	public function hapusDataPenerimaan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('penerimaan');
	}

	function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ubahDataPenerimaan($dataPenerimaan, $dataPenerimaanItem)
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('penerimaan', $dataPenerimaan);
		$totalHarga = 0;

		$this->db->where('penerimaan_id', $this->input->post('id'));
		$this->db->delete('penerimaan_item');
		for ($i = 0; $i < count($dataPenerimaanItem['kode']); $i++) {
			$item = [
				"kode" => $dataPenerimaanItem['kode'][$i],
				"nama" => $dataPenerimaanItem['nama'][$i],
				"qty" => $dataPenerimaanItem['qty'][$i],
				"isi_karton" => $dataPenerimaanItem['isi_karton'][$i],
				"total_qty" => $dataPenerimaanItem['total_qty'][$i],
				"harga" => $dataPenerimaanItem['harga'][$i],
				"total_harga" => $dataPenerimaanItem['total_harga'][$i],
				"penerimaan_id" => $this->input->post('id'),
			];

			$totalHarga += $item['total_harga'];
			$this->db->where('penerimaan_id', $this->input->post('id'));
			$this->db->insert('penerimaan_item', $item);
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('penerimaan', [
			"total_harga" => $totalHarga
		]);
	}

	public function cariDataKaryawan()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama', $keyword);
		$this->db->or_like('jabatan', $keyword);
		$this->db->or_like('alamat', $keyword);
		return $this->db->get('penerimaan')->result_array();
	}
}
