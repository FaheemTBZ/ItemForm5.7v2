@extends('layouts.app')

@section('content')

<aside class="card" id="cardHome">
    <div class="card-body">
        <h3 class="text-center text-uppercase">Dashboard</h3>
        <hr />
        <section class="row">
            <div class="col-md-12">
                <a href="{{ url('/home') }}" class="card-main d-flex align-items-center justify-content-center">
                    <span>Item Details</span>
                    <i class="material-icons">create</i>
                </a>
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


<h3 class="text-center text-uppercase">Search Item Data Below..</h3>
<div class="container-fluid z-1 p--sm p-5" id="searchWrapper">

    <div class="text-center">
        <svg id="svgSearch" viewbox="0 0 128 128" width="100%" height="100%">
            <path id="searchDoc" d="M0-0.00002,0,3.6768,0,124.32,0,128h4.129,119.74,4.129v-3.6769-120.65-3.6768h-4.129-119.74zm8.2581,7.3537,111.48,0,0,113.29-111.48,0zm13.626,25.048,0,7.3537,57.806,0,0-7.3537zm0,19.12,0,7.3537,84.232,0,0-7.3537zm0,17.649,0,7.3537,84.232,0,0-7.3537zm0,19.12,0,7.3537,84.232,0,0-7.3537z7z" />
            <path id="searchMagnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z" />
        </svg>
    </div>

    <form action="{{ URL::to('/searchitemdata') }}" method="POST" id="itemSearchForm" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label for="itemSelect">Search Type</label>
            <select name="itemSelect" class="form-control form-control-lg" id="itemSelect">
                <option value="0">Select</option>
                <option value="1">By Code</option>
                <option value="2">By Name</option>
                <option value="4">By Pictures</option>
                <option value="3">By Category</option>
                <option value="5">By Description</option>
            </select>
        </div>

        <div class="collapse" id="itemCodeContainer">
            <div class="form-group">
                <label for="itemCode">Item Code</label>
                <input type="text" onchange="return window.Util.trim(this)" id="itemCode" name="itemCode" class="form-control" />
            </div>
        </div>
        <div class="collapse" id="itemNameContainer">
            <div class="form-group">
                <label for="itemName">Item Name</label>
                <input onchange="return window.Util.trim(this)" type="text" id="itemName" name="itemName" class="form-control" />
            </div>
        </div>
        <div class="collapse" id="itemDescriptionContainer">
            <div class="form-group">
                <label for="itemDescription">Item Description</label>
                <input onchange="return window.Util.trim(this)" type="text" id="itemDescription" name="itemDescription" class="form-control" />
            </div>
        </div>
        <div class="collapse" id="itemCategoryContainer">
            <div class="form-group">
                <label for="searchCategory">Item Category</label>
                <select id="searchCategory" class="form-control" name="searchCategory">
                    <!-- Dynamically Populate Options via Ajax -->
                </select>
            </div>
        </div>
        <input type="hidden" id="itemUnit" name="itemUnit" />
        <div class="text-center">
            <button type="submit" class="btn btn--raised btn-lg" id="btnSubmit" disabled>Search</button>
        </div>
    </form>

    <!-- --------------------------------------- Filtered Results ---------------------------------- -->
    <div id="searchResult">

        @if(isset($SearchError))
        <div class="alert alert-danger" role="alert">
            {{ $SearchError }}
            <button type="button" class="alert-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if( isset($resultCode) )
        <hr />
        <h3 class="mb-3 text-center">Showing Results for Item with code: {{ $resultCode['item_code'] }}:</h3>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ URL::to('/editItem') }}" method="POST" ondblclick="this.submit()">
                    @csrf
                    <input type="hidden" name="editItemId" id="editItemId" value="{{ $resultCode['id'] }}" />
                    <div class="card shadow card-item is-rounded" style="width: auto">
                        <div class="card-body text-left">
                            <h4 class="card-title">Name: {{ $resultCode['item_name'] }}</h4>
                            <h6>Code: {{ $resultCode['item_code'] }} | {{ $resultCode['item_category'] }}</h6>
                            <p class="card-text space-top--sm">{{ $resultCode['item_description'] }}</p>
                            @if( strpos($resultCode['item_images'], '|') === false )
                            <div class="card-item-pic d-flex" data-max-width="1000" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$resultCode['item_images']) }}">
                                <img src="{{ asset('/image/'.$resultCode['item_images']) }}" alt="" />
                            </div>
                            @else
                            <div class="card-item-pic-container d-flex flex-wrap">
                                @foreach( explode('|', $resultCode['item_images']) as $pic )
                                <div class="card-item-pic" data-max-width="1000" data-gallery="galleryCode" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$pic) }}">
                                    <img src="{{ asset('/image/'.$pic) }}" alt="" />
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if( isset($resultName) && count($resultName) > 0 )
        <hr />
        <h3 class="space-bottom text-center">{{ count($resultName) }} Results Found:</h3>
        <section class="row">
            @foreach( $resultName as $name )
            <div class="col">
                <form action="{{ URL::to('/editItem') }}" method="POST" ondblclick="this.submit()">
                    @csrf
                    <input type="hidden" name="editItemId" value="{{ $name['id'] }}" />
                    <div class="card card-item shadow is-rounded">
                        <div class="card-body">
                            <h1 class="card-title">{{ $name['item_category'] }}</h1>
                            <h4 class="card-subtitle">Code: {{ $name['item_code'] }} | Name: {{ $name['item_name'] }}</h4>
                            <br />
                            <p class="card-text">{{ $name['item_description'] }}</p>
                            @if( strpos($name['item_images'], '|') === false )
                            <div class="card-item-pic d-flex flex-wrap" data-max-width="400" data-max-height="400" data-toggle="lightbox" href="{{ asset('/image/'.$name['item_images']) }}">
                                <img src="{{ asset('/image/'.$name['item_images']) }}" alt="" />
                            </div>
                            @else
                            <div class="card-item-pic-container d-flex flex-wrap">
                                @foreach( explode('|', $name['item_images']) as $pic )
                                <div class="card-item-pic" data-max-width="1000" data-gallery="galleryName" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$pic) }}">
                                    <img src="{{ asset('/image/'.$pic) }}" alt="" />
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </section>
        @endif

        @if( isset($resultDescription) && count($resultDescription) > 0 )
        <hr />
        <h3 class="space-bottom text-center">{{ count($resultDescription) }} Results Found:</h3>
        <section class="row">
            @foreach( $resultDescription as $description )
            <div class="col-md-6">
                <form action="{{ URL::to('/editItem') }}" method="POST" ondblclick="this.submit()">
                    @csrf
                    <input type="hidden" name="editItemId" id="editItemId" value="{{ $description['id'] }}" />
                    <div class="card card-item shadow is-rounded">
                        <div class="card-body">
                            <h1 class="card-title">{{ $description['item_category'] }}</h1>
                            <h4 class="card-subtitle">Code: {{ $description['item_code'] }} | Name: {{ $description['item_name'] }}</h4>
                            <br />
                            <p class="card-text">{{ $description['item_description'] }}</p>
                            @if( strpos($description['item_images'], '|') === false )
                            <div class="card-item-pic d-flex flex-wrap" data-max-width="1000" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$description['item_images']) }}">
                                <img src="{{ asset('/image/'.$description['item_images']) }}" alt="" />
                            </div>
                            @else
                            <div class="card-item-pic-container d-flex flex-wrap">
                                @foreach( explode('|', $description['item_images']) as $pic )
                                <div data-gallery="galleryDesc" class="card-item-pic" data-max-width="1000" data-max-height="1000" data-toggle="lightbox" href="{{ asset('/image/'.$pic) }}">
                                    <img src="{{ asset('/image/'.$pic) }}" alt="" />
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </section>
        @endif


        @if( isset($resultCategory) && count($resultCategory) > 0 )
        <hr />
        <h3 class="space-bottom text-center">{{ count($resultCategory) }} Results found for Category: {{ $resultCategory[0]['item_category'] }}</h3>
        <section class="row">
            @foreach( $resultCategory as $cat )
            <div class="col">
                <form action="{{ URL::to('/editItem') }}" method="POST" ondblclick="this.submit()">
                    @csrf
                    <input type="hidden" name="editItemId" id="editItemId" value="{{ $cat['id'] }}" />
                    <div class="card shadow is-rounded">
                        <div class="card-body">
                            <h1 class="card-title">{{ $cat['item_category'] }}</h1>
                            <h4 class="card-subtitle">Code: {{ $cat['item_code'] }} | Name: {{ $cat['item_name'] }}</h4>
                            <br />
                            <p class="card-text">{{ $cat['item_description'] }}</p>
                            @if( strpos($cat['item_images'], '|') === false )
                            <div class="card-item-pic d-flex flex-wrap" data-max-width="400" data-max-height="400" data-toggle="lightbox" href="{{ asset('/image/'.$cat['item_images']) }}">
                                <img src="{{ asset('/image/'.$cat['item_images']) }}" alt="" />
                            </div>
                            @else
                            <div class="card-item-pic-container d-flex flex-wrap">
                                @foreach( explode('|', $cat['item_images']) as $pic )
                                <div class="card-item-pic" data-max-width="1000" data-max-height="1000" data-gallery="galleryCategory" data-toggle="lightbox" href="{{ asset('/image/'.$pic) }}">
                                    <img src="{{ asset('/image/'.$pic) }}" alt="" />
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </section>
        @endif


        @if( isset($resultPictures))
        <hr />
        <h3 class="space-bottom text-center">{{ count($resultPictures) }} Pictures Found! Click to any picture to fetch all items with the matching category!</h3>
        <div class="pics-container shadow flex-wrap d-flex p--sm">
            @foreach( $resultPictures as $picture )
            <form class="pics-form" action="{{URL::to('/samepiccategories')}}" method="POST">
                @csrf
                <input type="hidden" name="picItemCategory" value="{{ array_key_exists('category', $picture) ? $picture['category'] : 'No Category' }}" />
                <div class="item-pic">
                    <img src="{{ asset('/image/'.(array_key_exists('pic', $picture) ? $picture['pic'] : 'No Image'))  }}" alt="{{ array_key_exists('category', $picture) ? $picture['category'] : 'Picture Item Details' }}" />
                </div>
            </form>
            @endforeach
        </div>
        @endif

    </div>
    <!-- --------------------------------------- End Filtered Results ------------------------------ -->
