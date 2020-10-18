<style type="text/css">
.fa.fa-square.fa-lg {
  font-size: 6px;
  margin-right: 8px;
  vertical-align: middle;
}
</style>
<html>
<body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#666; text-align:justify;">
     <div style="max-width:630px;width:100%;margin:0 auto;">
      <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor="#FFFFFF" style="padding:15px; border:1px solid #e5e5e5;">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td><a href="#"><img src="<?php echo base_url(); ?>images/inner-logo.png"  alt="logo" width="50%" height="" /></a></td>
                              <td align="right" style="font-size:13px; font-weight:bold; width: 100px;"><?php echo date('d-M-Y'); ?></td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td height="10"></td>
                  </tr>
                  <tr>
                     <td  height="1" bgcolor="#ddd"></td>
                  </tr>
                  <tr>
                     <td  height="10"></td>
                  </tr>
           <tr>
             <td style="color:#6d6d6d; font-size:14px; line-height:35px; font-weight: 500;">Dear <?php echo $user_name; ?>, </td>
           </tr>
           <tr>
             <td style="font-size:15px; color:#898989;">Your registration suceesfull,</td>
           </tr>  
           <tr>
             <td style="font-size:15px; color:#898989;"><b>Email : </b><?php echo $email;?></td>
           </tr>          
           <tr>
             <td style="font-size:15px; color:#898989;"><b>Password : </b><?php echo $password;?></td>
           </tr>   
            <tr>
             <td style="font-size:15px; color:#898989;"><b>Tipo di pagamento : </b><?php echo $pay_type;?></td>
           </tr>          
           <tr>
             <td style="font-size:15px; color:#898989;"><b>Totale : </b><?php echo $amount;?></td>
           </tr>          

           <tr>
             <td style="color:#6d6d6d; font-size:14px;">Thanks &amp; Regards<br/>MedScanner Team</td>
           </tr>
           <!-- <tr>
             <td style="color:#6d6d6d; font-size:14px;">TaskersHub Team</td>
           </tr> -->
           <tr>
             <td>&nbsp;</td>
           </tr>
                  <tr>
                     <td height="2" bgcolor="#3f3f3f"></td>
                  </tr>
                  <tr>
                     <td height="10" style="background-color:#2a2a2a;"></td>
                  </tr>
                  <tr>
                     <td style="text-align:center; color:#fff;background-color:#2a2a2a; padding-bottom:10px;"> Copyright <?php echo date('Y'); ?> by <a href="<?php echo base_url(); ?>" style="text-align:center;decoration:none; color:#fff;">MedScanner.</a> All Right Reserved.</td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
      </table>
        </div>      
      </div>       
   </body>
</html