<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/BookingModel');
		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
			redirect('login/logout');
		$this->cont_id = $this->session->userdata('cont_id');
	}

	public function index()
	{
		#------------- Default Form Section Display ---------#
		$data['title'] = ('Bookings');

		$data['btn_title'] = ('Show All Booking');
		$data['btn_url'] = ('showallbookings');
		// get the room type data
		$data['room_types'] = $this->BookingModel->get_room_types();
		$data['bookings'] = $this->BookingModel->get_todays_bookings(date('Y-m-d'));

		$data['content'] = $this->load->view('admin/booking/form', $data, true);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function showallbookings()
	{
		#------------- Default Form Section Display ---------#
		$data['title'] = ('Bookings');
		$data['btn_title'] = ('Show Todays Booking');
		$data['btn_url'] = ('index');
		// get the room type data
		$data['room_types'] = $this->BookingModel->get_room_types();
		$data['bookings'] = $this->BookingModel->read();

		$data['content'] = $this->load->view('admin/booking/form', $data, true);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function delete($cont_us_id = null)
	{
		if (empty($cont_us_id)) {
			redirect('admin/contact/index');
		}
		if ($this->BookingModel->delete($cont_us_id)) {
			// $this->location_model->delete($loc_id);
			$this->session->set_flashdata('message', ('Deleted Successfully'));
			$this->session->set_flashdata('class_name', ('alert-success'));
		} else {
			$this->session->set_flashdata('message', ('Please Try Again'));
			$this->session->set_flashdata('class_name', ('alert-danger'));
		}
		redirect('admin/contact/index');
	}

	public function update_status($id, $status)
	{
		$remarks = $this->input->get('remarks');
		if (preg_match('/<\?php|<script|<\/script>/i', $remarks)) {
			$this->session->set_flashdata('message', 'Invalid remarks input');
			$this->session->set_flashdata('class_name', 'alert-danger');
			redirect('admin/booking/index');
			return;
		}
		if (!empty($remarks)) {
			$data = ['id' => $id, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s'), 'remarks' => $remarks];
		} else {
			$data = ['id' => $id, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
		}
		if ($this->BookingModel->update($data,)) {
			$this->session->set_flashdata('message', 'Status and remarks updated successfully');
			$this->session->set_flashdata('class_name', 'alert-success');
		} else {
			$this->session->set_flashdata('message', 'Failed to update status');
			$this->session->set_flashdata('class_name', 'alert-danger');
		}
		redirect('admin/booking/index');
	}
}
