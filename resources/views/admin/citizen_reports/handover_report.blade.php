<!DOCTYPE html>
<html>

   <head>
      <title>{{ __('sidebar.vhandrpt') }}</title>
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
         <span>উত্তরা , ঢাকা ।</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('sidebar.vhandrpt') }}</span></h2>
      </div>

      <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 20px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
     
        <tr style="background-color:#C0C0C0;">
         <th width="15%">{{ __('pages.tbl_sl_number_column') }}</th>
         <th width="25%">{{ __('pages.tbl_name_column') }}</th>
         <th width="20%">{{ __('pages.tbl_month_column') }}</th>
         <th width="20%">{{ __('pages.tbl_year_column') }}</th>
         <th width="20%">{{ __('pages.tbl_amount_column') }}</th>
        </tr>
        <?php 
        $i = 1;

        foreach($handovers as $var){
            ?>
            <tr>
            <td width="15%" style ="text-align: center;"><?php echo $i;?></td>
            <td width="25%"><?php echo $var->name;?></td>
            <td width="20%"><?php echo $var->month;?></td>
            <td width="20%"><?php echo $var->year;?></td>
            <td width="20%"><?php echo $var->amount;?></td>
            </tr>
            <?php
            $i++;
        }

        ?>
     </table>
     
   </body>
    
</html>
