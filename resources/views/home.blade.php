@extends('layouts.app')

@section('content')

<div id="preloader-wrapper">
    <div id="preloader">
        <i></i>
        <i></i>
        <i></i>
    </div>
</div>

<aside class="card" id="cardHome">
    <div class="card-body">
        <h3 class="text-center text-uppercase">Dashboard</h3>
        <hr />
        <section class="row">
            <div class="col-md-12">
                <div class="card-main d-flex align-items-center justify-content-center" data-toggle="collapse" data-target="#addItem" id="cardAddItem">
                    <span>Item Details</span>
                    <i class="material-icons">create</i>
                </div>
            </div>
            <div class="col-md-12">
                <a href="{{ url('/search') }}" class="card-main d-flex align-items-center justify-content-center" id="cardSearch">
                    <span>Search Data</span>
                    <i class="material-icons">autorenew</i>
                </a>
            </div>
            <div class="col-md-12">
                <a href="{{ url('/forums') }}" class="card-main d-flex align-items-center justify-content-center" id="cardSearch">
                    <span>Forum</span>
                    <i class="material-icons">chat</i>
                </a>
            </div>
        </section>
    </div>
</aside>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-lg-11 col-xl-11">

            <!-- If Error Session -->

            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="alert-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <!-- If Success Session -->

            @if( session('SuccessMessage') )
            <div class="alert alert-success" role="alert">
                {{ session()->get('SuccessMessage') }}
                <button type="button" class="alert-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <!-- 
            =========================================================================================    
                                                    Add Item Form 
            =========================================================================================
            -->
            <section class="p-4 z-1 bg-white is-rounded">

                <!-- If Update -->
                @if( isset($EditItem) && isset($EditItemId) )
                <h2 class="">Edit Item Details</h2>
                <hr />

                <form enctype="multipart/form-data" action="{{ URL::to('/updateitem') }}" method="POST">
                    @csrf
                    <input type="hidden" name="UpdateFormFlag" value="1" />
                    <input type="hidden" name="UpdateItemId" value="{{ isset($EditItem) ? $EditItem['id'] : '' }}" />
                    <div class="form-group">
                        <label for="itemCode">Code</label>
                        <input data-toggle="tooltip" title="Code of Item!" name="itemCode" type="text" value="{{ isset($EditItem) ? $EditItem['item_code'] : ''  }}" required class="form-control" id="itemCode" />
                    </div>
                    <div class="form-group">
                        <label for="itemName">Item Name</label>
                        <input type="text" data-toggle="tooltip" title="Name of Item" value="{{ isset($EditItem) ? $EditItem['item_name'] : ''  }}" required class="form-control" id="itemName" name="itemName" />
                    </div>
                    <div class="form-group input group">
                        <label for="itemCategory">Category </label>
                        <div class="d-flex align-items-center">
                            <select data-toggle="tooltip" title="Category of Item!" name="itemCategory" class="form-control" id="itemCategory">
                                <option value="{{ isset($EditItem) ? $EditItem['item_category'] : '' }}">{{ isset($EditItem) ? $EditItem['item_category'] : '' }}</option>
                                <!-- Populate Options via Ajax  -->
                            </select>
                            <div data-toggle="modal" data-target="#modalAddCategory">
                                <i class="material-icons shadow rounded" data-toggle="tooltip" title="Add More Category">add</i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="itemPrice">Sales Price</label>
                        <input data-toggle="tooltip" title="Price of Item!" value="{{ isset($EditItem) ? $EditItem['item_price'] : ''  }}" type="text" required class="form-control" id="itemPrice" name="itemPrice" />
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Item Description</label>
                        <textarea type="text" data-toggle="tooltip" title="Description of Item!" required class="form-control" id="itemDescription" name="itemDescription" rows="4">{{ isset($EditItem) ? $EditItem['item_description'] : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemPictures">Attach More Pictures</label> <br />
                        <i data-toggle="modal" title="View Images" data-target="#modalShowPics" class="material-icons icon mr-2">perm_media</i>
                        <input data-toggle="tooltip" title="Upload Images having extension jpeg, jpg, png, svg or Gif!" multiple type="file" accept="image/" id="itemPictures" name="itemPictures[]" />
                        <aside class="modal shadow-lg fade" id="modalShowPics">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-4">
                                    <h4><strong>Viewing Images</strong></h4>
                                    @foreach( explode('|', $EditItem['item_images']) as $itemImage )
                                    <li class="d-flex align-items-center mt-2 justify-content-center">
                                        <img src="{{ asset('/image/'.$itemImage) }}" style="height: 50px; width: 50px; border-radius: 50%" alt="{{ asset('/image/'.$itemImage) }}" />
                                        <a title="View Picture" data-gallery="gallery" class="material-icons text-info" data-max-width="1000" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$itemImage) }}">collections</a>
                                        <!-- <div class="form-check-inline ml-3">
                                            <input type="checkbox" value="{{ $itemImage }}" class="form-check-input" name="itemDeletePics[]" />
                                        </div> -->
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="preview d-flex flex-wrap" id="previewImages"></div>

                    <table class="table shadow text-center space-bottom" id="tableSupplier">
                        <thead>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Supplier Cost</th>
                                <th>Supplier Date</th>
                                <th>Supplier Actions</th>
                            </tr>
                        </thead>
                        <tbody id="morePriceContainer">
                            @foreach($ItemSupplier as $itemSupplier)
                            <tr>
                                <td class="d-flex form-group">
                                    <select value="" data-toggle="tooltip" title="The Name of Supplier!" name="supplierName2" class="suppliersList form-control">
                                        <option value="{{ $itemSupplier['supplier_name'] }}">{{ $itemSupplier['supplier_name'] }}</option>
                                        <!-- Ajax Populate -->
                                    </select>
                                    <i class="material-icons shadow" style="padding: .5rem; border-radius: 50%" data-toggle="modal" data-target="#addSupplierModal">add</i>
                                </td>
                                <td class="form-group">
                                    <input type="text" data-toggle="tooltip" title="Supplier Cost" style="width: 100px" value="{{ $itemSupplier['supplier_cost'] }}" name="supplierCost" id="supplierCost" class="form-control" />
                                </td>
                                <td class="form-group">
                                    <input type="date" name="supplierDate" data-toggle="tooltip" title="Supply Date!" value="{{ $itemSupplier['supplier_date'] }}" id="supplierDate" class="form-control" />
                                </td>
                                <td>
                                    <form action="" method="POST" action="{{URL::to('supplieraction')}}">
                                        <input type="hidden" name="actionSupplierId" value="{{ $itemSupplier['id'] }}" />
                                        <a title="View Docoments" style="padding: .75rem; border-radius: 50%" class="material-icons shadow text-info btnViewDoc">drafts</a>
                                        <i title="Delete Supplier Price" class="material-icons shadow text-danger btnDeleteSupplier" style="padding: .75rem; border-radius: 50%">delete_sweep</i>
                                        <i title="Update Supplier Price" class="material-icons icon shadow text-success btnUpdateSupplier">autorenew</i>
                                        <i title="Add More Price" data-target="#addMorePrice" data-toggle="modal" class="material-icons icon text-primary btnAddMorePrice">add</i>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group text-center space-top">
                        <button type="submit" class="btn btn--raised">Submit Form</button>
                    </div>
                </form>

                <aside class="modal fade" id="modalViewDoc">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4">
                            <h4 class="text-center">Viewing Documents</h4>
                            <hr />
                            <ul class="list" id="docListView">

                            </ul>
                        </div>
                    </div>
                </aside>

                <!-- Else Add -->
                @else

                <h3 class="text-uppercase">Add Item Details</h3>
                <hr />

                <form enctype="multipart/form-data" action="{{ URL::to('/storeitem') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="itemCode">Code</label>
                        <input name="itemCode" data-toggle="tooltip" title="Item Code" type="text" required class="form-control" value="{{ old('itemCode') }}" id="itemCode" />
                    </div>
                    <div class="form-group">
                        <label for="itemName">Item Name</label>
                        <input type="text" required class="form-control" id="itemName" data-toggle="tooltip" title="Name of Item" value="{{ old('itemName') }}" name="itemName" />
                    </div>
                    <div class="form-group input group">
                        <label for="itemCategory">Item Category</label>
                        <div class="d-flex align-items-center">
                            <select name="itemCategory" class="form-control" data-toggle="tooltip" title="Click on Plus button to add Category" id="itemCategory">
                                <!-- Populate Options via Ajax  -->
                            </select>
                            <div data-toggle="modal" data-target="#modalAddCategory">
                                <i class="material-icons shadow rounded">add</i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="itemPrice">Sales Price</label>
                        <input type="text"value="{{ old('itemPrice') }}" required class="form-control" data-toggle="tooltip" title="Sales Price of Item" id="itemPrice" name="itemPrice" />
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Item Description</label>
                        <textarea value="{{ old('itemDescription') }}" data-toggle="tooltip" title="Description of Item" type="text" required class="form-control" id="itemDescription" name="itemDescription" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemPictures">Attach Pictures</label> <br />
                        <input multiple type="file" data-toggle="tooltip" title="Images must be standard with extensions jpeg, jpg, png, svg or Gif" accept="image/" id="itemPictures" name="itemPictures[]" />
                    </div>
                    <div class="preview d-flex flex-wrap" id="previewImages"></div>
                    <div class="form-group" style="display: none" id="picSize">
                        <label for="itemPicturesSize">Custom Picture Size</label>
                        <input name="imageSize" type="text" data-toggle="tooltip" class="form-control" title="Enter Images Size separated by letter x" placeholder="For Example: 400x400" />
                    </div>
                    
                    <table class="table border text-center" id="tableSupplier">
                        <thead class="thead-light">
                            <tr>
                                <th>Supplier Name</th>
                                <th>Supplier Cost</th>
                                <th>Supplier Date</th>
                                <th>Supplier Docs</th>
                            </tr>
                        </thead>
                        <tbody id="collapseSuppliersTableBody">
                            <input type="hidden" id="SupplierFlag" />
                            <tr id="supplierRow">
                                <td class="d-flex form-group">
                                    <select name="supplierName2" data-toggle="tooltip" title="Click to Plus Button to add Supplier" class="suppliersList form-control">
                                        <!-- Ajax Populate -->
                                    </select>
                                    <i class="material-icons shadow" style="padding: .5rem; border-radius: 50%" data-toggle="modal" data-target="#addSupplierModal">add</i>
                                </td>
                                <td class="form-group">
                                    <input type="text" style="width: 100px" data-toggle="tooltip" title="Supplier Cost" name="supplierCost" class="form-control" />
                                </td>
                                <td class="form-group">
                                    <input type="date" name="supplierDate" data-toggle="tooltip" title="Supply Date" class="form-control" />
                                </td>
                                <td>
                                    <input type="file" name="supplierDoc" data-toggle="tooltip" title="Documents must be valid having standard extensions i.e pdf, doc, txt etc" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn--raised">Submit Form</button>
                    </div>
                </form>
                @endif

            </section>

            <!-- ------------------------- End Add Items Form ------------------------------ -->

            <!-- 
            =========================================================================================    
                                                 Add Supplier Form
            =========================================================================================
            -->
            <div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" style="z-index: 2000">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content p-4 is-rounded">
                        <h1 class="text-center font-weight-bold">Supplier Detail</h1>
                        <br>
                        <form id="supplierForm">
                            <div class="form-group">
                                <label for="supplierName">Supplier Name</label>
                                <input name="supplierName" type="text" required class="form-control" id="supplierName" />
                            </div>
                            <div class="form-group">
                                <label for="companyContact">Company Contact</label>
                                <input name="companyContact" type="text" required class="form-control" id="companyContact" />
                            </div>
                            <div class="form-group">
                                <label for="supplierContact">Supplier Contact</label>
                                <input name="supplierContact" type="text" required class="form-control" id="supplierContact" />
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input name="theAddress" type="text" required class="form-control" id="theAddress" />
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="btnSaveSupplier" class="btn btn-block rounded-lg btn--raised">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ------------------------- End Supplier Modal ------------------------------ -->


            <!-- 
            =========================================================================================    
                                                 More Price Form
            =========================================================================================
            -->
            <div class="modal fade" id="addMorePrice" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content p-4 is-rounded">
                        <h1 class="text-center font-weight-bold">Add More Price</h1>
                        <br />
                        <form id="morePriceForm">
                            @csrf
                            <input type="hidden" name="morePriceFlag" value="1" />
                            <input type="hidden" name="morePriceItemId" value="{{ isset($EditItem) ? $EditItem['id'] : '' }}" />
                            <label for="moreSupplierName">Supplier Name</label>
                            <div class="form-group d-flex">
                                <select id="moreSupplierName" name="moreSupplierName" class="form-control suppliersList">
                                    <!-- Ajax Populate -->
                                </select>
                                <i class="material-icons shadow" style="padding: .5rem; border-radius: 50%" data-toggle="modal" data-target="#addSupplierModal">add</i>
                            </div>
                            <div class="form-group">
                                <label for="moreSupplierCost">Supplier Cost</label>
                                <input required name="moreSupplierCost" type="text" class="form-control" id="moreSupplierCost" />
                            </div>
                            <div class="form-group">
                                <label for="moreSupplierDate">Supplier Date</label>
                                <input required name="moreSupplierDate" type="date" class="form-control" id="moreSupplierDate" />
                            </div>
                            <div class="form-group">
                                <label for="moreDoc">Supplier Documents</label><br />
                                <input name="moreSupplierDoc" type="file" id="moreSupplierDoc" />
                            </div>
                            <br />
                            <div class="form-group text-center">
                                <button type="submit" id="btnSaveMorePrice" class="btn btn-block rounded-lg btn--raised">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ------------------------- End Price Modal ------------------------------ -->


            <!-- 
                ============================================================================
                                    Update Price Row
                ============================================================================
            -->


            <div class="modal fade" id="updatePriceRow" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content p-4 is-rounded">
                        <h1 class="text-center font-weight-bold">Update Supplier Price</h1>
                        <br />
                        <form id="formUpdatePriceRow">
                            @csrf
                            <input type="hidden" name="updatePriceRowFlag" value="1" />
                            <input type="hidden" name="morePriceItemId" value="{{ isset($EditItem) ? $EditItem['id'] : '' }}" />
                            <label for="morePriceSupplierName">Supplier Name</label>
                            <div class="form-group d-flex">
                                <select id="moreSupplierName" name="morePriceSupplierName" class="form-control suppliersList">
                                    <!-- Ajax Populate -->
                                </select>
                                <i class="material-icons shadow" style="padding: .5rem; border-radius: 50%" data-toggle="modal" data-target="#addSupplierModal">add</i>
                            </div>
                            <div class="form-group">
                                <label for="moreSupplierCost">Supplier Cost</label>
                                <input required name="morePriceSupplierCost" type="text" class="form-control" id="moreSupplierCost" />
                            </div>
                            <div class="form-group">
                                <label for="moreSupplierDate">Supplier Date</label>
                                <input required name="morePriceSupplierDate" type="date" class="form-control" id="moreSupplierDate" />
                            </div>
                            <div class="form-group">
                                <label for="moreDoc">Supplier Documents</label><br />
                                <input name="morePriceSupplierDoc" type="file" id="moreSupplierDoc" />
                            </div>
                            <br />
                            <div class="form-group text-center">
                                <button type="submit" id="btnSaveMorePrice2" class="btn btn-block rounded-lg btn--raised">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ========================================================================== -->


            <!-- 
            =========================================================================================    
                                                 Add New Category
            =========================================================================================
            -->
            <aside class="modal fade" id="modalAddCategory">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-4">
                        <h4 class="text-center">Add Category</h4>
                        <hr />
                        <form>
                            <div class="form-group">
                                <label for="newCategory">New Category</label>
                                <input name="newCategory" id="newCategory" type="text" class="form-control" autofocus />
                            </div>
                            <div class="form-group">
                                <button id="btnAddCategory" type="button" class="btn btn--raised">Save Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>
            <!-- ------------------------- End Category ------------------------------ -->


        </div>
    </div>
