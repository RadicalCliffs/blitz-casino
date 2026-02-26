 <div class="content" >
	<div class="flex " >
		<div class="col" style="max-width: 100%;margin: 0px auto;">
			<div class="flex no_padding wrap">
				<div class="col">
					<div class="flex no_padding wrap">
						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;">
								<button class="btn-dep w-100" onclick="load('admin/promo');">Денежные Promo Codes</button>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;" >
								<button class="btn-dep w-100"  onclick="load('admin/deppromo');">Promo Codes к депу</button>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;">
								<button class="btn-auth w-100">Последнandе актandinацandand</button>
							</div>
						</div>
					</div>
					<div class="content-area">
						<div class="table_scroll">
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>onзinанandе промокоYes</th>
									<th>Тandп промокоYes</th>
									<th colspan="2">Логandн</th>
									<th>Номandonл промокоYes</th>
									<th>Date</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_historypromo">					 			
								<tr>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
					</div>
						<div class="col-lg-5">
							<div class="flex no_padding" id="button_menu">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	


	function getHistoryPromo() {

		$.post('/admin/historypromo/all',{_token: csrf_token}).then(e=>{
			$('#all_historypromo').html('')
			$('#button_menu').html('')

			paginate = JSON.parse(e.paginate);
			for (var i = 0; i < paginate.length; i++) {
				$('#button_menu').append('<button onclick="pageList('+(Number(paginate[i]) - 1)+', `promoHistoryAll`, getHistoryPromo)" class="btn-dep w-100 '+(Number(paginate[i]) - 1)+'">'+paginate[i]+'</button>')
			}

			$('#button_menu button.'+e.step).addClass('btn-auth').removeClass('btn-dep')
			e.history.forEach(async (e)=>{	
				type = 'Денежный';
				if(e.type == 1){
					type = 'К депу';
				}

				user = await infoUser(e.user_id)
				date = await getDateFromDate(e.created_at);
				promo = await infoPromo(e.type, e.promo)


				$('#all_historypromo').append('<tr>\
					<th>'+e.id+'</th>\
					<td>'+e.promo+'</td>\
					<td>'+type+'</td>\
					<td><img class="avatar_user" src="'+user.avatar+'"></td>\
					<td>'+user.name+'</td>\
					<td>'+Number(promo.sum).toFixed(2)+'</td>\
					<td>'+date+'</td>\
					</tr>')
			});
		});
	}
	getHistoryPromo()


</script>