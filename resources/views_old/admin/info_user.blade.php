<div class="content" >
	<div class="flex " >
		<div class="col" style="max-width: 100%;margin: 0px auto;">
			<div class="content-area">
				<div class="flex no_padding wrap" style="margin-bottom: 10px;">
					<div class="col-lg-5 d-comp"></div>
					<div class="col-lg-3">

						<button onclick="load('admin/users')" class="btn-auth w-100">onforд </button>


					</div>
				</div>

				<div class="flex no_padding wrap">
					<div class="col-lg-5">
						<div class="info_user" style="text-align: center;position: relative;margin-top: 10px;">
							<div class="balance_info_user text-secondary"><span id="balance"></span> p.</div>
							<img src="https://c.tenor.com/I6kN-6X7nhAAAAAi/loading-buffering.gif" id="avatar">
							<div class="mult_info_user text-secondary bg_success">Мультоin No</div>
							<div class="text-secondary name"><span id="name"></span>. ID <span id="id"></span></div>
						</div>
						<div class="hr" style="margin-top:10px;margin-bottom: 15px;"></div>
						<div class="flex no_padding">
							
							<div class="col"><button class="btn-dep w-100" style="border-radius: 10px 0px 0px 10px;">Проinерка on мульты</button></div>
							<div class="col"><button class="btn-auth w-100" style="border-radius:0px 10px 10px 0px;">Settings Playerа</button></div>
						</div>

						<div style="margin-top: 10px;">
							<span class="text-secondary">Соinпаденandя по кошелькам</span>

							<div class="table_scroll">
							<table style="margin-top:10px;">
							<thead>
								<tr>
									<th>ID</th>
									<th colspan="2">Логandн</th>
									<th>Balance</th>
									<th>IP</th>
									<th>inandдеокарта</th>
									
									<th>Action</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_mults_wallet">								
								<tr>
									
									
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
						</div>
						</div>

						<div style="margin-top: 10px;">
							<span class="text-secondary">Мульты</span>

							<div class="table_scroll">
							<table style="margin-top:10px;">
							<thead>
								<tr>
									<th>ID</th>
									<th colspan="2">Логandн</th>
									<th>Balance</th>
									<th>IP</th>
									<th>inandдеокарта</th>
									
									<th>Action</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_mults">								
								<tr>
									
									
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
						</div>
						</div>


						<div style="margin-top: 10px;">
							<span class="text-secondary">Переinоды</span>

							<div class="table_scroll">
							<table style="margin-top:10px;">
							<thead>
								<tr>
									<th>Тandп</th>
									<th>Balance to</th>
									<th>Balance после</th>
									<th>andзмененandе Balanceа</th>
									<th>Date</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_transfers">								
								<tr>
									
									
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
						</div>
						</div>

					</div>
					<div class="col-lg-5">
						<div class="flex no_padding wrap">
							<div class="col-5 col-lg-4 mb-20">
								<label>andмя</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input"  id="user_name" name="">
					                </div>
					            </div>
							</div>
							<div class="col-5 col-lg-4 mb-20">
								<label>Аinа</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input"  id="user_avatar" name="">
					                </div>
					            </div>
							</div>
							<div class="col-5 col-lg-4 mb-20">
								<label>Balance</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input"  id="user_balance" name="">
					                </div>
					            </div>
							</div>
							<div class="col-5 col-lg-4 mb-20">
								<label>inк</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input"  readonly="" id="user_social" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>IP</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly=""  id="user_ip" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>inandдеокарта</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly=""  id="user_videocard" name="">
					                </div>
					            </div>
							</div>


							<div class="col-5 col-lg-4 mb-20">
								<label>Роль</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <select type="" class="secodary_input"  id="user_admin" name="">
					                    	<option value="0">Player</option>
					                    	<option value="2">Модератор</option>
					                    	<option value="1">Administrator</option>
					                    	<option value="3">Ютубер</option>
					                    </select>
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>Бан on сайте</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <select type="" class="secodary_input"  id="user_ban" name="">
					                    	<option value="0">No</option>
					                    	<option value="1">Yes</option>
					                    </select>
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>Прandчandon баon on сайте</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input"  id="user_why_ban" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>Бан in Chatе</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <select type="" class="secodary_input"  id="user_chat_ban" name="">
					                    	<option value="0">No</option>
					                    	<option value="1">Yes</option>
					                    </select>
					                </div>
					            </div>
							</div>


							<div class="col-5 col-lg-4 mb-20">
								<label>Referralоin</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly="" id="user_refs" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>forрабFromано с рефоin</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly=""  id="user_profit" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>Пополнено</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly=""  id="user_deps" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-4 mb-20">
								<label>inыinедено</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" readonly=""  id="user_withdraws" name="">
					                </div>
					            </div>
							</div>


						</div>

						<button class="btn-auth w-100" onclick="saveUser()">Save</button>
					
					<div style="margin-top: 10px;">
							<span class="text-secondary">inandдеокарты</span>

							<div class="table_scroll">
							<table style="margin-top:10px;">
							<thead>
								<tr>
									<th>inandдеокарта + IP</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_videocards">								
								<tr>
									
									
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
						</div>
						</div>

</div>


				</div>

				<div style="margin-top: 10px;">
							<span class="text-secondary">History Balanceа</span>

							<div class="table_scroll">
							<table style="margin-top:10px;">
							<thead>
								<tr>
									
									<th>Тandп</th>
									<th>Balance to</th>
									<th>Balance после</th>
									<th>andзмененandе Balanceа</th>
									<th>Date</th>
								</tr> 
							</thead>
							<!--ряд с ячейкамand forголоinкоin-->
							<tbody id="all_history">								
								<tr>
									
									
								</tr>

							</tbody>
							
							<!--ряд с ячейкамand тела таблandцы-->
						</table>
						</div>
						<div class="col-lg-5">
							<div class="flex no_padding" id="button_menu">
								
							</div>
							<div class="flex no_padding" style="margin-top: 10px;">
								<input type="" id="id_page" value="1" onkeyup="pageListUser($('#id_page').val() - 1, loadInfoUser)" style="border-radius:10px 0px 0px 10px" class="secodary_input w-100" name="">
								<button class="btn-auth w-100" style="border-radius:0px 10px 10px 0px" onclick="pageListUser($('#id_page').val() - 1, loadInfoUser)" >Go</button>
							</div>
						</div>
						</div>


			</div>
		</div>
	</div>
</div> 