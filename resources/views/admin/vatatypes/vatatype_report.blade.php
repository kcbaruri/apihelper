<!DOCTYPE html>
<html>

   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Vata Type Report</title>

      <style>
         table td,
         table th {
            border: 0.01em solid #000000;
         }

         @media screen {
         div.divFooter {
            display: none;
         }
         }
         @media print {
         div.divFooter {
            position: fixed;
            bottom: 0;
         }
         }

         
      </style>

   </head>
    
   <body style="font-family: kalpurush.ttf">
     
        
      <div style="text-align: center;" >
         <img src="{{ public_path('samajikadmin/img/logo.png') }}" style="width: 80px; height: 80px"><br/><br/>
         <span class="logo-text">নাজমহল ভবন</span><br/>
         <span>উত্তরা, ঢাকা।</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('reports.vata_type_rpt_header') }}</span></h2>
      </div>

      <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 16px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
        <tr style="background-color:#C0C0C0;">
        <th width="15%" style ="text-align: center;">{{ __('pages.tbl_sl_number_column') }}</th>
        <th width="65%">{{ __('pages.tbl_name_column') }}</th> 
        <th width="25%">{{ __('sidebar.departments') }}</th>         
        </tr>
        <?php 
        $i = 1;
        foreach($vatatypes as $var){
            ?>
            <tr>
            <td width="15%" style ="text-align: center;"><?php echo $i;?></td>
            <td width="60%"><?php echo $var->name;?></td>  
            <td width="25%"><?php echo $var->department->name;;?></td>           
            </tr>
            <?php
            $i++;
        }
        ?>
     </table>
     <div class="divFooter"><hr/></div>
   </body>
    
</html>
