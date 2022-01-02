@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('index') }}" method="get" role="search">
                        <div>
                            <label>Price</label>
                            @if(isset($data))
                                @if($data->count() > 0)
                                    @php $total = 1000 - $discount @endphp
                                    <input type="text" name="" value="{{ $total }}" class="form-control">
                                @else
                                    <input type="text" name="" value="1000" class="form-control">
                                @endif
                            @else
                                <input type="text" name="" value="1000" class="form-control">
                            @endif
                        </div>
                        <label>Coupon Code (if any)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" dirname="coupon_code" id="coupon_code" name="search" required>
                            <span class="input-group-btn">
                            <input type="submit" class="btn btn-primary fld-btn" value="Redeem Coupon" id="search">
                          </span>
                            @error('coupon_code')
                            <span class="invalid-feedback" role="alert">
                                         <label style="color: red">{{ $message }}</label>
                                     </span>
                            @enderror
                        </div>
                    </form>

                    <div>
                        @if(isset($data))
                            @if($data->count() > 0)
                                {{ $discount }}
                            @else
                                 <p class="text-danger">{{ $error }}</p>
                            @endif
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
    @section('script')
        <script>
            $('#coupon_btn').click(function(){
                var coupon_id = $('#coupon_id').val();
                //alert(coupon_id);
                $.ajax({
                    url:'{{url('/checkCoupon')}}',
                    data: 'code=' + coupon_id,
                    success:function(res){
                        // alert(res);
                        $('#cartTotal').html(res);
                    }
                })
            });
        </script>
    @endsection
@endsection
