<?php defined('BASEPATH') or exit('No direct script access allowed');

class BookingModel extends CI_Model
{
	private $table = "booking_tbl";

	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by("created_at", "desc")
			->get()
			->result();
	}

	public function read_as_array()
	{
		return $this->db->select("*")
			->from($this->table)
			->get()
			->result_array();
	}

	public function read_by_id_as_array($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('id', $id)
			->get()
			->row_array();
	}

	public function update($data = [])
	{
		return $this->db->where('id', $data['id'])
			->update($this->table, $data);
	}

	public function delete($id = null)
	{
		$this->db->where('id', $id)
			->delete($this->table);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function read_by_id_as_obj($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('id', $id)
			->get()
			->row();
	}

	public function get_todays_bookings($date)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('DATE(created_at)', $date)
			->order_by("created_at", "desc")
			->get()
			->result();
	}

	public function update_status($id, $status)
	{
		return $this->db->where('id', $id)
			->update($this->table, ['status' => $status]);
	}

	public function get_total_bookings()
	{
		return $this->db->select("COUNT(id) as total_bookings")
			->from($this->table)
			->get()
			->row()
			->total_bookings;
	}

	public function get_total_bookings_by_date($date)
	{
		return $this->db->select("COUNT(id) as total_bookings")
			->from($this->table)
			->where('DATE(created_at)', $date)
			->get()
			->row()
			->total_bookings;
	}

	// I wanto fetch the below data from the database
	// <option>Single Room</option>
	// <option>Double Room</option>
	// <option>Suite</option>
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
}
