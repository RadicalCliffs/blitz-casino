<div class="content" >
	<div class="flex " >
		<div class="col" style="max-width: 100%;margin: 0px auto;">
			<div class="flex no_padding wrap">
				<div class="col">
					<div class="flex no_padding wrap">
						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;">
								<button class="btn-auth w-100">inсе юзеры</button>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;" >
								<button class="btn-dep w-100" onclick="load('admin/top_refs_profit');">Топ рефоinоtoin по forрабFromку</button>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="content-area " style="min-height: 10px;">
								<button class="btn-dep w-100" onclick="load('admin/top_refs_ref');">Топ рефоinоtoin по Referralам</button>
							</div>
						</div>
					</div>
					<div class="content-area">
						<div class="flex no_padding wrap" style="margin-bottom: 10px;">
							<div class="col-lg-5 d-comp"></div>
							<div class="col-lg-5">
								<div class="flex no_padding">
									<input type=""  id="search_input" class="w-100 secodary_input" style="border-radius: 10px 0px 0px 10px;" name="">
									<button onclick="searchUser()" class="btn-auth w-100" style="border-radius:0px 10px 10px 0px">onйтand член</button>
								</div>
							</div>
						</div>
						<div class="table_scroll">
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th colspan="2">Логandн</th>
									<th>Balance</th>
									<th>IP</th>
									<th>inandдеокарта</th>
									<th>Пополнено</th>
									<th>inыinедено</th>
									<th>Referralоin</th>
									<th>forрабFromок с рефоin</th>
									<th>Action</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_users">								
								<tr>
									<td>Yesнные</td>
									<td>Yesнные</td>
									<td>Yesнные</td>
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
							<div class="flex no_padding" style="margin-top: 10px;">
								<input type="" id="id_page" value="1" onkeyup="pageList($('#id_page').val() - 1, `userAll`, getUser)" style="border-radius:10px 0px 0px 10px" class="secodary_input w-100" name="">
								<button class="btn-auth w-100" style="border-radius:0px 10px 10px 0px" onclick="pageList($('#id_page').val() - 1, `userAll`, getUser)" >Go</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function getUser() {
		$.post('/admin/user/all',{_token: csrf_token}).then(e=>{
			$('#all_users').html('')
			$('#button_menu').html('')

			paginate = JSON.parse(e.paginate);
			for (var i = 0; i < paginate.length; i++) {
				$('#button_menu').append('<button onclick="pageList('+(Number(paginate[i]) - 1)+', `userAll`, getUser)" class="btn-dep w-100 '+(Number(paginate[i]) - 1)+'">'+paginate[i]+'</button>')
			}

			$('#button_menu button.'+e.step).addClass('btn-auth').removeClass('btn-dep')
			$('#id_page').val(e.step + 1)
			e.users.forEach((e)=>{
				if(e.ban == 0){
					ban = 'lock'
					type_ban = 1
				}else{
					ban = 'lock-open'
					type_ban = 0
				}
				$('#all_users').append('<tr>\
					<th>'+e.id+'</th>\
					<td><img class="avatar_user" src="'+e.avatar+'"></td>\
					<td><span>'+e.name+'</span></td>\
					<td>'+e.balance+'</td>\
					<td>'+e.ip+'</td>\
					<td>'+e.videocard+'</td>\
					<td>'+e.deps+'</td>\
					<td>'+e.withdraws+'</td>\
					<td>'+e.refs+'</td>\
					<td>'+e.profit+'</td>\
					<td><button class="btn-dep" style="width:50px;margin-right:5px" onclick="userBan(`'+e.avatar+'`, '+e.id+', '+type_ban+')"><i class="fa fa-'+ban+'"></i></button><button class="btn-dep" onclick="load(`admin/info_user`,``, loadInfoUserTimer('+e.id+'))" style="width:50px"><i class="fa fa-cog"></i></button></td>\
					</tr>')
			});
		});
	}
	getUser()


</script>