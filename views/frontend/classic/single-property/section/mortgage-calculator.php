<?php

use RealPress\Helpers\Price;

if ( ! isset( $data ) ) {
	return;
}

$down_payment    = '';
$currency_symbol = Price::get_currency_symbol();
$loan_terms      = 12;
$down_payment    = 0; //Unit:Percentage
$interest_rate   = 6; //Percentage Per Year
$property_tax    = 3000;
$home_insurance  = 1000;
$pmi             = 1000;
$price           = intval( $data['price'] );

if ( $price != 0 ) {
	$down_payment = ( $down_payment / 100 ) * $price;
}

if ( $price == 0 ) {
	$loan_terms = $down_payment = $interest_rate = $property_tax = $home_insurance = $pmi = $price = '';
}
?>
<div class="realpress-mc-section">
	<h2><?php esc_html_e( 'Mortgage Calculator', 'realpress' ); ?></h2>
	<div class="realpress-mc">
		<div class="realpress-mc-chart-data-group">
			<div class="realpress-mc-chart">
				<div class="realpress-mc-price-wrap">
					<div id="realpress-mc-price"></div>
					<div class="realpress-mc-monthly"><?php esc_html_e( 'Monthly', 'realpress' ); ?></div>
				</div>
				<canvas width="200" height="200"></canvas>
			</div>
			<div class="realpress-mc-data">
				<ul>
					<li class="realpress-mc-principal-interest">
						<i class="fas fa-circle"></i>
						<strong><?php esc_html_e( 'Principle & Interest', 'realpress' ); ?></strong>
						<span id="realpress-mc-principal-interest"></span>
					</li>
					<li class="realpress-mc-property-tax">
						<i class="fas fa-circle"></i>
						<strong><?php esc_html_e( 'Property Tax', 'realpress' ); ?></strong>
						<span id="realpress-mc-property_tax"></span>
					</li>

					<li class="realpress-mc-home-insurance">
						<i class="fas fa-circle"></i>
						<strong><?php esc_html_e( 'Home Insurance', 'realpress' ); ?></strong>
						<span id="realpress-mc-home-insurance"></span>
					</li>

					<li class="realpress-mc-pmi">
						<i class="fas fa-circle"></i>
						<strong><?php esc_html_e( 'PMI', 'realpress' ); ?></strong>
						<span id="realpress-mc-pmi"></span>
					</li>
				</ul>
			</div>
		</div>

		<form>
			<div class="realpress-form-message"></div>
			<div class=" realpress-mc-form-group">
				<label for="realpress-mc-form-total"><?php esc_html_e( 'Total Amount(Monthly)', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<?php echo esc_attr( $currency_symbol ); ?>
					</div>
					<input id="realpress-mc-form-total" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'Total Amount(Monthly)', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $price ); ?>">
				</div>
			</div>
			<div class="realpress-mc-form-group">
				<label for="realpress-mc-form-down_payment"><?php esc_html_e( 'Down Payment', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<?php echo esc_attr( $currency_symbol ); ?>
					</div>
					<input id="realpress-mc-form-down_payment" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'Down Payment', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $down_payment ); ?>">
				</div>
			</div>

			<div class=" realpress-mc-form-group">
				<label for="realpress-mc-form-loan-terms"><?php esc_html_e( 'Loan Terms (Years)', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<i class="far fa-calendar-alt"></i>
					</div>
					<input id="realpress-mc-form-loan-terms" type="number" min=1 step="1"
						   placeholder="<?php esc_attr_e( 'Loan Terms (Years)', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $loan_terms ); ?>">
				</div>
			</div>

			<div class=" realpress-mc-form-group">
				<label for="realpress-mc-form-property-tax"><?php esc_html_e( 'Property Tax(Yearly)', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<?php echo esc_attr( $currency_symbol ); ?>
					</div>
					<input id="realpress-mc-form-property-tax" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'Property Tax(Yearly)', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $property_tax ); ?>">
				</div>
			</div>

			<div class=" realpress-mc-form-group">
				<label for="realpress-mc-form-pmi"><?php esc_html_e( 'PMI(Monthly)', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<?php echo esc_attr( $currency_symbol ); ?>
					</div>
					<input id="realpress-mc-form-pmi" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'PMI(Monthly)', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $pmi ); ?>">
				</div>
			</div>

			<div class="realpress-mc-form-group">
				<label for="realpress-mc-form-interest-rate"><?php esc_html_e( 'Interest Rate', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						%
					</div>
					<input id="realpress-mc-form-interest-rate" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'Interest Rate', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $interest_rate ); ?>">
				</div>
			</div>

			<div class=" realpress-mc-form-group">
				<label for="realpress-mc-form-home-insurance"><?php esc_html_e( 'Home Insurance(Yearly)', 'realpress' ); ?></label>
				<div class="realpress-mc-form-input-group">
					<div class="realpress-mc-form-input-group-symbol">
						<?php echo esc_attr( $currency_symbol ); ?>
					</div>
					<input id="realpress-mc-form-home-insurance" type="number" min="0"
						   placeholder="<?php esc_attr_e( 'Home Insurance(Yearly)', 'realpress' ); ?>"
						   value="<?php echo esc_attr( $home_insurance ); ?>">
				</div>
			</div>

			<div class="realpress-mc-form-group realpress-mc-submit">
				<button type="submit"><?php esc_html_e( 'Calculate', 'realpress' ); ?></button>
			</div>
		</form>
	</div>
</div>




