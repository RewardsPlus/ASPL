
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Company</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                data-bs-original-title="" title=""></button>
        </div>

        <form method="POST" action="{{ route('admin.company.update',$company->id) }}" accept-charset="UTF-8"
            class="m-form" enctype="multipart/form-data" novalidate="novalidate">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="card">

                    <!-- company Name -->

                    <div class="card-body ">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="company_name">
                                    Company* :
                                </label>
                                <input class="form-control m-input" id="company_name" name="company_name"
                                    placeholder="Your Company Name" value="{{ $company->company_detail->company_name }}" type="text">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name">
                                    Name* :
                                </label>
                                <input class="form-control " id="name" name="name" placeholder="Your Name" value="{{ $company->name }}"
                                    type="text">
                            </div>



                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="email">
                                    Email* :
                                </label>
                                <input type="text" name="email" id="email" placeholder="Enter the Email" value="{{ $company->email }}"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile">
                                    Phone* :
                                </label>
                                <input type="text" name="mobile" id="mobile" placeholder="Enter phone no:" value="{{ $company->mobile }}"
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password">
                                    Password* :
                                </label>
                                <input type="password" name="password" id="password" class="form-control m-input" disabled >
                            </div>

                        </div>


                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="i_cat">
                                    Industry Category* :
                                </label>
                                <select class="form-control " id="i_cat_edit" name="i_cat" required>
                                    <option value="">Select Type</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"  @selected($category->id==$company->company_detail->category->parent_id )>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group m-form__group col-md-6">
                                <label for="example_input_full_name">
                                    Industry Sub Category* :
                                </label>
                                <select class="form-control m-input" id="i_subcat_edit" name="i_subcat">
                                    @foreach(Helper::getSubcategoriesByCategory($company->company_detail->category->parent_id ) as $subcategory)
                                    <option value="{{ $subcategory->id }}"  @selected($subcategory->id==$company->company_detail->company_category_id)>{{ $subcategory->name }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group m-form__group col-md-6">
                                <label for="example_input_full_name">
                                    Business Type* :
                                </label>
                                <select class="form-control m-input" id="business_type" name="business_type">
                                    <option value="" selected disabled>Select Type</option>
                                    @foreach ($businesstypes as $bt)
                                        <option value="{{ $bt->id }}" @selected($company->company_detail->business_type_id==$bt->id )>{{ $bt->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                    </div>
                </div>

                <!-- roles -->
            </div>

            <div class="modal-footer">
                <div class="row w-50">
                    <div class="col">
                        <button type="submit" class="btn btn-success">
                            Update Company
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-danger" type="button"  data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>

            <!-- </form> -->

        </form>

    </div>
</div>