</div>

@endsection

@section('customjs')
<script>
    $(document).ready(function() {

        // Setup Search type as user selects
        $('#itemSelect').change(function() {
            $('#btnSubmit').attr('disabled', false);
            $('.form-control').attr('required', false);
            $('.collapse').collapse('hide');
            $('#searchResult').empty();
            var option = $(this).val();

            if (option === '1') {
                $('#itemCodeContainer').collapse('show');
                $('#itemUnit').val('itemCode');
                $('#itemCode').attr('required', true);
                $('#itemCode').focus();
            } else if (option === '2') {
                $('#itemNameContainer').collapse('show');
                $('#itemUnit').val('itemName');
                $('#itemName').attr('required', true);
                $('#itemName').focus();
            } else if (option === '4') {
                $('#itemUnit').val('itemPicture');
                $('#itemSearchForm').submit();
            } else if (option === '5') {
                $('#itemUnit').val('itemDescription');
                $('#itemDescription').attr('required', true);
                $('#itemDescriptionContainer').collapse('show');
                $('#itemDescription').focus();
            } else if (option === '3') {
                $('#itemUnit').val('searchCategory');
                $('#itemCategoryContainer').collapse('show');
                $('#searchCategory').attr('required', true);
                // Fetch all the Categories
                $.ajax({
                    type: "GET",
                    url: "{{URL::to('/populateCategories')}}",
                    success: function(data) {
                        var htmlOptions = [];
                        if (data.length) {
                            for (item in data) {
                                var html = '<option value="' + data[item]['category_name'] + '">' + data[item]['category_name'] + '</option>';
                                htmlOptions[htmlOptions.length] = html;
                            }
                            $('#searchCategory').empty().append(htmlOptions.join(''));
                        }
                    },
                }).fail(function() {
                    alert('Cant Fetch Categories!');
                });
            }
        });

        $('.pics-form').click(function() {
            $(this).submit();
        });

    }); // end document ready
</script>
@endsection