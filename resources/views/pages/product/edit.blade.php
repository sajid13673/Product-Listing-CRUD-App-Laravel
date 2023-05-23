<div class="editFormDiv">
<form action={{ route('product.update', $item->id) }} method="post" enctype="multipart/form-data">
    @csrf
    <div class="addForm">
      <br>
       ID :
      <br>
      <input type="text" name="id" id="id" value={{ $item->id }}>
      <br> 
      Product Name :
      <br>
      <input type="text" name="name" value={{ $item->name }}>
      <br>
      Price ($):
      <br>
      <input type="decimal" name="price" value={{ $item->price }}>
      <br>
      Status :
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="status" value={{ $item->status }} role="switch" id="flexSwitchCheckDefault">
      </div>
      <br>
      Image:
      <input type="file" name="image" >
      <br>
      <br>
      <button type="submit" class="btn btn-success">Update</button>
    </div>
  </form>
</div>