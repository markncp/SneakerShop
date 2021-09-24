<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            3PSneakers
        </div>
        @if(auth()->guard()->user()->type != 0)
        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/product') }}">
                        Product
                    </a>
                </li>
            </ul>

            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/product-type') }}">
                        Brands
                    </a>
                </li>
            </ul>

            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/payment') }}">
                        Payment
                    </a>
                </li>
            </ul>

            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/order') }}">
                        Order
                    </a>
                </li>
            </ul>
            
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin/users') }}">
                        users
                    </a>
                </li>
            </ul>

        </div>
        @endif
    </div>
</div>
