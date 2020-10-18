<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>:: Medscanner ::</title>
      <style type="text/css">
       
.text-thk {color: #474747;font-size: 15px;text-align: left;}
.buton-act > a {background: #202020;color: #fff;display: block;margin: 21px auto 0;max-width: 125px;font-size: 14px;padding: 6px 13px;
    text-align: center;text-decoration: none;}
h3 {color: #000;font-size: 15px;font-weight: normal;}
          
.logo-w img {max-width: 300px;width: 100%;}
       </style>
   </head>
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
                                 <tr style="background:#02304F;">
                                <td style="padding: 10px;"><a href="#" class="logo-w"><img src="<?php echo base_url();?>assets/images/logo.png"  alt="logo"  height="" /></a></td>
                                <td align="right" style="font-size:13px; font-weight:bold;padding-right: 10px;color:#fff;"><?php echo date('d F Y');?></td>
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
                           <td>
                             <h3>Hi Admin,</h3>
                              <div class="text-thk"> <?php echo $message ; ?>  </div>
                            </td>
                        </tr>
                        <tr >

                        <td colspan='6'>
                           <br>
                         <table align="center" style="font-size:13px; font-weight:bold;padding-right: 10px;color:#00000;" border="1">
                          <tr>
                             <td  width="150"><b>Name : </b></td>
                             <td  width="150"><?php echo $user_name;?></td>
                           </tr>
                          <tr>
                             <td  width="150"><b>Email : </b></td>
                             <td  width="150"><?php echo $email;?></td>
                           </tr>
                           <tr>
                             <td  width="150"><b>Tipo di pagamento : </b></td>
                             <td  width="150"><?php echo $pay_type;?></td>
                           </tr>
                           <tr>
                             <td  width="150"><b>Amount: </b></td>
                             <td  width="150"><?php echo $amount;?></td>
                           </tr>
                        </table>
                        </td>
                        </tr>
                        
                        <tr>
                           <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                           <td height="2" bgcolor="#3f3f3f"></td>
                        </tr>
                        <tr>
                           <td height="10" style="background-color:#02304f;"></td>
                        </tr>
                        <tr>
                           <td style="text-align:center; color:#aeaeae;background-color:#02304f; padding-bottom:10px;"> Copyrights © 2016 by<span style="color:#fff;"><a href="<?php echo base_url(); ?>" style="decoration:none;"> Medscanner </a></span> All Rights Reserved. </td>
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
</html>

