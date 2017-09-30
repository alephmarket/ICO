<?php defined( 'ABSPATH' ) || die( '-1' ); // don't load directly ?>

<form class="dashed-slug-wallets move" data-bind="submit: doMove, if: coins().length">
	<label class="coin" data-bind="visible: coins().length > 1"><?php esc_html_e( 'Coin', 'wallets' ); ?>: <select data-bind="options: coins(), optionsText: 'name', optionsValue: 'symbol', value: selectedCoin, valueUpdate: ['afterkeydown', 'input']"></select></label>
	<label class="user"><?php esc_html_e( 'Recipient user', 'wallets' ); ?>: <select data-bind="options: users(), optionsText: function(u) { return u.name; }, value: moveUser, valueUpdate: ['afterkeydown', 'input']"></select></label>
	<label class="amount"><?php esc_html_e( 'Amount', 'wallets' ); ?>: <input type="text"  data-bind="value: moveAmount, valueUpdate: ['afterkeydown', 'input']" /></label>
	<label class="comment"><?php esc_html_e( 'Transfer comment', 'wallets' ); ?>: <input type="text" data-bind="value: moveComment" /></label>
	<label class="fee"><?php esc_html_e( 'Fee (deducted from amount)', 'wallets' ); ?>: <input type="text" data-bind="value: move_fee, enable: false" /></label>
	<hr />
	<input type="hidden" name="moveTags" value="move" />

	<input type="submit" value="<?php esc_attr_e( 'Send', 'wallets' ); ?>" />
	<input type="button" data-bind="click: $root.resetMove" value="<?php esc_attr_e( 'Reset form', 'wallets' ); ?>" />
	<?php wp_nonce_field( 'wallets-move' ); ?>
</form>
