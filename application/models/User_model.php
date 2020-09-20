<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
	public function getUser()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `users`
					WHERE `user` = '$user'
					";
		return $this->db->query($query)->row_array();
	}

	public function getTrackings($jenis, $offset, $limit)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = '$jenis'
					ORDER BY `id_tracking` DESC
					LIMIT $offset, $limit
					";
		return $this->db->query($query)->result_array();
	}

	public function getRKSPs1()
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = 'rksp'
					AND `next` = 'Y'
					";
		return $this->db->query($query)->result_array();
	}

	public function numTrackings($jenis)
	{
		$user = $this->session->userdata('user');

		$query = "SELECT *
					FROM `tracking`
					WHERE `user` = '$user'
					AND `jenis` = '$jenis'
					";
		return $this->db->query($query)->num_rows();
	}

	public function insertRKSP($data)
	{
		$ref = $data['ref'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$eta = $data['eta'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query1 = "SELECT *
					FROM `tracking`
					WHERE `nomor` = '$nomor'
					AND `jenis` = 'rksp'
					";
		$result1 = $this->db->query($query1)->num_rows();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`eta`,`user`,`name`,`stamp`)
					VALUES ('$ref','rksp','$nomor',$doc_date,$eta,'$user','$name',$stamp)
					";
		
		if ($result1 == 0) {
			$this->db->query($query2);
			return "<div class='alert alert-success' role='alert'>RKSP berhasil ditambahkan</div>";
		} else {
			return "<div class='alert alert-danger' role='alert'>RKSP gagal ditambahkan, RKSP sudah pernah diinput</div>";
		}
	}

	public function insertManifes($data)
	{
		$ref = $data['ref'];
		$nomor = $data['nomor'];
		$doc_date = $data['doc_date'];
		$eta = $data['eta'];
		$pos = $data['pos'];
		$user = $this->session->userdata('user');
		$name = $this->session->userdata('name');
		$stamp = time();

		$query1 = "SELECT *
					FROM `tracking`
					WHERE `nomor` = '$nomor'
					AND `jenis` = 'manifes'
					";
		$result1 = $this->db->query($query1)->num_rows();

		$query2 = "INSERT INTO `tracking`
					(`ref`,`jenis`,`nomor`,`doc_date`,`eta`,`pos`,`user`,`name`,`stamp`)
					VALUES ('$ref','manifes','$nomor',$doc_date,$eta,'$pos','$user','$name',$stamp)
					";
		
		if ($result1 == 0) {
			$this->db->query($query2);
			return "<div class='alert alert-success' role='alert'>RKSP berhasil ditambahkan</div>";
		} else {
			return "<div class='alert alert-danger' role='alert'>RKSP gagal ditambahkan, RKSP sudah pernah diinput</div>";
		}
	}
}