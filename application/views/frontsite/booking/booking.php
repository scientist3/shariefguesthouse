<section class="h-100 h-custom">
	<div class="container py-5 h-100">
		<div class="row ">
			<div class="col-lg-offset-1 col-lg-10 col-xl-8">
				<div class="card rounded-3">
					<div class="card-body p-4 p-md-5">
						<?php if (isset($existing_booking_id)): ?>
							<div class="alert alert-info" role="alert">
								<?= $existing_booking_id; ?>
							</div>
						<?php endif; ?>
						<h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Hotel Booking Form <a href="<?php echo base_url('front/checkbookingstatus'); ?>" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Check Booking Status</a></h3>

						<form class="" action="<?php echo base_url('front/booking'); ?>" method="POST" style="padding-top: 20px;">
							<div class="row">
								<div class="form-group col-md-6 col-sm-6">
									<label for="name">Full Name</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
								</div>
								<div class="form-group col-md-6 col-sm-6">
									<label for="email">Email address</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6 col-sm-6">
									<label for="phone">Phone Number</label>
									<input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
								</div>
								<div class="form-group col-md-6 col-sm-6">
									<label for="guests">Number of Guests</label>
									<input type="number" class="form-control" id="guests" name="guests" placeholder="Enter number of guests">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6 col-sm-6">
									<label for="checkin">Check-in Date</label>
									<input type="date" class="form-control" id="checkin" name="checkin" min="<?= date('Y-m-d'); ?>">
								</div>
								<div class="form-group col-md-6 col-sm-6">
									<label for="checkout">Check-out Date</label>
									<input type="date" class="form-control" id="checkout" name="checkout" min="<?= date('Y-m-d'); ?>">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="room">Room Type</label>
									<select class="form-control" id="room" name="room">
										<?php foreach ($room_types as $index => $room_type): ?>
											<option value="<?= $index; ?>"><?= $room_type; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-save"></i> Book Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>