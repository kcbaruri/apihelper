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
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('reports.flat_rpt_header') }}</span></h2>
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
