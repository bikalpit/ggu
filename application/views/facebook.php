<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ADS</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}	

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
.dataTables_wrapper{
	padding:20px;
}
	</style>
	
</head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<body>

<div id="container">
	<div class="col-md-12">
	<h1>Facebook ADS </h1>	
	<button class="btn btn-info" style="float:right;width:15%;margin-left:5%" onclick=updateToken()>Update Token</button>
	<textarea class="form-control" rows="1" style="float:right;width:80%" placeholder="Enter Access Token" id="access_token">EAAE1ZCaRY1SsBAJpxZBWxwqFlxAZBMPdZCpog6FQXPAQeE9cAhoRiubCELCex23BaHMBZAuSt9Ja1ub0SGlMUsXUneZBmN3CV38vxUhAz0d1k4ZBAmnHZAOqLX8Am9rR3pGaWfodA2hKUx2OE6UVJegJrTuAyukB5azHERSYBfni1rnUcuMcak58szDMmesRiHctvwIrpaisvKNMF1PNvR8YVkNfhNcj6WQvwRXeZAYQUZCwZDZD</textarea>	
	</div>
	<table id="table_id" class="display">
		<thead>
			<tr>				
				<th>ID</th>
				<th>Campaings Name</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>			
		</tbody>
	</table>
</div>
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Core Metrics</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<div class="row">
				<div class="col-md-12" id="pop_detail">					
				</div>
			</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div> 

  </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>	  
	var table;
	table = $('#table_id').DataTable();    
		
	var FBaccount_id='act_162497604140942';
	/*var FBaccess_token='EAAE1ZCaRY1SsBADZCC5aNnm5sXxumGKZBEd4wtKMyjUnCz9n67Vr1u1Mj3tbOCnp1W1gYUjVmDa4XLqCZB8lgNrrxBJYlmKhA1619Ffm7wYd2WnZBD8rQoaOhy3fAuKjQwDAd7ZCKJRIoTLsfEU2oGdIZARKzyDZBzTkrlkpVvKuMn0VHZClFGUZCHuYwdjP9bkZCvq2LShPw64BgUZBzGXdvo5ingwQFsSXye9e8oQ6qtfuKwZDZD';*/
	var FBaccess_token=$('#access_token').val();	
	var apiurl='https://graph.facebook.com/v8.0/'+FBaccount_id+'/campaigns';
	//console.log(apiurl);
	var requestData='fields=id,name&access_token='+FBaccess_token;
	 $.ajax({
        url: apiurl,
        type: "GET",
        data: requestData ,
        success: function (response) {
			//console.log(response.data);
			var tableData=response.data;
			//console.log(tableData);
			 
			 if(tableData!='') {               
			  $.each(tableData, function(i, item) {
				 table.row.add([tableData[i].id, tableData[i].name,'<button class="btn btn-info" onclick=getCampaingsDetail('+tableData[i].id+')>Detail</button>']);
				});	
				table.draw();
			}
			else {
				$('#table_id').html('<h3>No are available</h3>');				
			}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);		
        }
    });	
	
	function getCampaingsDetail(cid){
		console.log(cid);
		var capiurl='https://graph.facebook.com/v8.0/'+cid+'/insights';
		var crequestData='date_preset=lifetime&fields=spend,impressions,cpm,cpc,clicks,actions&access_token='+FBaccess_token;
		$.ajax({
        url: capiurl,
        type: "GET",
        data: crequestData ,
        success: function (response) {
				//console.log(response.data);
				var resData=response.data;
				//$('#dummyModal').modal('show');
				var htmlData='';
				htmlData+='<div class="col-sm-6"><b>Clicks : </b>'+resData[0].clicks+'</div>';
				htmlData+='<div class="col-sm-6"><b>CPC : </b>'+resData[0].cpc+'</div>';
				htmlData+='<div class="col-sm-6"><b>CPM : </b>'+resData[0].cpm+'</div>';
				htmlData+='<div class="col-sm-6"><b>Impressions : </b>'+resData[0].impressions+'</div>';				
				htmlData+='<div class="col-sm-6"><b>Spend : </b>'+resData[0].spend+'</div>';
				htmlData+='<div class="col-sm-6"><b>Start Date : </b>'+resData[0].date_start+'</div>';
				htmlData+='<div class="col-sm-6"><b>Stop Date : </b>'+resData[0].date_stop+'</div>';
				$('#pop_detail').html(htmlData);
				$("#myModal").modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);			  
			}
		});	
	}

	function updateToken(){
		console.log('upd');
		var access_token=$('#access_token').val();
		location.reload();
	}
</script>