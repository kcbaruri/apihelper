<!DOCTYPE html>
<html>

   <head>
      <title>Tenant Information</title>

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
         <span class="logo-text">{{ __('reports.nazmahal') }}</span><br/>
         <span>{{ __('reports.building_address') }}</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('reports.tenant_rpt_header') }}</span></h2>
      </div>

        <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 20px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
        <tr style="background-color:#C0C0C0;">
        <th width="10%" style ="text-align: center;">{{ __('pages.tbl_sl_number_column') }}</th>
        <th width="30%">{{ __('sidebar.floors') }}</th>  
        <th width="10%">{{ __('sidebar.flats') }}</th> 
        <th width="20%">{{ __('reports.tenant_name') }}</th> 
        <th width="10%">{{ __('pages.mobile_no') }}</th> 
        <th width="10%">{{ __('reports.in_date') }}</th>
        <th width="10%">{{ __('reports.out_date') }}</th>
        </tr>
        <?php 
        $i = 1;
        foreach($tenants as $tenant){
            ?>
            <tr>
            <td width="10%" style ="text-align: center;"><?php echo $i;?></td>
            <td width="30%"><?php if($tenant->floor != NULL) echo $tenant->floor->name; ?></td>
            <td width="10%"><?php if($tenant->flat != NULL) echo $tenant->flat->name; ?></td>
            <td width="20%"><?php  echo $tenant->name;?></td>
            <td width="10%"><?php echo $tenant->mobile_number;?></td>
            <td width="10%"><?php echo $tenant->in_date;?></td>
            <td width="10%"><?php echo $tenant->out_date;?></td>
            </tr>
            <?php
            $i++;
        }

        ?>
     </table>
     
   </body>
    
</html>
