<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FrontModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	// check status of booking
	public function getBookingStatus($booking_id, $phone_no)
	{
		$this->db->where('booking_id', $booking_id);
		$this->db->where('phone', $phone_no);
		$query = $this->db->get('booking_tbl');
		return $query->row_array();
	}
	// i want to get the next booking id
	public function getNextBookingId()
	{
		$this->db->select('MAX(booking_id) as booking_id');
		$query = $this->db->get('booking_tbl');
		return $query->row();
	}
	// save booking details
	public function saveBooking($data)
	{
		$this->db->insert('booking_tbl', $data);
		return $this->db->insert_id();
	}

	public function get_room_types()
	{
		$result = $this->db->select("id, room_type")
			->from("room_types_tbl")
			->get()
			->result_array();

		$room_types = [];
		foreach ($result as $row) {
			$room_types[$row['id']] = $row['room_type'];
		}
		return $room_types;
	}
	public function get_room_types_active()
	{
		$result = $this->db->select("id, room_type")
			->from("room_types_tbl")
			->where('status', 1)
			->get()
			->result_array();

		$room_types = [];
		foreach ($result as $row) {
			$room_types[$row['id']] = $row['room_type'];
		}
		return $room_types;
	}
}
