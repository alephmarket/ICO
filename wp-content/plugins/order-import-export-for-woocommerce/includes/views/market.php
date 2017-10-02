<style>
    .box14{
        width: 30%;
        margin-top:15px;
        min-height: 310px;
        margin-right: 10px;
        padding:10px;
        position:absolute;
        z-index:1;
        right:0px;
        float:right;
        background: -webkit-gradient(linear, 0% 20%, 0% 92%, from(#fff), to(#f3f3f3), color-stop(.1,#fff));
        border: 1px solid #ccc;
        -webkit-border-radius: 60px 5px;
        -webkit-box-shadow: 0px 0px 35px rgba(0, 0, 0, 0.1) inset;
    }
    .box14_ribbon{
        position:absolute;
        top:0; right: 0;
        width: 130px;
        height: 40px;
        background: -webkit-gradient(linear, 555% 20%, 0% 92%, from(rgba(0, 0, 0, 0.1)), to(rgba(0, 0, 0, 0.0)), color-stop(.1,rgba(0, 0, 0, 0.2)));
        border-left: 1px dashed rgba(0, 0, 0, 0.1);
        border-right: 1px dashed rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.2);
        -webkit-transform: rotate(6deg) skew(0,0) translate(-60%,-5px);
    }
    .box14 h3
    {
        text-align:center;
        margin:2px;
    }
    .box14 p
    {
        text-align:center;
        margin:2px;
        border-width:1px;
        border-style:solid;
        padding:5px;
        border-color: rgb(204, 204, 204);
    }
    .box14 span
    {
        background:#fff;
        padding:5px;
        display:block;
        box-shadow:green 0px 3px inset;
        margin-top:10px;
    }
    .box14 img {
        width: 40%;
        padding-left:30%;
        margin-top: 5px;
    }
    .table-box-main {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }

    .table-box-main:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
</style>
<div class="box14 table-box-main">
    <h3>
 <center><a href="https://www.xadapter.com/" target="_blank" style="text-decoration:  none;color:black;" >XAdapter</a></center></h3> 
    <hr>
    <img src= <?php echo plugins_url()."/order-import-export-for-woocommerce/images/Order-Import-Export-for-WooCommerce-Image.png"; ?>>
    <h3>Order/Coupon/Subscriptions CSV/XML Import Export Plugin For WooCommerce<br/></h3>
   <!--  <p style="color:red;">
        <strong>Your Business is precious. Go Premium!</strong>
    </p> -->
    <br/>
    <center> <a href="http://www.xadapter.com/product/order-import-export-plugin-for-woocommerce/" target="_blank" class="button button-primary"><?php _e('Upgrade to Premium Version', 'wf_order_import_export'); ?></a></center>
    <span>
    <ul>
   <li>- Import and Export Subscriptions along with Order and Coupon.</li>
<li>- Filtering options while Export using Order Status, Date, Coupon Type etc.</li>
<li>- Change values while import using Evaluation Field feature.</li>
<li>- A number of third party plugins supported.</li>
<li>- Column Mapping Feature to Import from any CSV format ( Magento, Shopify, OpenCart etc. ).</li>
<li>- Import and Export via FTP.</li>
<li>- Schedule automatic import and export using Cron Job Feature.</li>
<li>- XML Export/Import supports Stamps.com desktop application, UPS WorldShip, Endicia and FedEx.</li>
<li>- Excellent Support for setting it up!</li>
</ul>
    </ul>
    </span>
   
 <center> 
     
    
    <a href="http://orderimportexport.hikeforce.com/wp-admin/admin.php?page=wf_woocommerce_order_im_ex" target="_blank" class="button"><?php _e('Live Demo', 'wf_order_import_export'); ?></a>
    <a href="https://www.xadapter.com/setting-up-order-import-export-plugin-for-woocommerce/" target="_blank" class="button"><?php _e('Documentation', 'wf_order_import_export'); ?></a>
    <a href="<?php echo plugins_url('Sample_Order.csv', WF_OrderImpExpCsv_FILE); ?>" target="_blank" class="button"><?php _e('Sample Order CSV', 'wf_order_import_export'); ?></a>
    <a href="<?php echo plugins_url('Sample_Coupon.csv', WF_OrderImpExpCsv_FILE); ?>" target="_blank" class="button"><?php _e('Sample Coupon CSV', 'wf_order_import_export'); ?></a></center>
</div>
