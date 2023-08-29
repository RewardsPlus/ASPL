<form action="{{route('admin.')}}" method="post">
    @csrf
    <div class="col-12 p-0">
        <!-- store Name -->
        <div class="form-group">
            <div class="col-12 d-flex flex-wrap">
                <div class="col-12 d-flex">
                    <div class="col-4 p-1">
                        <label for="example_input_full_name">Country:</label>
                        <div class="selectdiv">
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="">Select Type</option>
                                <option value="100">India </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4 p-1">
                        <label for="example_input_full_name">State:</label>
                        <div class="selectdiv">
                            <select class="form-control" id="state_id" name="state_id">
                                <option value="">Select Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4 p-1">
                        <label for="example_input_full_name">City:</label>
                        <div class="selectdiv">
                            <select class="form-control" id="city_id" name="city_id">
                                <option value="">Select Type</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="example_input_full_name">Store Name :</label>
                    <input type="text" name="store_name" value="{{$store->name??''}}" id="store_name" placeholder="Ex: Store One"
                        class="form-control">
                </div>
                
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Set Store Url
                        :<small>https://store.rewardsplus.in/store/</small></label>
                    <input type="text" name="store_url" id="store_url" value="{{$store->detail->store_url??''}}" placeholder="store-one" class="form-control "
                        onblur="check_storeurl()">
                    <label>REMINDER : The URL extension which you are setting up should be unique and
                        easy
                        to remember. This URL will be final and you would not be able to change it
                        later.</label>
                    <div id="urlCheck"></div>
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Pincode :</label>
                    <div class="selectdiv">
                        <select class="form-control pincode select2-hidden-accessible" id="m_select2_pincode"
                            name="pincode" multiple="" data-select2-id="m_select2_pincode" tabindex="-1"
                            aria-hidden="true">
                            <option value=""> Select Pincode</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Address :</label>
                    <input type="text" name="address" value="{{$store->detail->address??''}}" id="address" placeholder="Address" class="form-control ">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Latitude:</label>
                    <input class="form-control" id="lat" value="{{$store->detail->lat??''}}" name="lat" placeholder="Latitude" type="text">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Longitude :</label>
                    <input type="text" name="lon" id="lon" value="{{$store->detail->lon??''}}" placeholder="Longitude" class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">City Name :</label>
                    <input type="text" name="city_name" value="{{$store->detail->city_name??''}}" id="city_name" placeholder="City Name" class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Email:</label>
                    <input type="text" name="email" value="{{$store->email}}" id="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Store Contact Number:</label>
                    <input type="text" name="contact" value="{{$store->mobile}}" id="contact" placeholder="Telephone/Mobile Number"
                        class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Password:</label>
                    <input type="password" name="password" value="{{$store->password??''}}" id="password" placeholder="Enter Password"
                        class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Store Code:</label>
                    <input type="text" name="code" id="code" value="{{$store->detail->code??''}}" placeholder="Code" class="form-control">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Store Manager:</label>
                    <input type="text" name="manager" value="{{$store->detail->manager_name??''}}" id="manager" placeholder="Manager" class="form-control">
                </div>
                <div class="form-group  col-6 p-1">
                    <label for="example_input_full_name">Photo:</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Ratting:</label>
                    <input type="text" class="form-control" id="ratting" name="ratting">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">GST No:</label>
                    <input type="text" class="form-control" value="{{$store->detail->gst_no??''}}" id="gst_no" name="gst_no">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Coupon Code:</label>
                    <input type="text" class="form-control" id="coupon_code" name="coupon_code">
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Store Verification::</label>
                    <div class="selectdiv">
                        <select class="form-control" id="is_verified" name="is_verified">
                            <option value="2">Not Verify</option>
                            <option value="1">Verify</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6 p-1">
                    <label for="example_input_full_name">Company Name::</label>
                    <div class="selectdiv">
                        <select class="form-control" id="is_verified" name="company_name">
                            <option>Select Company Name</option>
                            @foreach($company as $company)
                            <option value="{{$company->company_id}}" {{isset($store)? ($store->company_id == $company->id ? 'selected' :''):''}}>{{$company->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>