</div>

@section('customjs')
<script>
    $(document).ready(function() {

        /*
         *   AjaxController Object
         *
         *   @methods populateCateogires & Suppliers
         */

        var AjaxController = {
            populateSuppliers: function() {
                $.ajax({
                    type: "GET",
                    crossDomain: true,
                    url: "{{URL::to('/populateSuppliers')}}",
                    success: function(data) {
                        var htmlOptions = [];
                        if (data.length && data != -1) {
                            for (item in data) {
                                var html = `<option value="${data[item]['supplier_name']}">${data[item]['supplier_name']}</option>`;
                                htmlOptions[htmlOptions.length] = html;
                            }
                            $('.suppliersList').empty().append(htmlOptions.join(''));
                        }
                    }
                }).fail(function() {
                    AjaxController.onAjaxFail('Cant get Suppliers!');
                });
            },
            populateCategories: function() {
                $.ajax({
                    type: "GET",
                    crossDomain: true,
                    url: "{{URL::to('/populateCategories')}}",
                    success: function(data) {
                        var htmlOptions = [];
                        if (data.length && data != -1) {
                            for (item in data) {
                                var html = '<option value="' + data[item]['category_name'] + '">' + data[item]['category_name'] + '</option>';
                                htmlOptions[htmlOptions.length] = html;
                            }
                            $('#itemCategory').empty().append(htmlOptions.join(''));
                        }
                    },
                }).fail(function(err) {
                    AjaxController.onAjaxFail('Cant Get Categories!');
                });
            },
            onAjaxFail: function(msg) {
                theNotifier.alert(typeof msg !== typeof undefined && msg || 'Some Error Occured!');
            }
        };

        /*
         *   Populate Suppliers and Categories on New Item Entry
         *   If Form is being edited, keep the original values and Fetch on "first" dropdown click
         */
        (function() {
            !$("[name='UpdateItemId']").val() &&
                (function() {
                    AjaxController.populateCategories();
                    AjaxController.populateSuppliers();
                })();

            $('#itemCategory').one('click', AjaxController.populateCategories);
            // $('.suppliersListDropDown').each(function(slp) {
            //     slp.one('click', AjaxController.populateSuppliers);
            // });
            $('.suppliersList').one('click', AjaxController.populateSuppliers);
        })();

        /*
         *
         *   Add New Category via Ajax
         *
         *   
         */

        $('#btnAddCategory').on('click', function() {
            if ($('#newCategory').val().trim().length < 1) {
                $('#modalAddCategory').modal('hide');
                theNotifier.alert('Category is Invalid!');
                return;
            }

            /*
             *   Ajax Request
             *
             *   @returns Dropdown populated with all Categories plus new
             *
             */

            $.ajax({
                type: "POST",
                url: "{{URL::to('/addnewcategory')}}",
                data: {
                    'categoryValue': $('#newCategory').val()
                },
                success: function(data) {
                    var htmlOptions = [];
                    if ($.trim(data)) {
                        var html = '<option value="' + data['category_name'] + '">' + data['category_name'] + '</option>';
                        $('#itemCategory').append(html);
                        theNotifier.success('Category added successfully!');
                    }
                },
                error: function(data) {
                    console.log(data);
                },
                dataType: 'json'
            }).fail(function(err) {
                AjaxController.onAjaxFail('Cant Add New Category!');
            });
            $('#newCategory').val('');
            $('#modalAddCategory').modal('hide');

        }); // end Add Category

        /*
         *   @ Supplier Form
         *   Save Supplier via Ajax
         *
         */

        $('#btnSaveSupplier').on('click', function() {
            if (!$('#supplierName').val() || !$('#supplierContact').val() || !$('#companyContact').val() || !$('#theAddress').val()) {
                alert('Fill all Field!');
                return;
            }
            $('#addSupplierModal').modal('hide');
            $.post("{{URL::to('/addsupplier')}}", $('#supplierForm').serialize(), function(data) {
                var htmlOptions = [];
                if (data.length) {
                    $('#supplierError').remove();
                    for (item in data) {
                        var html = `<option value="${data[item]['supplier_name']}">${data[item]['supplier_name']}</option>`;
                        htmlOptions[htmlOptions.length] = html;
                    }
                    $('.suppliersList').empty().append(htmlOptions.join(''));
                    theNotifier.success('Supplier Added successfully');
                }
            }).fail(function(err) {
                AjaxController.onAjaxFail('Cant Add Supplier! Some Error Occured!');
            });
        }); // end Save Supplier onClick Event

        $(document).on('click', '.btnDeleteSupplier', function() {
            var rowDelete = $(this).closest('tr'),
                id = $(this).siblings('[type="hidden"]').val();
            $.ajax({
                url: "{{URL::to('/deletesupplier')}}",
                type: "POST",
                data: {
                    'ActionSupplierId': id
                },
                success: function(data) {
                    rowDelete.remove();
                    theNotifier.success('Price Row deleted!');
                }
            }).fail(function(err) {
                AjaxController.onAjaxFail("Cant Delete Supplier Price, some Error Occured!");
            });
        });

        // Update Price Row        
        $('.btnUpdateSupplier').on('click', function() {
            $('#updatePriceRow').modal('show');
            window.Util.id = $(this).siblings('[type="hidden"]').val();
            var rowToUpdate = $(this).closest('tr');
            rowToUpdate.attr('id', 'rowUpdateId');
        });

        $('#formUpdatePriceRow').on('submit', function(evt) {
            $('#preloader-wrapper').show();
            evt.preventDefault();
            var id = window.Util['id'];
            formData = new FormData(this);
            formData.append('ActionSupplierId', id);
            $('#updatePriceRow').modal('hide');
            $.ajax({
                url: "{{URL::to('/updatesupplier')}}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#preloader-wrapper').hide();
                    $("#rowUpdateId").find("[name='supplierCost']").val(data['supplier_cost']);
                    $("#rowUpdateId").find("[name='supplierName2']").val(data['supplier_name']);
                    $("#rowUpdateId").find("[name='supplierDate']").val(data['supplier_date']);
                    theNotifier.success('Price Row Updated!');
                }
            }).fail(function(err) {
                $('#preloader-wrapper').hide();
                AjaxController.onAjaxFail("Cant Update Supplier Price, some Error Occured!");
            });
        });

        /*
         *   View Documents of Supplier Price individually
         *
         */

        $(document).on('click', '.btnViewDoc', function() {
            $('#preloader-wrapper').show();
            var id = $(this).siblings('[type="hidden"]').val();
            $('#modalViewDoc').modal('show');
            $.ajax({
                    url: "{{URL::to('/viewdoc')}}",
                    type: "POST",
                    data: {
                        'ActionSupplierId': id
                    },
                    success: function(data) {
                        $('#preloader-wrapper').hide();
                        console.log(data);
                        if (/^\/storage\/doc\/$/.test(data['fileUrl']) || data == 0) {
                            $('#docListView').empty().append('No File Found!');
                        } else {
                            var listItem = `
                    <li class="d-flex align-items-center pr-2"> 
                    <input type="hidden" value="${data['id']}" />
                    <span class="mr-3 docName">${data['fileUrl']}</span>
                    <a target="_blank" href="${data['fileUrl']}" class="material-icons icon text-success">menu_book</a>
                    <a target="_blank" href="${data['fileUrl']}" download class="material-icons icon text-info">save_alt</a>
                    <i class="material-icons icon text-danger btnDeleteDoc">delete_sweep</i>
                    </li>
                    `;
                            $('#docListView').empty().append(listItem);
                            theNotifier.tip('Fetching Documents!');
                        }
                    }
                })
                .fail(function(err) {
                    $('#preloader-wrapper').hide();
                    AjaxController.onAjaxFail('Unable to get These Documents!');
                });
        });

        /*
         *   Add More Supplier Price Row
         *
         */

        $('#morePriceForm').on('submit', function(e) {
            e.preventDefault();
            $('#addMorePrice').modal('hide');
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/addmoreprice') }}",
                dataType: 'json',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var tr = `
                   <tr>
                        <td class="d-flex form-group">
                            <select value="" name="supplierName2" class="suppliersList form-control">
                                <option>${data['supplier_name']}</option>
                                <!-- Ajax Populate -->
                            </select>
                            <i class="material-icons shadow" style="padding: .5rem; border-radius: 50%" data-toggle="modal" data-target="#addSupplierModal">add</i>
                        </td>
                        <td class="form-group">
                            <input type="text" style="width: 100px" value="${data['supplier_cost']}" name="supplierCost" class="form-control" />
                        </td>
                        <td class="form-group">
                            <input type="date" name="supplierDate" value="${data['supplier_date']}" class="form-control" />
                        </td>
                        <td>
                            <form action="" method="POST" action="{{URL::to('supplieraction')}}">
                                <input type="hidden" name="actionSupplierId" value="${ data['id'] }" />
                                <a style="padding: .75rem; border-radius: 50%" class="material-icons shadow text-info btnViewDoc">drafts</a>
                                <i class="material-icons shadow text-danger btnDeleteSupplier" style="padding: .75rem; border-radius: 50%">delete_sweep</i>
                                <i title="Update Supplier Price" class="material-icons icon shadow text-success btnUpdateSupplier">autorenew</i>
                                <i data-toggle="modal" data-target="#addMorePrice" title="Add More Price" class="material-icons icon text-primary btnAddMorePrice">add</i>   
                            </form>
                        </td>
                    </tr>
                   `;
                    $('#morePriceContainer').append(tr);
                    theNotifier.success('Price Data added successfully!');
                }
            }).fail(function(err) {
                AjaxController.onAjaxFail('Cant add More Price! Data sent is incorrect!');
            });
        });


        /*
         *   Delete Document from Supplier Row
         *
         */

        $(document).on('click', '.btnDeleteDoc', function() {
            $('#modalViewDoc').modal('hide');
            var id = $(this).siblings("[type='hidden']").val();
            console.log(id);
            $.ajax({
                type: 'POST',
                url: "{{ URL::to('/actiondoc') }}",
                data: {
                    'ActionSupplierId': id
                },
                success: function(data) {
                    console.log(data);
                    theNotifier.success('Document Deleted!');
                }
            }).fail(function(err) {
                AjaxController.onAjaxFail('Cant Download the document!');
            });
        });

    }); // end onReady Event
</script>
@endsection
@endsection