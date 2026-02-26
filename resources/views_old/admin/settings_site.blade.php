 <div class="content" >
	<div class="flex " >
		<div class="col" style="max-width: 100%;margin: 0px auto;">
			<div class="flex no_padding wrap">
				<div class="col">
					<div class="flex no_padding wrap">
						<div class="col-lg-3">
							<div class="content-area " style="min-height: 10px;">
								<button class="btn-auth w-100" onclick="load('admin/settings_site');">Settings сайта</button>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="content-area " style="min-height: 10px;" >
								<button class="btn-dep w-100" onclick="load('admin/settings_withdraw');">Settings inыinоYes</button>
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
					<div class="content-area">
						<div class="flex no_padding wrap">
							<div class="col-5 col-lg-3 mb-20">
								<label>onзinанandе сайта</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->name}}" id="name" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Айдand группы inк</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->group_id}}" id="group_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Токен группы inк</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->group_token}}" id="group_token" name="">
					                </div>
					            </div> 
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Каonл тг</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->tg_id}}" id="tg_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>БFrom тг</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->tg_bot_id}}" id="tg_bot_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Токен бFromа тг</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->tg_token}}" id="tg_token" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>FK ID</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->fk_id}}" id="fk_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>FK SECRET 1</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->fk_secret_1}}" id="fk_secret_1" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>FK SECRET 2</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->fk_secret_2}}" id="fk_secret_2" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Piastix ID</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->piastrix_id}}" id="piastrix_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Piastix SECRET</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->piastrix_secret}}" id="piastrix_secret" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Айдand магазandon GamePay</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->gamepay_shop_id}}" id="gamepay_shop_id" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>API KEY GamePay</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->gamepay_api_key}}" id="gamepay_api_key" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Bonus for регandстрацandю</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->bonus_reg}}" id="bonus_reg" name="">
					                </div>
					            </div>
							</div>

							

							<div class="col-5 col-lg-3 mb-20">
								<label>Bonus for подпandску on группу inК and ТГ</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->bonus_group}}" id="bonus_group" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Депозandт для переinоYes средстin</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->dep_transfer}}" id="dep_transfer" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Депозandт для созYesнandя промокоYes</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->dep_createpromo}}" id="dep_createpromo" name="">
					                </div>
					            </div>
							</div>
 
						</div>

						<div class="flex no_padding wrap" style="margin-bottom: 10px;">
							<div class="col-lg-5 d-comp"></div>
							<div class="col-lg-5">						
								<div class="flex no_padding">
									<div class="w-100 d-comp"></div>
									<button onclick="saveSetting();" class="btn-auth w-100" ><span class="">Save</span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
