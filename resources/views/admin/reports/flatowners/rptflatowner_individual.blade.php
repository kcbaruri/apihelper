<!DOCTYPE html>
<html>

  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Owner's Individual Report</title>
  <style> 
  body {
    font-family: examplefont;
  }
 
         table td,
         table th {
            border: 0.01em solid #000000;
         }
   
  </style>
  </head>
    
<body style="font-family: Kalpurush.ttf">

      <div style="text-align: center;" >
         <img src="{{ public_path('samajikadmin/img/logo.png') }}" style="width: 80px; height: 80px"><br/><br/>
         <span class="logo-text">নাজমহল ভবন</span><br/>
         <span>উত্তরা, ঢাকা।</span><br/>
         <hr/>
         <h2 style="color:#6f6f6f;margin:0"><span>{{ __('reports.owner_info') }}</span></h2>
      </div>

      <table width="100%" cellpadding="5px" cellspacing="0" style="background-color: #fff;padding: 20px;border-radius: 5px;box-shadow: 0px 0px 5px 0px #8c8989;">
      
        <tr style="background-color:#C0C0C0;">
        <td width="30%">{{ __('pages.tbl_name_column') }}</td>
        <td width="70%"><?php echo $flatowner->name;?></td>
        </tr>
        <tr>
        <td width="30%">{{ __('pages.tbl_photo_column') }}</td>
        <td width="70%"><?php echo asset($flatowner->photo);?></td>
        </tr>

        <tr>
        <td width="30%">{{ __('pages.mobile') }}</td>
        <td width="70%"><?php echo $flatowner->mobile_number;?></td>
        </tr>

        <tr>
        <td width="30%">{{ __('pages.nid') }}</td>
        <td width="70%"><?php echo $flatowner->nid;?></td>
        </tr>

        <tr>
        <td width="30%">{{ __('pages.email') }}</td>
        <td width="70%"><?php echo $flatowner->email;?></td>
        </tr>
        
     </table>
     
   </body>
    
</html>
