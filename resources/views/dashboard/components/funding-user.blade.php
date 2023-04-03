<div class="row">
    <div class="form-group col-sm-6">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" placeholder="" />
    </div>
    @if ($flag == "1")
    <div class="col-12">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control" id="company_name" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="business_name">Business Number</label>
                <input type="text" class="form-control" id="business_name" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="vat_number">VAT Name</label>
                <input type="text" class="form-control" id="vat_number" placeholder="" />
            </div>
        </div>
    </div>
    @endif
    <div class="form-group col-sm-6">
        <label for="email">E-mail address</label>
        <input type="text" class="form-control" id="email" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="phone_number">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="street">Street</label>
        <input type="text" class="form-control" id="street" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="postal_code">Postal Code</label>
        <input type="text" class="form-control" id="postal_code" placeholder="" />
    </div>
    <div class="form-group col-sm-6">
        <label for="country">Country</label>
        <select class="form-control" id="country">
            <option>Ukraine</option>
            <option>US</option>
            <option>Uk</option>
        </select>
    </div>
    <div class="form-group col-sm-12">
        <label for="note">Note</label>
        <input type="text" class="form-control" id="note" placeholder="" />
    </div>
    <div class="form-group col-sm-12">
        <label for="postal_code">Payment Currency</label>
        <div class="row">
            <div class="col-sm-2 col-md-3 mb-3">
                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                    <img src="/images/flags/united-states.png" width="25px"
                        alt="">
                    <div class="px-2">USD</div>
                </div>
            </div>
            <div class="col-sm-2 col-md-3 mb-3">
                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                    <img src="/images/flags/european-union.png" width="25px"
                        alt="">
                    <div class="px-2">EUR</div>
                </div>
            </div>
            <div class="col-sm-2 col-md-3 mb-3">
                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                    <img src="/images/flags/united-kingdom.png" width="25px"
                        alt="">
                    <div class="px-2">GBP</div>
                </div>
            </div>
            <div class="col-sm-2 col-md-3 mb-3">
                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                    <img src="/images/flags/czech-republic.png" width="25px"
                        alt="">
                    <div class="px-2">CZK</div>
                </div>
            </div>
        </div>
    </div>
</div>