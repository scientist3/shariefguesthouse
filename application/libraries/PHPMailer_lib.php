<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

class PHPMailer_lib
{
	public function __construct()
	{
		log_message('Debug', 'PHPMailer class is loaded.');
	}
	public function loadnew()
	{
		require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
		require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
		require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';
		require 'vendor/autoload.php';
		// Instantiate PHPMailer
		$mail = new PHPMailer(true);

		try {
			// Set mailer to use SMTP
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->Port       = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth   = true;
			$mail->AuthType   = 'XOAUTH2';

			// Your Gmail address
			$email = 'info.sguesth@gmail.com';

			// OAuth 2.0 credentials
			$clientId = '297985201069-rfrn4lu6e6idnrjpi7msc8lme17odplh.apps.googleusercontent.com';
			$clientSecret = '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';
			$refreshToken = '1//04PLIM5l3MehKCgYIARAAGAQSNwF-L9IrqvS3scQRnro7wBax29isQrnLN1dQi_SgiHIPK3fNjKXNFsSccx4XDtes3Du-cCIZZDw';

			// Create the OAuth2 provider instance
			$provider = new Google([
				'clientId'     => $clientId,
				'clientSecret' => $clientSecret,
			]);
			// Set Guzzle HTTP client with CA certificate bundle
			$httpClient = new \GuzzleHttp\Client([
				'verify' => 'C:/wamp64/www/shariefguesthouse/cacert.pem',
			]);

			$provider->setHttpClient($httpClient);

			try {
				$accessToken = $provider->getAccessToken('refresh_token', [
					'refresh_token' => $refreshToken,
				]);
			} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
				echo 'Error retrieving access token: ' . $e->getMessage();
				echo ' Response: ' . var_dump($e->getResponseBody());
				return;
			} catch (\Exception $e) {
				echo 'General error: ' . $e->getMessage();
				return;
			}

			// Pass the OAuth2 instance to PHPMailer
			$mail->setOAuth(new OAuth([
				'provider'       => $provider,
				'clientId'       => $clientId,
				'clientSecret'   => $clientSecret,
				'refreshToken'   => $refreshToken,
				'userName'       => $email,
				'accessToken' => $accessToken->getToken(),
			]));

			// Set the sender's details
			$mail->setFrom($email, 'Your Name');
		} catch (Exception $e) {
			log_message('error', 'PHPMailer Error: ' . $mail->ErrorInfo);
			echo 'Email error: ' . $mail->ErrorInfo;
			return false;
		}

		return $mail;
	}
	public function load()
	{
		require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
		require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
		require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';

		$mail = new PHPMailer;
		return $mail;
	}

	public function getOAuthToken()
	{
		$provider = new Google([
			'clientId'     => '297985201069-e46sfrja61u3m1tanr2v35opq11slj2g.apps.googleusercontent.com',
			'clientSecret' => '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',
			'redirectUri'  => 'https://shariefguesthouse.com',
		]);

		$accessToken = $provider->getAccessToken('refresh_token', [
			'refresh_token' => '1//04PYbAUnxARPBCgYIARAAGAQSNwF-L9IrCkcrSZ77q8PAqMyU6hiv8sFBpDPxn5hkKQzlfLrl2HGS54dQIAdYoGWoh6_kpY2D4k8'
		]);

		return $accessToken->getToken();
	}

	private function getCurlOptions()
	{
		return [
			CURLOPT_CAINFO => 'C:/wamp64/www/shariefguesthouse/cacert.pem', // Path to the CA certificate bundle
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_VERBOSE => true, // Enable verbose output for debugging
		];
	}

	public function sendEmail()
	{
		require 'vendor/autoload.php';
		// Replace with your credentials
		$clientId = '297985201069-rfrn4lu6e6idnrjpi7msc8lme17odplh.apps.googleusercontent.com';
		$clientSecret = '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';
		$refreshToken = '1//04PLIM5l3MehKCgYIARAAGAQSNwF-L9IrqvS3scQRnro7wBax29isQrnLN1dQi_SgiHIPK3fNjKXNFsSccx4XDtes3Du-cCIZZDw';
		$emailAddress = 'info.sguesth@gmail.com'; // Gmail address used for sending

		// Create PHPMailer instance
		$mail = $this->load();
		$mail->isSMTP();
		$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Set to DEBUG_SERVER for troubleshooting
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->SMTPAuth = true;

		// Set OAuth2
		$provider = new Google([
			'clientId' => $clientId,
			'clientSecret' => $clientSecret,
		]);

		// Set Guzzle HTTP client with CA certificate bundle
		$httpClient = new \GuzzleHttp\Client([
			'verify' => 'C:/wamp64/www/shariefguesthouse/cacert.pem',
		]);

		$provider->setHttpClient($httpClient);

		try {
			$accessToken = $provider->getAccessToken('refresh_token', [
				'refresh_token' => $refreshToken,
			]);
		} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
			echo 'Error retrieving access token: ' . $e->getMessage();
			echo ' Response: ' . var_dump($e->getResponseBody());
			return;
		} catch (\Exception $e) {
			echo 'General error: ' . $e->getMessage();
			return;
		}

		$mail->setOAuth(
			new OAuth([
				'provider' => $provider,
				'clientId' => $clientId,
				'clientSecret' => $clientSecret,
				'refreshToken' => $refreshToken,
				'userName' => $emailAddress,
				'accessToken' => $accessToken->getToken(),
			])
		);

		// Set email content
		$mail->setFrom($emailAddress, 'Your Website Name');
		$mail->addAddress('clan2scientist@gmail.com'); // User's email
		$mail->Subject = 'Welcome to Our Website!';
		$mail->Body = 'Thank you for registering!';

		// Send email
		if (!$mail->send()) {
			echo 'Email error: ' . $mail->ErrorInfo;
		} else {
			echo 'Email sent!';
		}
	}
}
