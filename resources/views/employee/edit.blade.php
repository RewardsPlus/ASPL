<form method="POST" action="{{route(Helper::getGuard().'.employee.store')}}" accept-charset="UTF-8" class="form"
                    id="m_form_1" enctype="multipart/form-data" >
                    @csrf
                    <div class="portlet__body">
                        <!-- employee Name -->
                        <div class="form__section form__section--first">

                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="example_input_full_name">
                                        Emp Code :
                                    </label>
                                    <input type="text" value="{{$employee->employee->emp_code??''}}" name="emp_code" id="emp_code" placeholder="Emp Code"
                                        class="form-control">

                                </div>



                            </div>

                            <div class="row">


                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Name :
                                    </label>
                                    <input type="text" value="{{$employee->name??''}}" name="name" id="name" placeholder="Name" class="form-control">

                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Contact:
                                    </label>
                                    <input type="text" value="{{$employee->mobile??''}}" name="contact" id="contact" placeholder="Contact"
                                        class="form-control" required pattern="[6-9]{1}[0-9]{9}" title="Invalid Mobile no">
                                </div>


                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Email:
                                    </label>
                                    <input type="text" name="email" value="{{$employee->email??''}}" id="email" placeholder="Email" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Choose Company:
                                    </label>
                                    <select class="form-control company-employee" id="store_id" name="company_id">
                                        <option value="">Select Company</option>
                                        @foreach($company as $data)
                                        <option value="{{$data->id}}" {{isset($employee)? ($employee->company_id == $data->id ? 'selected' :''):''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Choose Store:
                                    </label>
                                    <select class="form-control store-employee" id="store_id" name="store_id">
                                        {!! Helper::getStoresByCompany($employee->company_id,$employee->store_id) !!}
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Pan No:
                                    </label>
                                    <input type="text" value="{{$employee->employee->pan_number??''}}" name="pan_no" id="pan_no" placeholder="Pan No"
                                        class="form-control" required pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Invalid Pan">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Account No:
                                    </label>
                                    <input type="text" value="{{$employee->employee->account_number??''}}" name="account_no" id="account_no" placeholder="Account No"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        IFSC Code:
                                    </label>
                                    <input type="text" name="ifsc_code" value="{{$employee->employee->ifsc_code??''}}" id="ifsc_code" placeholder="IFSC Code"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Photo:
                                    </label>
                                    <img src="{{asset('storage/'.$employee->photo)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" value="{{$employee->photo}}" class="form-control" id="photo" name="photo">
                                </div>
                            </div>


                           
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Address Proof:
                                    </label>
                                    <img src="{{asset('storage/'.$employee->address_proof)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="address_proof" name="address_proof">
                                </div>
                                @if($employee->employee)
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Aadhar:
                                    </label>
                                   
                                    <img src="{{asset('storage/'.$employee->employee->adhar_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                   
                                    <input type="file" class="form-control" id="aadhar" name="aadhar">
                                </div>
                                @endisset
                            </div>

                            <div class="row">
                                @if($employee->employee)
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Pancard:
                                    </label>
                                    <img src="{{asset('storage/'.$employee->employee->pancard_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="pancard" name="pancard">
                                </div>
                               
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Other:
                                    </label>
                                    <img src="{{asset('storage/'.$employee->employee->other_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="other" name="other">
                                </div>
                                @endisset
                            </div>
                            <div class="row">


                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Address :
                                    </label>
                                    <input type="text" name="address" value="{{$employee->employee->address??''}}" id="address" placeholder="Address"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Aadhar No :
                                    </label>
                                    <input type="text" name="aadhar_no" value="{{$employee->employee->adhar_number??''}}" id="aadhar_no" placeholder="Aadhar No"
                                        class="form-control" required pattern="[0-9]{12}" title="Invalid Aadhar no">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="transform:translate(975px,10px);">
                        <button type="submit" class="btn btn-primary btn-sm" id="SubmIt">
                            Update
                        </button>
                    </div>
                    <!-- roles -->
                    <!-- </form> -->
                </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.company-employee').on('change', function(event) {
        var company = this.value;
        var newurl = "{{url('api/fetch-store')}}" + '/' + company;
        $.ajax({
            url: newurl,
            type: "get",
            success: function(response) {
               $('.store-employee').html(response);
            }
        });
    });
});
</script>