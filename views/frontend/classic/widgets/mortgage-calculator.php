<?php
if ( ! isset( $mortgage_args ) ) {
	return;
}
$default_total_amount  = $mortgage_args['default_total_amout'] ?? 1000;
$default_down_payment  = $mortgage_args['default_down_payment'] ?? 5;
$default_loan_terms    = $mortgage_args['default_loan_terms'] ?? 5;
$default_interest_rate = $mortgage_args['default_interest_rate'] ?? 5;
?>
<div class="realpress-form-message"></div>
<label>
	<?php esc_html_e( 'Total Amount', 'realpress' ); ?>
	<input name="total_amount" type="number" min="0" required value="<?php echo esc_attr( $default_total_amount ); ?>">
</label>
<label>
	<?php esc_html_e( 'Down Payment', 'realpress' ); ?>
	<input name="down_payment" type="number" min="0" value="<?php echo esc_attr( $default_down_payment ); ?>">
</label>
<label>
	<?php esc_html_e( 'Loan Terms(Year)', 'realpress' ); ?>
	<input name="loan_terms" type="number" min="0" value="<?php echo esc_attr( $default_loan_terms ); ?>">
</label>
<label>
	<?php esc_html_e( 'Interest Rate(%)', 'realpress' ); ?>
	<input name="interest_rate" type="number" min="0" value="<?php echo esc_attr( $default_interest_rate ); ?>">
</label>
<div>
	<button type="button"
			class="realpress-mc-widget-calculate"><?php esc_html_e( 'Calculate', 'realpress' ); ?></button>
	<button type="button" class="realpress-mc-widget-reset"><?php esc_html_e( 'Reset Form', 'realpress' ); ?></button>
</div>
<div class="realpress-mc-widget-result">
	<ul>
		<li>
			<strong><?php esc_html_e( 'Principle Amount', 'realpress' ); ?></strong>
			<span class="realpress-mc-widget-principle_amount"></span>
		</li>
		<li>
			<strong><?php esc_html_e( 'Years', 'realpress' ); ?></strong>
			<span class="realpress-mc-widget-years"></span>
		</li>
		<li>
			<strong><?php esc_html_e( 'Monthly Payment', 'realpress' ); ?></strong>
			<span class="realpress-mc-widget-monthly-payment"></span>
		</li>
		<li>
			<strong><?php esc_html_e( 'Balance Payable With Interest', 'realpress' ); ?></strong>
			<span class="realpress-mc-widget-payable-with-interest"></span>
		</li>
		<li>
			<strong><?php esc_html_e( 'Total With Down Payment', 'realpress' ); ?></strong>
			<span class="realpress-mc-widget-total-with-downpayment"></span>
		</li>
	</ul>
</div>
