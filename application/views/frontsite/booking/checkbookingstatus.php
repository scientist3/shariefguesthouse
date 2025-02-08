<section class="h-100 h-custom">
	<div class="container py-5 h-100">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10 col-xl-8">
				<div class="card rounded-3">
					<div class="card-body p-4 p-md-5">
						<h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Checking Existing Booking Status <a href="<?php echo base_url('front/booking'); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Booking</a></h3>
						<form action="<?php echo base_url('front/checkbookingstatus'); ?>" method="get" style="padding-top: 20px;">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="guests">Booking ID</label>
									<input name="booking_id" type="booking_id" class="form-control" id="guests" placeholder="Enter your booking Id e.g. SGH-0001">
								</div>
								<div class="form-group col-md-6">
									<label for="phone">Phone Number</label>
									<input name="phone_no" type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Check Now</button>
								</div>
							</div>
						</form>
					</div>
					<div class="card-footer" style="padding-top: 10px;">
						<?php if (isset($booking_status)): ?>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Booking ID</th>
										<th>Status</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $booking_status['booking_id']; ?></td>
										<td><?php echo $booking_status['status']; ?></td>
										<td><?php echo $booking_status['remarks']; ?></td>
									</tr>
								</tbody>
							</table>
						<?php endif; ?>
						<?php if (isset($no_booking) && $no_booking == false): ?>
							<div class="alert alert-danger" role="alert">
								No booking found with the provided details
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
