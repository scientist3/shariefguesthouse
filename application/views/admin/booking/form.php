<section class="content">
	<!-- Display -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bg-dark">
					<h3 class="card-title">
						<i class="fa fa-list"></i> View Bookings
					</h3>
					<div class="card-tools">
						<a href="<?php echo base_url('admin/booking/' . $btn_url) ?>" class="btn btn-success btn-sm">
							<i class="fa fa-eye"></i> <?php echo $btn_title ?>
						</a>
					</div>
				</div>

				<div class="card-body">
					<table width="100%" class="datatable_colvis table table-striped table-bordered table-hover table-sm">
						<thead>
							<tr>
								<th><?php echo ('Booking Date') ?></th>
								<th><?php echo ('Booking ID') ?></th>
								<th><?php echo ('Full Name') ?></th>
								<th><?php echo ('Email') ?></th>
								<th><?php echo ('Phone Number') ?></th>
								<th><?php echo ('Check-in Date') ?></th>
								<th><?php echo ('Check-out Date') ?></th>
								<th><?php echo ('Number of Guests') ?></th>
								<th><?php echo ('Room Type') ?></th>
								<th><?php echo ('Status') ?></th>
								<th><?php echo ('Remarks') ?></th>
								<th><?php echo ('Action') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($bookings)) { ?>
								<?php $sl = 1; ?>
								<?php foreach ($bookings as $booking) { ?>
									<tr>
										<td><?php echo date('d M Y, h:i A', strtotime($booking->created_at)); ?></td>
										<td><?php echo $booking->booking_id; ?></td>
										<td><?php echo $booking->full_name; ?></td>
										<td><?php echo $booking->email; ?></td>
										<td><?php echo $booking->phone; ?></td>
										<td><?php echo $booking->checkin_date; ?></td>
										<td><?php echo $booking->checkout_date; ?></td>
										<td><?php echo $booking->guests; ?></td>
										<td><?php echo $room_types[$booking->room_type] ?? 'NA'; ?></td>
										<td>
											<?php if ($booking->status == 'Confirmed') { ?>
												<span class="badge badge-success"><?php echo $booking->status; ?></span>
											<?php } elseif ($booking->status == 'Cancelled') { ?>
												<span class="badge badge-danger"><?php echo $booking->status; ?></span>
											<?php } else { ?>
												<?php echo $booking->status; ?>
											<?php } ?>
										</td>
										</td>
										<td><?php echo $booking->remarks; ?></td>
										<td class="text-center" width="100">
											<?php if ($booking->status == 'Pending') { ?>
												<a href="<?php echo base_url("admin/booking/update_status/$booking->id/Confirmed") ?>" class="btn btn-xs btn-success">Confirm</a>
												<button type="button" class="btn btn-xs btn-danger btn-cancel" data-id="<?php echo $booking->id; ?>">Cancel</button>
											<?php } else { ?>
												<?php
												$whatsapp_number = $booking->phone;
												if (strpos($whatsapp_number, '+') !== 0) {
													$whatsapp_number = '+91' . $whatsapp_number; // Assuming default country code +91
												}
												$message = "Hello, Your booking is : " . $booking->booking_id . ". Please contact us for more details.";
												$encoded_message = urlencode($message);
												?>

												<a href="https://wa.me/<?php echo $whatsapp_number; ?>?text=<?php echo $encoded_message; ?>"
													class="btn btn-xs btn-dark" target="_blank">
													<i class="fa fa-comments"></i> Whatsapp
												</a>
											<?php } ?>
										</td>
									</tr>
									<?php $sl++; ?>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table> <!-- /.table-responsive -->
				</div>
			</div>
		</div>
	</div>
</section>
<style>
	.float-whatsapap-chat {
		position: fixed;
		bottom: 40px;
		right: 60px;
		background-color: #25d366;
		color: #fff;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		text-align: center;
		z-index: 1000;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.float-whatsapp-chat:hover {
		background-color: #128c7e;
	}

	.float-whatsapp-chat a {
		color: #fff;
	}

	.float-whatsapp-chat a:hover {
		color: #fff;
	}
</style>
<!-- Cancel Remarks Modal -->
<div class="modal fade" id="cancelRemarksModal" tabindex="-1" role="dialog" aria-labelledby="cancelRemarksModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cancelRemarksModalLabel">Cancel Booking</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="remarks">Remarks</label>
					<textarea class="form-control" id="remarks" rows="3"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-submit-remarks">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url('vendor/almasaeed2010/adminlte/') ?>plugins/jquery/jquery.min.js"></script>

<script>
	$(document).ready(function() {

		$('.btn-cancel').on('click', function() {
			var bookingId = $(this).data('id');
			$('#cancelRemarksModal').data('booking-id', bookingId).modal('show');
		});

		$('.btn-submit-remarks').on('click', function() {
			var bookingId = $('#cancelRemarksModal').data('booking-id');
			var remarks = $('#remarks').val();
			window.location.href = "<?php echo base_url('admin/booking/update_status/') ?>" + bookingId + "/Cancelled?remarks=" + encodeURIComponent(remarks);
		});
	});
</script>
