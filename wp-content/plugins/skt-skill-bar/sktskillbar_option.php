<style>
table{border-collapse:collapse;}
table td{padding:5px;}
table td img{max-width:100%;}
code{font-family:"Courier New", Courier, monospace; background:none;}
</style>

<div class="wrap">
    <?php echo "<h2>" . __( 'SKT Skill Bar Options', 'sbar_trdom' ) . "</h2>"; ?>

	<?php 
	$dir = plugin_dir_path( __FILE__ ); 
	$lpos = strrpos($dir, "skt-"); 
	$dirPathStr = substr($dir, $lpos, strlen($dir) );
	$dirPath = str_replace('/', '', $dirPathStr);
	?>

    <table width="100%" class="fixed">
        <tr>
            <td width="75%">
	            <img src="<?php echo plugins_url( $dirPath.'/images/sample_bar.jpg' ); ?>" alt="Skill Bar" /><br />
                <code>
                    [skillwrapper type="bar"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill title_background="#f7a53b" bar_foreground="#f7a53b" bar_background="#eeeeee" percent="90" title="CSS3"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill title_background="#6adcfa" bar_foreground="#6adcfa" bar_background="#eeeeee" percent="55" title="WordPress"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill title_background="#fa6e6e" bar_foreground="#fa6e6e" bar_background="#eeeeee" percent="85" title="PHP"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill title_background="#336699" bar_foreground="#336699" bar_background="#eeeeee" percent="100" title="jQuery"]<br />
                    [/skillwrapper]
                </code>
            </td>
            <td width="25%" rowspan="5" valign="top">
				<a href="http://www.sktthemes.net/" title="SKT Wordpress Themes" target="_blank"><img src="<?php echo plugins_url( $dirPath.'/images/sktskill.jpg' ); ?>" alt="SKT Wordpress Themes" /></a>
            </td>
        </tr>
        <tr>
            <td><hr style="border-color:#eee;" /></td>
        </tr>
        <tr>
            <td>
	            <img src="<?php echo plugins_url( $dirPath.'/images/sample_gage.jpg' ); ?>" alt="Skill Gage" /><br />
                <code>
                    [skillwrapper type="gage" align="left"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="75" title="Wordpress" bar_foreground="#f00" bar_background="#eee"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="25" title="SEO" bar_foreground="#f60" bar_background="#eee"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="50" title="PHP" bar_foreground="#900" bar_background="#eee"]<br />
                    [/skillwrapper]
				</code>
            </td>
        </tr>
        <tr>
            <td><hr style="border-color:#eee;" /></td>
        </tr>
        <tr>
            <td>
            	<img src="<?php echo plugins_url( $dirPath.'/images/sample_circle.jpg' ); ?>" alt="Skill Circle" /><br />
                <code>
                    [skillwrapper type="circle" track_color="#dddddd" chart_color="#333333" chart_size="150" align="left"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="88" title="Web Research"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="55" title="WordPress"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="85" title="PHP"]<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;[skill percent="100" title="jQuery"]<br />
                    [/skillwrapper]
                </code>
            </td>
        </tr>
    </table>

</div>