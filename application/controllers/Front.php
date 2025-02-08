<?php
defined('BASEPATH') or exit('No direct script access allowed');

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;

class Front extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('FrontModel' => 'front_model'));
		$this->load->library('PHPMailer_lib'); // Load the PHPMailer library
	}

	public function index()
	{
		$data['content'] = $this->load->view('frontsite/booking/home', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function checkbookingstatus()
	{
		$data['title'] = "Check Booking Status";
		if ($this->input->get()) {
			$booking_id = $this->input->get('booking_id');
			$phone_no = $this->input->get('phone_no');
			$data['booking_status'] = $this->front_model->getBookingStatus($booking_id, $phone_no);
			$data['no_booking'] = $data['booking_status'] ? TRUE : FALSE;
		}

		$data['content'] = $this->load->view('frontsite/booking/checkbookingstatus', $data, true);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function booking()
	{
		$data['title'] = "Booking";
		if ($this->input->post()) {
			$adventure = $this->input->post('adventure'); // Get checkbox values
			$adventure_str = !empty($adventure) ? implode(',', $adventure) : NULL;
			$booking_data = array(
				'booking_id' => $this->newId(),
				'full_name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'checkin_date' => $this->input->post('checkin'),
				'checkout_date' => $this->input->post('checkout'),
				'guests' => $this->input->post('guests'),
				'room_type' => $this->input->post('room'),
				'adventure' => $adventure_str
			);

			$this->front_model->saveBooking($booking_data);
			$data['success'] = "Booking successful! Your booking ID is " . $booking_data['booking_id'];
			$this->input->set_cookie('booking_id', $booking_data['booking_id'], 86400 * 30);
			redirect('front/booking');
		}

		if ($this->input->cookie('booking_id', true)) {
			$data['existing_booking_id'] = "Booking successful! Your previous booking ID is " . $this->input->cookie('booking_id', true);
		}
		$data['room_types'] = $this->front_model->get_room_types_active();
		$data['content'] = $this->load->view('frontsite/booking/booking', $data, true);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function about()
	{
		$data['title'] = "About Us";
		$data['content'] = $this->load->view('frontsite/about', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function rooms()
	{
		$data['title'] = "Our Rooms";
		$data['content'] = $this->load->view('frontsite/rooms', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function gallery()
	{
		$data['title'] = "Gallery";
		$data['content'] = $this->load->view('frontsite/gallery', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function dinning()
	{
		$data['title'] = "Dinning";
		$data['content'] = $this->load->view('frontsite/dinning', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	public function contact()
	{
		$data['title'] = "Contact Us";
		$data['content'] = $this->load->view('frontsite/contact', NULL, TRUE);
		$this->load->view('frontsite/layout/wrapper_view', $data);
	}

	// Other existing methods...
	private function newId()
	{
		$lastId = $this->front_model->getNextBookingId();
		$lastId = $lastId->booking_id;
		$lastId = substr($lastId, 4);
		$lastId = $lastId + 1;
		$lastId = 'SGH-' . $lastId;
		return $lastId;
	}
	/*
	private function sendEmail($to, $subject, $name, $booking_id, $booking_data)
	{ // Send email to the user
		$mail = $this->phpmailer_lib->load();
		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'your_smtp_host';
			$mail->SMTPAuth = true;
			$mail->Username = 'your_email@example.com';
			$mail->Password = 'your_email_password';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			//Recipients
			$mail->setFrom('your_email@example.com', 'Your Hotel Name');
			$mail->addAddress($to);

			//Content
			$mail->isHTML(true);
			$mail->Subject = 'Booking Confirmation - ' . $subject;
			$mail->Body    = 'Dear ' . $name . ',<br><br>Your booking is successful! Your booking ID is ' . $booking_id . '.<br><br>Thank you for choosing our hotel.<br><br>Best regards,<br>Your Hotel Name';

			$mail->send();
		} catch (Exception $e) {
			log_message('error', 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
		}
	}

	public function sendEmailToAdmin($subject, $booking_data)
	{
		//Create an instance; passing `true` enables exceptions
		$mail = $this->phpmailer_lib->load();

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'info.sguesth@gmail.com';
			$mail->Password   = 'Sgh@567#';
			$mail->SMTPSecure = 'tls';
			$mail->Port       = 587;

			//Recipients
			$mail->setFrom('info.sguesth@gmail.com', 'Your Hotel Name');
			$mail->addAddress('shahnafri63@gmail.com'); // Add admin email address

			//Content
			$mail->isHTML(true);
			$mail->Subject = 'New Booking - ' . $subject;
			$mail->Body    = 'A new booking has been made. Here are the';
			/*
			details:<br><br>' .
				'Booking ID: ' . $booking_data['booking_id'] . '<br>' .
				'Name: ' . $booking_data['full_name'] . '<br>' .
				'Email: ' . $booking_data['email'] . '<br>' .
				'Phone: ' . $booking_data['phone'] . '<br>' .
				'Check-in Date: ' . $booking_data['checkin_date'] . '<br>' .
				'Check-out Date: ' . $booking_data['checkout_date'] . '<br>' .
				'Guests: ' . $booking_data['guests'] . '<br>' .
				'Room Type: ' . $booking_data['room_type'];
				* /
			$mail->send();
			echo "msg sent: {$mail->ErrorInfo}";
		} catch (Exception $e) {
			log_message('error', 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	public function sendEmailToAdmin1($subject, $booking_data)
	{
		// die('sendEmailToAdmin1');
		// echo $this->phpmailer_lib->sendEmail();

		// loadnew
		// }
		// Load the PHPMailer library
		$this->load->library('phpmailer_lib');

		// Get an instance of PHPMailer
		$mail = $this->phpmailer_lib->loadnew();

		try {
			// Add a recipient
			$mail->addAddress('clan2scientist@gmail.com', 'Recipient Name');

			// Set email format to HTML
			$mail->isHTML(true);
			$mail->Subject = 'Test Email using OAuth2';
			$mail->Body    = 'This is a test email sent via Gmail SMTP with OAuth2 authentication.';
			$mail->AltBody = 'This is a plain-text message body for non-HTML email clients';

			// Attempt to send the email
			if (!$mail->send()) {
				echo 'Message could not be sent.<br>';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
		} catch (Exception $e) {
			echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
		}
	}
	*/
}
