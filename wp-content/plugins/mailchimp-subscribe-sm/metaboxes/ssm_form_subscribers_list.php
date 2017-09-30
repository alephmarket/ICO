<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ssm_form_subscribers($post){
    // $post is already set, and contains an object: the WordPress post
    global $post;

    $ssm_subscribers_list = get_post_meta($post->ID,'ssm_subscribers_list',true);
    //update_post_meta( $post->ID, 'ssm_subscribers_list', '', $unique = false);
    //var_dump($ssm_subscribers_list);

    if (empty($ssm_subscribers_list)) {
        $hidebtn = 'none';
    	$ssm_subscribers_list[0] = array(
                'name' => 'Example', 
                'email' => 'example@example.com',
            );
    }
?>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<div style='padding:50px; margin:0 auto; margin-top:50px; font-family:sans-serif,arial;font-size:17px; width:60%;'>
<table class='w3-table w3-striped w3-bordered w3-card-4' style="max-width: 750px;">
	<tr class="w3-red">
		<th>Name</th>
		<th>Email</th>
	</tr>
<?php foreach ( $ssm_subscribers_list as $ssm_result ) { ?>
    <tr>
        <td><?php echo $ssm_result['name']; ?></td>
        <td><?php echo $ssm_result['email']; ?></td>
    </tr>
<?php } ?>

</table>
</div>

<form method="post" class="" action="<?php echo SSM_PLUGIN_URL.'/subscriber-list-download.php?download_file=sm_subcribers-list.csv'; ?>" style='display: <?php echo $hidebtn; ?>' >
<input type="hidden" name="ps_ID" value="<?php echo $post->ID; ?>">
<input type="submit" style='background:#F27935; color:#fff; text-decoration:none;padding:15px;' value="DOWNLOAD LIST" >
</form>
  <br>
  <br>
  <br>
  <br>
  <form method="post" class="empty_button_form" action="<?php echo admin_url('admin-ajax.php?action=ssm_subscribe_list_empty'); ?>" style='display: <?php echo $hidebtn; ?>'>
  <input type="hidden" name="ps_ID" value="<?php echo $post->ID; ?>">
  <input type="submit" style='background:#F27935; color:#fff; text-decoration:none;padding:15px;' value="Empty List">
 <p id="response">Note : Deleted email addresses can't be recovered. Backup subscribers data before deleting.</p>
  </form>
  <br>


<script type="text/javascript">

		(function($){
    $(document).ready(function() {
    $('.empty_button_form').on('submit',function(){
         
        // Add text 'loading...' right after clicking on the submit button. 
        $('#response').text('Processing'); 
         
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(result){
                if (result == 'success'){
                    $('#response').text(result);  
                }else {
                    $('#response').text(result);
                }
            }
        });
         
        // Prevents default submission of the form after clicking on the submit button. 
        return false;   
    });

    $('.download_button_form').on('submit',function(){
         
        // Add text 'loading...' right after clicking on the submit button. 
        $('#response').text('Processing'); 
         
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(result){
                if (result == 'success'){
                    $('#response').text(result);  
                }else {
                    $('#response').text(result);
                }
            }
        });
         
        // Prevents default submission of the form after clicking on the submit button. 
        return false;   
    });
});
})(jQuery);

	</script>
<?php 
}

?>