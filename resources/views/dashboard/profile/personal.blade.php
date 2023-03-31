<div class="row portlet rounded p-3">
    <div class="col-8">
        <div class="d-flex align-items-center">
            <div class="rounded-circle u-avatar">
                <img src="/uploads/1670838121.png" width="70" alt="A" />
            </div>
            <div class="px-4">
                <div>{{ auth()->user()->name }}</div>
                <div>{{ auth()->user()->email }}</div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="float-right">
            <button class="btn btn-outline-primary px-5 mr-auto">
                Edit
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 client mt-5">
        <h4>Client</h4>
        <div class="portlet row rounded p-3">
            <div class="form-group col-sm-6">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="usertitle">Title</label>
                <input type="text" class="form-control" id="usertitle" placeholder="" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 client mt-5">
        <h4>Contact Info</h4>
        <div class="portlet row rounded p-3">
            <div class="form-group col-sm-6">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="email">E-mail address</label>
                <input type="email" class="form-control" id="email" placeholder="" />
            </div>
            <div class="form-group col-sm-6">
                <label for="country">Country</label>
                <select class="form-control" id="country">
                  <option>Ukraine</option>
                  <option>US</option>
                  <option>Uk</option>
                </select>
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
        </div>
    </div>
</div>

<div class="d-flex justify-content-center w-100 my-5">
    <button class="btn btn-outline-primary px-5">Save</button>
</div>
