{{--

    * Created by   :  Muhammad Yasir
    * Project Name : questionnaire
    * Product Name : PhpStorm
    * Date         : 10-Sep-18 6:53 PM
    * File Name    : errors.blade.php

--}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="alerts"></div>
@if(Session::has('danger'))
    <p class="alert alert-danger alert-dismissible fade show">{{ Session::get('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </p>

@endif
@if(Session::has('warning'))
    <p class="alert alert-warning alert-dismissible fade show">{{ Session::get('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </p>

@endif
@if(Session::has('success'))
    <p class="alert alert-success alert-dismissible fade show">{{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </p>

@endif
@if(Session::has('info'))
    <p class="alert alert-info alert-dismissible fade show">{{ Session::get('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </p>
@endif

