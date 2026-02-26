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
								<button class="btn-auth w-100" onclick="load('admin/settings_bonus');">Settings Bonusа</button>
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
								<label>Шанс on inыпаденandе 1р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_1}}" id="chance_1" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 3р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_3}}" id="chance_3" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 5р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_5}}" id="chance_5" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 8р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_8}}" id="chance_8" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 10р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_10}}" id="chance_10" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 15р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_15}}" id="chance_15" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 25р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_25}}" id="chance_25" name="">
					                </div>
					            </div>
							</div>

							<div class="col-5 col-lg-3 mb-20">
								<label>Шанс on inыпаденandе 50р</label>
								<div class="flex no_padding wrap">
					                <div style="position:relative;margin-top: 10px;" class="col">
					                    <input type="" class="secodary_input" value="{{$setting->chance_50}}" id="chance_50" name="">
					                </div>
					            </div>
							</div>

							
 
						</div>

						<div class="flex no_padding wrap" style="margin-bottom: 10px;">
							<div class="col-lg-5 d-comp"></div>
							<div class="col-lg-5">						
								<div class="flex no_padding">
									<div class="w-100 d-comp"></div>
									<button onclick="saveBonus();" class="btn-auth w-100" ><span class="">Save</span></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
