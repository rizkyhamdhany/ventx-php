<div class="margin-top-10">
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_name') ? 'has-error' : ' ' }}">
            <label class="control-label">Full Name</label>
            <input name="contact_name" value="{{ old('contact_name')}}" type="text" id="firstName" class="form-control" placeholder="Fullname" required>
            <span class="help-block"> Please insert your name correctly </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_phone') ? 'has-error' : ' ' }}">
            <label class="control-label">Phone Number</label>
            <div class="input-group">
                <span class="input-group-addon">
                    +62
                </span>
                <input name="contact_phone" value="{{ old('contact_phone') }}" type="phone" class="form-control"
                       placeholder="Phone Number" required></div>
            <span class="help-block"> Please insert your phone correctly </span>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="margin-top-bottom-30">
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_email') ? 'has-error' : ' ' }}">
            <label class="control-label">Email</label>
            <div class="input-group">
                <span class="input-group-addon addon-email">
                    <i class="fa fa-envelope"></i>
                </span>
                <input name="contact_email" value="{{ old('contact_email') }}" type="email" class="form-control"
                       placeholder="Email Address" required></div>
            <span class="help-block"> Please insert your email correctly </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_birthday_year') | $errors->has('contact_birthday_month') | $errors->has('contact_birthday_') ? 'has-error' : ' ' }}">
            <label class="control-label">Birthday</label>
            <div class="input-group">
                <input type="text" name="contact_birthday" value="" class="basic"/>
            </div>
            <span class="help-block"> Please insert your Birthday correctly </span>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="margin-top-10">
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_address') ? 'has-error' : ' ' }}">
            <label class="control-label">Address</label>
            <input name="contact_address" value="{{ old('contact_address') }}" type="text" id="address" class="form-control"
                   placeholder="Address" required>
            <span class="help-block"> Please insert your Address correctly </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_country') ? 'has-error' : ' ' }}">
            <label class="control-label">Country</label>
            <input name="contact_country" value="{{ old('contact_country') }}" type="text" id="country" class="form-control"
                   placeholder="Country" required>
            <span class="help-block"> Please insert Country correctly </span>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="margin-top-10 margin-top-bottom-30">
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_city') ? 'has-error' : ' ' }}">
            <label class="control-label">City</label>
            <input name="contact_city" value="{{ old('contact_city') }}" type="text" id="city" class="form-control"
                   placeholder="City" required>
            <span class="help-block"> Please insert City correctly </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{$errors->has('contact_postal_code') ? 'has-error' : ' ' }}">
            <label class="control-label">Postal Code</label>
            <input name="contact_postal_code" value="{{ old('contact_postal_code') }}" type="number" id="postalcode" class="form-control"
                   placeholder="Postal Code" pattern="[0-9]{10}" required>
            <span class="help-block"> Please insert Postal Code correctly </span>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
