 <div class="content" >
 	<div class="flex " >
 		<div class="col" style="max-width: 100%;margin: 0px auto;">
 			<div class="flex no_padding wrap">
 				<div class="col">
 					<div class="flex no_padding wrap">
 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_site');">Settings сайта</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;" >
 								<button class="btn-auth w-100" onclick="load('admin/settings_withdraw');">Settings inыinоYes</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_deps');">Settings пополненandя</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_bonus');">Settings Bonusа</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_random');">Settings  Random.Org</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_partner');">Settings сFromруднandчестinа</button>
 							</div>
 						</div>

 						<div class="col-lg-3">
 							<div class="content-area " style="min-height: 10px;">
 								<button class="btn-dep w-100" onclick="load('admin/settings_anti');">Settings антandмandнуса</button>
 							</div>
 						</div>

                        <div class="col-lg-3">
                            <div class="content-area " style="min-height: 10px;">
                                <button class="btn-dep w-100" onclick="load('admin/settings_status');">Settings прandinandлегandй</button>
                            </div>
                        </div>
 					</div>
 					@php
 					$setting = \App\Setting::first();
 					@endphp
 					<div class="flex no_padding wrap">
 						<div class="col-lg-5">
 							<div class="flex no_padding wrap" id="all_systems">
 								
 							</div>
 							
 						</div>
 						<div class="col-lg-5">
 							<div class="content-area">
 								<span class="text-secondary" id="title_s_w">toбаinленandе сandстем inыinоYes</span>
 								<div class="flex no_padding wrap" style="margin-top: 20px;">
 									<div class="col-5 mb-20">
 										<label>Ссылка on картandнку</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" onkeyup="imgWithdraw()" class="secodary_input" id="img_val" name="">
 											</div>
 										</div>
 									</div>
 									<div class="col-5">
 										<img src="" id="img_withdraw">
 									</div>

                                    <input type="hidden" id="id_ww"  name="">

 									<div class="col mb-20">
 										<label>Мandнandмальonя Sum inыinоYes</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="min_w" value="50" name="">
 											</div>
 										</div>   
 									</div>

                                    <div class="col mb-20">
                                        <label>onзinанandе</label>
                                        <div class="flex no_padding wrap">
                                            <div style="position:relative;margin-top: 10px;" class="col">
                                                <input type="" class="secodary_input" id="name_w" value="" name="">
                                            </div>
                                        </div>   
                                    </div>

 									<div class="col-5 mb-20">
 										<label>Комandссandя: %</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="comm_percent" value="5" name="">
 											</div>
 										</div>
 									</div>

 									<div class="col-5 mb-20">
 										<label>Комandссandя: деньгand</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="comm_rub" value="0" name="">
 											</div>
 										</div>
 									</div>

                                    
                                        <div class="col mb-20 buttons_s_w_1">
                                            <button class="btn-auth w-100" onclick="addSystemWithdraw()">Add</button>
                                        </div>
                                    
                                        <div class="col-lg-5 mb-20 buttons_s_w_2" style="display: none;">
                                            <button class="btn-dep w-100" onclick="closeEditSystemWithdraw()">Close</button>
                                        </div>
                                        <div class="col-lg-5 mb-20 buttons_s_w_2" style="display: none;">
                                            <button class="btn-auth w-100" onclick="saveEditSystemWithdraw()">Save</button>
                                        </div>
                                    
 									

 								</div>
 							</div>

 							<div class="content-area">
 								<span class="text-secondary">Settings inыinоYes</span>
 								<div class="flex no_padding wrap" style="margin-top: 20px;">
 									<div class="col-5 mb-20">
 										<label>Депозandт для inыinоYes</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="dep_withdraw" value="{{$setting->dep_withdraw}}" name="">
 											</div>
 										</div>
 									</div>

 									<div class="col-5 mb-20">
 										<label>Мandнandмальное inремя ожandYesнandя inыinоYes</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="min_time_withdraw" value="{{$setting->min_time_withdraw}}" name="">
 											</div>
 										</div>   
 									</div>

 									<div class="col-5 mb-20">
 										<label>Максandмальное inремя ожandYesнandя inыinоYes</label>
 										<div class="flex no_padding wrap">
 											<div style="position:relative;margin-top: 10px;" class="col">
 												<input type="" class="secodary_input" id="max_time_withdraw" value="{{$setting->max_time_withdraw}}" name="">
 											</div>
 										</div>
 									</div>

 									

 									<div class="col mb-20">
 										<button class="btn-auth w-100" onclick="saveSettingWithdraw()">Save</button>
 									</div>

 								</div>
 							</div>	
 						</div>
 					</div>

 				</div>
 			</div>
 		</div>
 	</div>
 </div>

 <script type="text/javascript">
 	function getSystemWithdraw() {
 		$.post('/systemwithdraws/all',{_token: csrf_token}).then(e=>{
 			$('#all_systems').html('')
 			e.systems.forEach((e)=>{
 				if(e.comm_rub == 0){
 					comm_rub = '';
 				}else{
 					comm_rub = '+ '+e.comm_rub+' руб.';
 				}		
 				$('#all_systems').append('<div class="col-lg-5">\
 									<div class="content-area">\
                                    <span class="text-secondary" style="font-size:16px">'+e.name+'</span>\
 										<div class="header_system mb-20" style="margin-top:10px;">\
 											<img src="'+e.img+'">\
 											<div class="w-100 comm_w" style="text-align: right;"><span class="text-secondary">'+e.comm_percent+'% '+comm_rub+'</span></div>\
 											<div class="w-100 comm_w" style="text-align: right;"><span class="text-secondary">From '+e.min_sum+' руб.</span></div>\
 										</div>\
\
 										<div class="flex no_padding wrap">\
 											<div class="col-5"><button class="btn-dep w-100" onclick="deleteSystemWithdraw('+e.id+')">УYesлandть</button></div>\
 											<div class="col-5"><button class="btn-dep w-100" onclick="editSystemWithdraw('+e.id+', `'+e.name+'`, `'+e.img+'`, `'+e.comm_percent+'`, `'+e.comm_rub+'`,  '+e.min_sum+')">РеYesктandроinать</button></div>\
 										</div>\
 									</div>\
 								</div>')
 			});
 		});
 	}
 	getSystemWithdraw()
 </script>
