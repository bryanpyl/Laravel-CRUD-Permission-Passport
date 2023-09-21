@extends('layouts.app')


@section('welcome')
    @auth
        <h4><strong>Welcome aboard, {{ Auth::user()->name }}</strong></h4>
        Any new goods or products today?
    @else
        Hello Guest. Welcome to our platform.
    @endauth
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2><strong>Products</strong></h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div><br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Price (in RM)</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
            <td>{{ $product->price }}</td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $products->links('pagination::bootstrap-4') !!}

    <p class="text-center text-primary"><small>Last updated: {{ now()->format('j F Y (l)') }}</small></p>

    
    <script>
        function confirmSubmit() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
    
    <script>
        // Add an onclick attribute to the delete button
        const deleteButtons = document.querySelectorAll('.btn-danger');
        deleteButtons.forEach(button => {
            button.onclick = () => confirmSubmit();
        });
    </script>

@endsection