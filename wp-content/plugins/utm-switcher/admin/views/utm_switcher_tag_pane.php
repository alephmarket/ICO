<div id="utm-switcher-tag-pane">
    <form action="">
        <table>
            <tr>
                <td>
                    <?php echo esc_html(__('Name', 'utm-switcher')); ?><br />
                    <input type="text" name="name" class="tg-name oneline" /><br />
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <code><?php echo esc_html(__('id', 'utm-switcher')); ?></code> (<?php echo esc_html(__('optional', 'utm-switcher')); ?>)<br />
                    <input type="text" name="id" class="idvalue oneline option" />
                </td>
                <td>
                    <code><?php echo esc_html(__('class', 'utm-switcher')); ?></code> (<?php echo esc_html(__('optional', 'utm-switcher')); ?>)<br />
                    <input type="text" name="class" class="classvalue oneline option" />
                </td>
            </tr>				
        </table>
        <div class="tg-tag">
			<?php echo esc_html(__("Copy this code and paste it into the form left.", 'utm-switcher')); ?>
			<br />
			<input type="text" name="utm" class="tag" readonly="readonly" onfocus="this.select()" />
		</div>
    </form>
</div>