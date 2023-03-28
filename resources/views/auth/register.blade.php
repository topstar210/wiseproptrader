<!DOCTYPE html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Wisepro Trader Register form</title>
  <link rel="stylesheet" href="{{asset('css/register.css')}}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .container {
    width: var(--containerWidth);
    background: #000;
    text-align: center;
    border: solid #55cfd3!important;
    border-radius: 5px;
    padding: 50px 35px 10px 35px;
}
.container .progress-bar .step p {
    font-weight: 500;
    font-size: 18px;
    color: #fff;
    margin-bottom: 8px;
}
.container header {
    font-size: 35px;
    font-weight: 600;
    color: #fff;
    margin: 0 0 30px 0;
}
.progress-bar .step .bullet {
    height: 25px;
    width: 25px;
    border: 2px solid #55cfd3;
    display: inline-block;
    border-radius: 50%;
    position: relative;
    transition: 0.2s;
    font-weight: 500;
    font-size: 17px;
    line-height: 25px;
}
.progress-bar .step .bullet:before, .progress-bar .step .bullet:after {
    position: absolute;
    content: "";
    bottom: 11px;
    right: -51px;
    height: 3px;
    width: 44px;
    background: #55cfd3;
}
form .page .field .label {
    position: absolute;
    top: -30px;
    color: #fff;
    font-weight: 500;
}
.form-outer form .page .title {
    text-align: left;
    font-size: 25px;
    font-weight: 500;
    color: #fff;
}
.container .progress-bar .step {
    text-align: center;
    width: 100%;
    position: relative;
    color: #fff;
}
form .page .field button {
    width: 100%;
    height: calc(100% + 5px);
    border: none;
    background: #55cfd3;
    margin-top: -20px;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: 0.5s ease;
}
a.btn.btn-success {
    padding: 6px 21px 18px 21px;
    border-radius: 10px;
}
.container .form-outer {
    width: 100%;
    overflow: hidden;
    height: 50vh;
}
label.form-control-label.pt-3 {
    color: #fff;
}
</style>
</head>
<body style="background: #000; background-repeat: no-repeat; background-size:cover">
        @if (Session::has('message'))
	<div id="showMessage" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px;">
		<button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
			<span aria-hidden="true">×</span><span class="sr-only">Close</span>
		</button>
		{{Session::get('message')}}
	</div>
	@endif

	<div id="showError" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px; color:red; font-size: 16px; display:none">
		<button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
			<span aria-hidden="true">×</span><span class="sr-only">Close</span>
		</button>
		<div id="errormsg"></div>
	</div>
        <div class="container">
            <header><img src="https://app.wiseproptrader.com/public/uploads/{{$app_settings['logo_path']??''}}" alt="" style="width: 306px!important;height: 111px!important;margin-left: 17px!important"></header>
            <div class="progress-bar">
                <div class="step">
                    <p>Step</p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Step</p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Step</p>
                    <div class="bullet">
                        <span>3</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Submit</p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
            </div>

            <div class="form-outer">
                <form action="{{ route('register') }}" target="_blank" method="post">
                    @csrf
					<input type="hidden" value="<?php echo $_GET['order_id']; ?>" name="orderid">
                    <div class="page slide-page">
                        
                        <div class="field">
                            <div class="label">First Name</div>
                            <input class="@error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
                        </div>
                        <div class="field">
                            <div class="label">{{ __('Phone Number') }}</div>
                            <input class="@error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        </div>
                        <div class="field">
                            <div class="label">{{ __('E-Mail Address') }}</div>
                            <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
                        </div>
                        <div class="field">
                            <button class="firstNext next">Next</button>
                        </div>
                    </div>

                    <div class="page">
                        
                        
                        <div class="field">
                            <div class="label">{{ __('Country') }}</div>
                            <select id="country" name="country" required>
                                <option>Select Your Country</option>
								<option value="AF">Afghanistan</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AS">American Samoa</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas (the)</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="BY">Belarus</option>
								<option value="BE">Belgium</option>
								<option value="BZ">Belize</option>
								<option value="BJ">Benin</option>
								<option value="BM">Bermuda</option>
								<option value="BT">Bhutan</option>
								<option value="BO">Bolivia (Plurinational State of)</option>
								<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
								<option value="BA">Bosnia and Herzegovina</option>
								<option value="BW">Botswana</option>
								<option value="BV">Bouvet Island</option>
								<option value="BR">Brazil</option>
								<option value="IO">British Indian Ocean Territory (the)</option>
								<option value="BN">Brunei Darussalam</option>
								<option value="BG">Bulgaria</option>
								<option value="BF">Burkina Faso</option>
								<option value="BI">Burundi</option>
								<option value="CV">Cabo Verde</option>
								<option value="KH">Cambodia</option>
								<option value="CM">Cameroon</option>
								<option value="CA">Canada</option>
								<option value="KY">Cayman Islands (the)</option>
								<option value="CF">Central African Republic (the)</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CN">China</option>
								<option value="CX">Christmas Island</option>
								<option value="CC">Cocos (Keeling) Islands (the)</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros (the)</option>
								<option value="CD">Congo (the Democratic Republic of the)</option>
								<option value="CG">Congo (the)</option>
								<option value="CK">Cook Islands (the)</option>
								<option value="CR">Costa Rica</option>
								<option value="HR">Croatia</option>
								<option value="CU">Cuba</option>
								<option value="CW">Curaçao</option>
								<option value="CY">Cyprus</option>
								<option value="CZ">Czechia</option>
								<option value="CI">Côte d'Ivoire</option>
								<option value="DK">Denmark</option>
								<option value="DJ">Djibouti</option>
								<option value="DM">Dominica</option>
								<option value="DO">Dominican Republic (the)</option>
								<option value="EC">Ecuador</option>
								<option value="EG">Egypt</option>
								<option value="SV">El Salvador</option>
								<option value="GQ">Equatorial Guinea</option>
								<option value="ER">Eritrea</option>
								<option value="EE">Estonia</option>
								<option value="SZ">Eswatini</option>
								<option value="ET">Ethiopia</option>
								<option value="FK">Falkland Islands (the) [Malvinas]</option>
								<option value="FO">Faroe Islands (the)</option>
								<option value="FJ">Fiji</option>
								<option value="FI">Finland</option>
								<option value="FR">France</option>
								<option value="GF">French Guiana</option>
								<option value="PF">French Polynesia</option>
								<option value="TF">French Southern Territories (the)</option>
								<option value="GA">Gabon</option>
								<option value="GM">Gambia (the)</option>
								<option value="GE">Georgia</option>
								<option value="DE">Germany</option>
								<option value="GH">Ghana</option>
								<option value="GI">Gibraltar</option>
								<option value="GR">Greece</option>
								<option value="GL">Greenland</option>
								<option value="GD">Grenada</option>
								<option value="GP">Guadeloupe</option>
								<option value="GU">Guam</option>
								<option value="GT">Guatemala</option>
								<option value="GG">Guernsey</option>
								<option value="GN">Guinea</option>
								<option value="GW">Guinea-Bissau</option>
								<option value="GY">Guyana</option>
								<option value="HT">Haiti</option>
								<option value="HM">Heard Island and McDonald Islands</option>
								<option value="VA">Holy See (the)</option>
								<option value="HN">Honduras</option>
								<option value="HK">Hong Kong</option>
								<option value="HU">Hungary</option>
								<option value="IS">Iceland</option>
								<option value="IN">India</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran (Islamic Republic of)</option>
								<option value="IQ">Iraq</option>
								<option value="IE">Ireland</option>
								<option value="IM">Isle of Man</option>
								<option value="IL">Israel</option>
								<option value="IT">Italy</option>
								<option value="JM">Jamaica</option>
								<option value="JP">Japan</option>
								<option value="JE">Jersey</option>
								<option value="JO">Jordan</option>
								<option value="KZ">Kazakhstan</option>
								<option value="KE">Kenya</option>
								<option value="KI">Kiribati</option>
								<option value="KP">Korea (the Democratic People's Republic of)</option>
								<option value="KR">Korea (the Republic of)</option>
								<option value="KW">Kuwait</option>
								<option value="KG">Kyrgyzstan</option>
								<option value="LA">Lao People's Democratic Republic (the)</option>
								<option value="LV">Latvia</option>
								<option value="LB">Lebanon</option>
								<option value="LS">Lesotho</option>
								<option value="LR">Liberia</option>
								<option value="LY">Libya</option>
								<option value="LI">Liechtenstein</option>
								<option value="LT">Lithuania</option>
								<option value="LU">Luxembourg</option>
								<option value="MO">Macao</option>
								<option value="MG">Madagascar</option>
								<option value="MW">Malawi</option>
								<option value="MY">Malaysia</option>
								<option value="MV">Maldives</option>
								<option value="ML">Mali</option>
								<option value="MT">Malta</option>
								<option value="MH">Marshall Islands (the)</option>
								<option value="MQ">Martinique</option>
								<option value="MR">Mauritania</option>
								<option value="MU">Mauritius</option>
								<option value="YT">Mayotte</option>
								<option value="MX">Mexico</option>
								<option value="FM">Micronesia (Federated States of)</option>
								<option value="MD">Moldova (the Republic of)</option>
								<option value="MC">Monaco</option>
								<option value="MN">Mongolia</option>
								<option value="ME">Montenegro</option>
								<option value="MS">Montserrat</option>
								<option value="MA">Morocco</option>
								<option value="MZ">Mozambique</option>
								<option value="MM">Myanmar</option>
								<option value="NA">Namibia</option>
								<option value="NR">Nauru</option>
								<option value="NP">Nepal</option>
								<option value="NL">Netherlands (the)</option>
								<option value="NC">New Caledonia</option>
								<option value="NZ">New Zealand</option>
								<option value="NI">Nicaragua</option>
								<option value="NE">Niger (the)</option>
								<option value="NG">Nigeria</option>
								<option value="NU">Niue</option>
								<option value="NF">Norfolk Island</option>
								<option value="MP">Northern Mariana Islands (the)</option>
								<option value="NO">Norway</option>
								<option value="OM">Oman</option>
								<option value="PK">Pakistan</option>
								<option value="PW">Palau</option>
								<option value="PS">Palestine, State of</option>
								<option value="PA">Panama</option>
								<option value="PG">Papua New Guinea</option>
								<option value="PY">Paraguay</option>
								<option value="PE">Peru</option>
								<option value="PH">Philippines (the)</option>
								<option value="PN">Pitcairn</option>
								<option value="PL">Poland</option>
								<option value="PT">Portugal</option>
								<option value="PR">Puerto Rico</option>
								<option value="QA">Qatar</option>
								<option value="MK">Republic of North Macedonia</option>
								<option value="RO">Romania</option>
								<option value="RU">Russian Federation (the)</option>
								<option value="RW">Rwanda</option>
								<option value="RE">Réunion</option>
								<option value="BL">Saint Barthélemy</option>
								<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KN">Saint Kitts and Nevis</option>
								<option value="LC">Saint Lucia</option>
								<option value="MF">Saint Martin (French part)</option>
								<option value="PM">Saint Pierre and Miquelon</option>
								<option value="VC">Saint Vincent and the Grenadines</option>
								<option value="WS">Samoa</option>
								<option value="SM">San Marino</option>
								<option value="ST">Sao Tome and Principe</option>
								<option value="SA">Saudi Arabia</option>
								<option value="SN">Senegal</option>
								<option value="RS">Serbia</option>
								<option value="SC">Seychelles</option>
								<option value="SL">Sierra Leone</option>
								<option value="SG">Singapore</option>
								<option value="SX">Sint Maarten (Dutch part)</option>
								<option value="SK">Slovakia</option>
								<option value="SI">Slovenia</option>
								<option value="SB">Solomon Islands</option>
								<option value="SO">Somalia</option>
								<option value="ZA">South Africa</option>
								<option value="GS">South Georgia and the South Sandwich Islands</option>
								<option value="SS">South Sudan</option>
								<option value="ES">Spain</option>
								<option value="LK">Sri Lanka</option>
								<option value="SD">Sudan (the)</option>
								<option value="SR">Suriname</option>
								<option value="SJ">Svalbard and Jan Mayen</option>
								<option value="SE">Sweden</option>
								<option value="CH">Switzerland</option>
								<option value="SY">Syrian Arab Republic</option>
								<option value="TW">Taiwan</option>
								<option value="TJ">Tajikistan</option>
								<option value="TZ">Tanzania, United Republic of</option>
								<option value="TH">Thailand</option>
								<option value="TL">Timor-Leste</option>
								<option value="TG">Togo</option>
								<option value="TK">Tokelau</option>
								<option value="TO">Tonga</option>
								<option value="TT">Trinidad and Tobago</option>
								<option value="TN">Tunisia</option>
								<option value="TR">Turkey</option>
								<option value="TM">Turkmenistan</option>
								<option value="TC">Turks and Caicos Islands (the)</option>
								<option value="TV">Tuvalu</option>
								<option value="UG">Uganda</option>
								<option value="UA">Ukraine</option>
								<option value="AE">United Arab Emirates (the)</option>
								<option value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
								<option value="UM">United States Minor Outlying Islands (the)</option>
								<option value="US">United States of America (the)</option>
								<option value="UY">Uruguay</option>
								<option value="UZ">Uzbekistan</option>
								<option value="VU">Vanuatu</option>
								<option value="VE">Venezuela (Bolivarian Republic of)</option>
								<option value="VN">Viet Nam</option>
								<option value="VG">Virgin Islands (British)</option>
								<option value="VI">Virgin Islands (U.S.)</option>
								<option value="WF">Wallis and Futuna</option>
								<option value="EH">Western Sahara</option>
								<option value="YE">Yemen</option>
								<option value="ZM">Zambia</option>
								<option value="ZW">Zimbabwe</option>
								<option value="AX">Åland Island</option>
                            </select>
                        </div>
                        <div class="field btns">
                            <button class="prev-1 prev">Previous</button>
                            <button class="next-1 next">Next</button>
                        </div>
                    </div>
                    <div class="page">
                        
                        <div class="field">
                            <div class="label">{{ __('Address') }}</div>
                            <input class="@error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                        </div>
                        <div class="field">
                            <div class="label">Currency</div>
                            <select name="userCurrency" id="userCurrency">
								<option></option>
								<option value="USD">USD</option>
								<option value="GBP">GBP</option>
								<option value="EUR">EUR</option>
							</select>
                        </div>
                        <div class="field btns">
                            <button class="prev-2 prev">Previous</button>
                            <button class="next-2 next">Next</button>
                        </div>
                    </div>
                    

                    <div class="page">
                        
                        <div class="field">
                            <div class="label">{{ __('Password') }}</div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
                        </div>
                        <div class="field">
                            <div class="label">{{ __('Confirm Password') }}</div>
                            <input id="password-confirm" type="password" class="form-control " name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="field">
                            {{ html()->label('Referal Code<span class="text-info"> (Optional)</span>')->class('form-control-label pt-3')->for('referalCode') }}
							{{ html()->text('referalCode')
									->class('form-control')
									->placeholder('Referal Code')
									->attribute('maxlength', 15) }}
                        </div>
                        <div class="field btns">
                            <button class="prev-5 prev">Previous</button>
                            <button type="submit" class="submit crypt-button-red-full">{{ __('Register') }}</button>
                        </div>
                        
                    </div>
                    
                </form>
                <div class="field btns">
                    <a class="btn btn-success" href="{{ route('login') }}?&order_id=<?php echo $_GET['order_id']; ?>" style="color: #fff;font-size: 20px;background: #55cfd3;text-decoration: none;">{{ __('Log In') }}</a>
                </div>
            </div>

 <!--<br> <span style="color:#fff;font-size:14px;">Please Make a payment first to create ID, Or contact with author</span> <br>-->
 <!--	<p class=""><a  href="{{ route('login') }}">{{ __('Log In') }}</a></p>-->
        </div>
        <script>
            initMultiStepForm();

function initMultiStepForm() {
    const progressNumber = document.querySelectorAll(".step").length;
    const slidePage = document.querySelector(".slide-page");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    const pages = document.querySelectorAll(".page");
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const stepsNumber = pages.length;

    if (progressNumber !== stepsNumber) {
        console.warn(
            "Error, number of steps in progress bar do not match number of pages"
        );
    }

    document.documentElement.style.setProperty("--stepNumber", stepsNumber);

    let current = 1;

    for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener("click", function (event) {
            event.preventDefault();

            inputsValid = validateInputs(this);
            // inputsValid = true;

            if (inputsValid) {
                slidePage.style.marginLeft = `-${
                    (100 / stepsNumber) * current
                }%`;
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });
    }

    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener("click", function (event) {
            event.preventDefault();
            slidePage.style.marginLeft = `-${
                (100 / stepsNumber) * (current - 2)
            }%`;
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    }
    submitBtn.addEventListener("click", function () {
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
        setTimeout(function () {
            alert("Your Form Successfully Signed up");
            location.reload();
        }, 800);
    });

    function validateInputs(ths) {
        let inputsValid = true;

        const inputs =
            ths.parentElement.parentElement.querySelectorAll("input");
        for (let i = 0; i < inputs.length; i++) {
            const valid = inputs[i].checkValidity();
            if (!valid) {
                inputsValid = false;
                inputs[i].classList.add("invalid-input");
            } else {
                inputs[i].classList.remove("invalid-input");
            }
        }
        return inputsValid;
    }
}

        </script>
    </body>
</html>
