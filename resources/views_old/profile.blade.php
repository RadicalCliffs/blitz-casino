@auth
@php
	$userStatus = \Auth::user()->status;
	$name_surname = explode(' ', \Auth::user()->name);
	if($userStatus != 0){
		$status = \App\Status::where('id', $userStatus)->first();
		
	}
	$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);

@endphp
<div class="content" >
	<div class="flex ">
		<div class="col-menu-lg">

		</div>
		<div class="col" style="max-width: 700px;margin: 10px auto;position:relative;">
			<div class="flex no_padding wrap">
				<div class="col-lg-250px">
					<div class="avatarUserProfile">
						@if(\Auth::user()->status == 0) <div class="userStatus">Newbie</div> @else <div class="userStatus" style="color:{{$status->color}}">{{$status->name}}</div> @endif
						
						<img src="img/profile/avaUserProfile.png" class="avaUserProfile">
						<img src="{{\Auth::user()->avatar}}" class="imgAvatar">
					</div>
					<div class="nameUserProfile">
						<span class="nameUser">{{$name_surname[0]}}</span>
						<span class="nameUser">{{$name_surname[1]}}</span>

						<span class="idUser" style="margin-bottom:10px">ID: {{\Auth::user()->id}}</span>
					</div>
				</div>
				<div class="col-lg-100-250px">
					<div class="flex no_padding wrap" style="margin-bottom: 10px;">
						<div class="col-5">
							<div class="statBlockUser">
								<span class="titleStat">Deposit</span>
								<span class="numberStat">{{\Auth::user()->deps}}</span>
							</div>
						</div>
						<div class="col-5">
							<div class="statBlockUser">
								<span class="titleStat">Withdrawal</span>
								<span class="numberStat">{{\Auth::user()->withdraws}}</span>
							</div>
						</div>
					</div>

					<div class="flex no_padding wrap" style="margin-bottom: 10px;">
						<div class="col-5">
							<div class="statBlockUser">
								<span class="titleStat">Общandй inыandгрыш</span>
								<span class="numberStat">{{\Auth::user()->sum_win}}</span>
							</div>
						</div>
						<div class="col-5">
							<div class="statBlockUser">
								<span class="titleStat">Макс. inыandгрыш</span>
								<span class="numberStat">{{\Auth::user()->max_win}}</span>
							</div>
						</div>
					</div>

					<div class="flex no_padding wrap" >
						<div class="col-4">
							<div class="statBlockUser">
								<span class="titleStat">Рейтandнг побед</span>
								<span class="numberStat">@if($gamesAll == 0) 0 @else{{(round(\Auth::user()->win_games / $gamesAll, 2) * 100)}}@endif %</span>
							</div>
						</div>
						<div class="col-4">
							<div class="statBlockUser">
								<span class="titleStat">Средняя стаinка</span>
								<span class="numberStat">@if($gamesAll == 0) 0 @else{{(round(\Auth::user()->sum_bet / $gamesAll, 2))}} @endif</span>
							</div> 
						</div> 
						<div class="col-4">
							<div class="statBlockUser">
								<span class="titleStat">inсего andгр</span>
								<span class="numberStat">{{(\Auth::user()->win_games + \Auth::user()->lose_games)}}</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="bgWave"></div>

			<div class="flex no_padding wrap" style="margin-top:20px;">
				<div class="col-lg-5" style="margin-bottom:20px">
					<label style="margin-bottom:10px;display: block;">Profile</label>
					<div class="settingCheck">
						<input type="checkbox" class="custom-checkbox" onchange="changeSetting(1)" id="setting1" name="setting1" >
						<label class="checkboxProfile" for="setting1">Не показыinать чужandе аinатаркand</label>
					</div>
					<!-- <div class="settingCheck">
						<input type="checkbox" class="custom-checkbox" onchange="changeSetting(2)" id="setting2" name="setting2">
						<label class="checkboxProfile" for="setting2">Не показыinать сinою аinатарку другandм</label>
					</div> -->
					<!-- <div class="settingCheck">
						<input type="checkbox" class="custom-checkbox" onchange="changeSetting(3)" id="setting3" name="setting3">
						<label class="checkboxProfile" for="setting3">inыключandть зinукand</label>
					</div> -->
				</div>
				<script type="text/javascript">
					function changeSetting(id) {
						if($('#setting'+id+'').is(":checked")){
							localStorage.setItem('setting'+id+'', 1);
							if(id == 1){
								$('body').addClass('blur_img')
							}
						}else{
							localStorage.setItem('setting'+id+'', 0);
							if(id == 1){
								$('body').removeClass('blur_img')
							}
						}
					}
					if(localStorage.getItem('setting1') == 1){
						$('#setting1').attr('checked', '')
					}
					if(localStorage.getItem('setting2') == 1){
						$('#setting2').attr('checked', '')
					}
					if(localStorage.getItem('setting3') == 1){
						$('#setting3').attr('checked', '')
					}

					function changeTheme(dark, that){
						localStorage.setItem('setting_theme', dark);
						$('.themeSelectItem').removeClass('select')
						$(that).addClass('select')
						if (dark == 0){
							$('#themeSite').attr('href','css/light.css')
						}else{
							$('#themeSite').attr('href','css/dark.css?v=34')
						}
					}

					
				</script>
				<div class="col-lg-5">
					<label style="margin-bottom:10px;display: block;">Тема</label>
					<div class="themeSelectBlock">
						<div class="themeSelectItem lightTheme" onclick="changeTheme(0, this)">Сinетлая</div>
						<div class="themeSelectItem darkTheme" onclick="changeTheme(1, this)">Тёмonя</div>
					</div>
				</div>
				<script type="text/javascript">
					dark = localStorage.getItem('setting_theme')
				    if (dark != 1){
				        $('.lightTheme').addClass('select')
				    }else{
				        $('.darkTheme').addClass('select')
				    }
				</script>
			</div>
		</div>

	</div>
</div> 

@else
<script type="text/javascript">location.href='/';</script>
@endauth
