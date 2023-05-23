@extends('layouts.app')
@section('content')
<div class="productContent">
    <form action={{ route('product.store') }} method="post" enctype="multipart/form-data">
        @csrf
        <div class="addForm">
          <br>
          SKU :
          <br>
          <input type="text" name="sku" id="sku" >
          <br> 
          Product Name :
          <br>
          <input type="text" name="name">
          <br>
          Price ($):
          <br>
          <input type="decimal" name="price" >
          <br>
          Status :
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" value=1 role="switch" id="flexSwitchCheckDefault">
          </div>
          <br>
          Image:
          <input type="file" name="product_image">
          <br>
          <br>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
      <br>
      <div class="item-table">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Key</th>
              <th>SKU</th>
              <th>Name</th>
              <th>Price</th>
              <th>Status</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          <tbody>
            @foreach ($items as $key => $item)
            <tr>
              <th scope="row">{{ ++$key }}</th>
              <td>{{ $item->sku }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->price }}</td>
              @if ($item->status == 1)
              <td> <a href="{{ route('product.status',$item->id) }}" class="btn btn-success" >Active</a> </td>
              @else 
              <td><a href="{{ route('product.status',$item->id) }}" class="btn btn-danger">Inactive</a></td>
              @endif
              @if($item->product_image != null)
              <td><img src ="{{ asset('storage/images/products/'.$item->product_image) }}" alt="" width="100px"/></td>   
              @else
              <td>No image</td>   
                  
              @endif
              <td><a href="javascript:void(0)" class="btn btn-info" onclick="handleClickModal({{ $item->id }})">Edit<a>
              <a href={{ route('product.delete',$item->id) }} class="btn btn-danger">delete<a>
              </td>

            </tr>
            @endforeach
          </tbody>
          </thead>
        </table>
      </div>
    </div>
    {{-- <script>
      function handleClick(){
        console.log("clicked")
        let a = document.getElementByName("status");
        let status = a.value;
        console.log(status)
      }
      </script> --}}
      <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="itemEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Product Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="itemEditContent">
      </div>
    </div>
  </div>
</div>
@endsection
@push('css')
    <style>
    .productContent{
      padding: 25px;
    }
    </style>
    @endpush
    @push('js')
    <script>
      console.log("modal");
    function handleClickModal(item_id){
      var data = {
        item_id: item_id
      };
      $.ajax({
        type: "GET",
        url: "{{ route('product.edit') }}",//address to connect
        data: data, //data to be sent
        dataType: "",
        success: function (response) {
          $('#itemEdit').modal('show'); //opening the modal
          $('#itemEditContent').html(response); //content in the modal
        }
      });
    }    
      </script>