<style>
.ui-autocomplete {
    z-index: 5000;
}
div.error {
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color: #FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
}
</style>
<div id="registrationModal" class="modal c-modal c-custom white">
	<div class="c-modal-content white">
		<div class="row marginSet">
			<div id="registerField" class="col l7 m12 s12">
				<h5 class="center-align">Become a member</h5>
			    <form class="col m12 s12" method="POST" action="" id="registrationForm">
			    	<div class="row">
				        <div class="input-field col l6 m12 s12">
				          <input id="username" type="text" class="validate hide" name="username">
				          <label for="first_name">First Name</label>
				          <input id="first_name" type="text" name="first_name" data-error=".errorTxt1">
				          <div class="errorTxt1 col l12"></div>
				        </div>
				        <div class="input-field col l6 m12 s12">
				          <label for="middle_name">Middle Name</label>
				          <input id="middle_name" type="tel" name="middle_name" data-error=".errorTxt2">
				          <div class="errorTxt2 col l12"></div>
				        </div>
				    </div>
				    <div class="row">
				        <div class="input-field col l6 m12 s12">
				          <label for="last_name">Last Name</label>
				          <input id="last_name" type="text" name="last_name" data-error=".errorTxt3"> 
				          <div class="errorTxt3 col l12"></div>
				        </div>
				        <div class="input-field col l6 m12 s12">
				          <label for="email_address">Email Address</label>
				          <input id="email_address" type="email" name="email_address" data-error=".errorTxt4">
				          <div class="errorTxt4 col l12"></div>
				        </div>
				    </div>
				    <div class="row">
				        <div class="input-field col l6 m12 s12">
				          <label for="password">Password</label>
				          <input id="password" type="password" name="password" data-error=".errorTxt5">
				          <div class="errorTxt5 col l12"></div>
				        </div>
				        <div class="input-field col l6 m12 s12 country">
				            <label for="country">Country</label>
				        	<input id="country" type="text" name="country" data-error=".errorTxt6">
				        	<div class="errorTxt6 col l12"></div>
				        </div>
				    </div>
			        <input id="account_type_ID" type="text" class="validate hide" name="account_type_ID" value="3">
			        <input id="status" type="text" class="validate hide" name="status" value="2">
					<!--<div class="col m12">
			        	<div class="g-recaptcha" data-sitekey="6LdvvSMTAAAAABPTLBegLzB_ZcJGHBDOzv6fK3DX"></div>
			        </div> -->
			        <div class="col m6 s12">
			        	<button class="btn waves-effect waves-light red darken-1">REGISTER</button>
			        </div>
			        <div class="col m6 s12">
			        	<span class="green-text" id="success-module">Registered!</span>
			        </div>
			    </form>
			</div>
			<div id="loginField" class="col l7 m12 s12">
				<h5 class="center-align">Member login</h5>
			    <form class="col m12 s12" method="POST" action="" id="loginForm">
			    	<div class="row">
				        <div class="input-field col l12 m12 s12">
				          <label for="username">Username</label>
				          <input id="username" type="text" name="username" data-error=".errorTxt7">
				          <div class="errorTxt7 col l12"></div>
				        </div>
				        <div class="input-field col l12 m12 s12">
				          <label for="password">Password</label>
				          <input id="password" type="password" name="password" data-error=".errorTxt8">
				          <div class="errorTxt8 col l12"></div>
				        </div>
				    </div>
					<!--<input id="account_type_ID" type="text" class="validate hide" name="account_type_ID" value="3">
			        <input id="status" type="text" class="validate hide" name="status" value="2"> -->
					<!--<div class="col m12">
			        	<div class="g-recaptcha" data-sitekey="6LdvvSMTAAAAABPTLBegLzB_ZcJGHBDOzv6fK3DX"></div>
			        </div> -->
			        <div class="col m6 s12 ">
			        	<button class="btn waves-effect waves-light red darken-1">Log In</button>
			        </div>
			    </form>
			</div>
			<div class="c-image-wrapper hide-on-med-and-down" class="col l4 m4">
				<img class="regImage" src="<?=asset_url("image/side.png")?>"><img>
			</div>
		</div>
	</div>
</div>