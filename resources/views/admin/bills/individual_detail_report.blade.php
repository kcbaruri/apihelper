<!DOCTYPE html>
<html>

   <head>
      <title>Individual Report</title>

      <style>
         table td,
         table th {
            border: 0.01em solid #000000;
         }
      </style>
   </head>
    
   <body style="margin: 0px;">

      
   <div style="text-align: center;" >
         <img src="{{ public_path('samajikadmin/img/logo.png') }}" style="width: 80px; height: 80px"><br/><br/>
         <span class="logo-text">নাজমহল ভবন</span><br/>
         <span>উত্তরা, ঢাকা।</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('pages.individual_bill_detail') }}</span></h2>
      </div>

        <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 20px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
        <tr style="background-color:#C0C0C0;">
        <th width="15%" style ="text-align: center;">{{ __('pages.tbl_sl_number_column') }}</th>
        <th width="65%">{{ __('pages.bill_head_name') }}</th>  
        <th width="20%">{{ __('pages.billable_amount') }}</th> 
        </tr>
        <?php 
        $i = 1;
        foreach($billheads as $billhead){
           $headerValue = 0.0;
           if($billhead->id == 1){
            $headerValue = $billdetail->col_1; 
           }
           else if($billhead->id == 1){
            $headerValue = $billdetail->col_1; 
           }

           else if($billhead->id == 2){
            $headerValue = $billdetail->col_2; 
           }

           else if($billhead->id == 3){
            $headerValue = $billdetail->col_3; 
           }

           else if($billhead->id == 4){
            $headerValue = $billdetail->col_4; 
           }

           else if($billhead->id == 5){
            $headerValue = $billdetail->col_5; 
           }

           else if($billhead->id == 6){
            $headerValue = $billdetail->col_6; 
           }

           else if($billhead->id == 7){
            $headerValue = $billdetail->col_7; 
           }

           else if($billhead->id == 8){
            $headerValue = $billdetail->col_8; 
           }

           else if($billhead->id == 9){
            $headerValue = $billdetail->col_9; 
           }

           else if($billhead->id == 10){
            $headerValue = $billdetail->col_10; 
           }

           else if($billhead->id == 11){
            $headerValue = $billdetail->col_11; 
           }

           else if($billhead->id == 12){
            $headerValue = $billdetail->col_12; 
           }

           else if($billhead->id == 13){
            $headerValue = $billdetail->col_13; 
           }

           else if($billhead->id == 14){
            $headerValue = $billdetail->col_14; 
           }

           else if($billhead->id == 15){
            $headerValue = $billdetail->col_15; 
           }

           else if($billhead->id == 16){
            $headerValue = $billdetail->col_16; 
           }

           else if($billhead->id == 17){
            $headerValue = $billdetail->col_17; 
           }

           else if($billhead->id == 18){
            $headerValue = $billdetail->col_18; 
           }

           else if($billhead->id == 19){
            $headerValue = $billdetail->col_19; 
           }

           else if($billhead->id == 20){
            $headerValue = $billdetail->col_21; 
           }

           else if($billhead->id == 21){
            $headerValue = $billdetail->col_21; 
           }

           else if($billhead->id == 22){
            $headerValue = $billdetail->col_22; 
           }

           else if($billhead->id == 23){
            $headerValue = $billdetail->col_23; 
           }

           else if($billhead->id == 24){
            $headerValue = $billdetail->col_24; 
           }

           else if($billhead->id == 25){
            $headerValue = $billdetail->col_25; 
           }

           else if($billhead->id == 26){
            $headerValue = $billdetail->col_26; 
           }

           else if($billhead->id == 27){
            $headerValue = $billdetail->col_27; 
           }

           else if($billhead->id == 28){
            $headerValue = $billdetail->col_28; 
           }

           else if($billhead->id == 29){
            $headerValue = $billdetail->col_29; 
           }

           else if($billhead->id == 30){
            $headerValue = $billdetail->col_30; 
           }

           else if($billhead->id == 31){
            $headerValue = $billdetail->col_31; 
           }

           else if($billhead->id == 32){
            $headerValue = $billdetail->col_32; 
           }

           else if($billhead->id == 33){
            $headerValue = $billdetail->col_33; 
           }

           else if($billhead->id == 34){
            $headerValue = $billdetail->col_34; 
           }

           else if($billhead->id == 35){
            $headerValue = $billdetail->col_35; 
           }

           else if($billhead->id == 36){
            $headerValue = $billdetail->col_36; 
           }

           else if($billhead->id == 37){
            $headerValue = $billdetail->col_37; 
           }

           else if($billhead->id == 38){
            $headerValue = $billdetail->col_38; 
           }

           else if($billhead->id == 39){
            $headerValue = $billdetail->col_39; 
           }

           else if($billhead->id == 40){
            $headerValue = $billdetail->col_41; 
           }

            ?>
            <tr>
            <td width="15%" style ="text-align: center;"><?php echo $i;?></td>
            <td width="65%"><?php echo $billhead->name;?></td>
            <td width="20%"><?php echo $headerValue;?></td>
            </tr>
            <?php
            $i++;

        }

        ?>
     </table>
     
   </body>
    
</html>
