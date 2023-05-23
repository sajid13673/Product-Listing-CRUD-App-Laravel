<?php 
namespace domain\Services;
use App\Models\Product;
use function PHPUnit\Framework\isEmpty;

class ProductService{
    protected $item;
    public function __construct(){
        $this->item = new Product();
    }
    public function all(){
        return $this->item->all();//This is equal to the query seleect * from products

    }
    public function get($task_id){
        return $this->item->find($task_id);
    }
    public function store($data){

        if($data->hasFile('product_image') )
        {
            $ArrData = $data->all();
            $destination_path = "public/images/products" ;
            $image = $data->file('product_image');
            $image_name = $data['sku'].".".$image->getClientOriginalName();
            $data->file('product_image')->storeAs($destination_path, $image_name);
            $ArrData['product_image'] = $image_name;
            $this->item->create($ArrData);
        }
        else{
            $this->item->create($data->all());
        }
        // $this->item->name = $request->name;
        // $this->item->save();
    }
    public function delete($item_id){
        $item = $this->item->find($item_id);
        $item->delete();
    }
    public function update(array $data, $item_id){
        $item = $this->item->find($item_id);
        $item->update($this->edit($item, $data));//this is used to merge the old and new data to update the
        //**Above is the most suitable way, below method also can be used to do the same**
        //$item->name = $data['name'];
        //$item->price = $data['price'];
        //$item->update();
    }
    protected function edit(Product $item, $data){
        return array_merge($item->toArray(), $data);
    }
    protected function validate($data){
        if($data['name'] == "hello"){
            $msg = "ff77";
            return $msg;
        }
        elseif( isEmpty($data['name'])){
            $msg = "Please enter price";
            return $msg;
        }
        else {
            return true;
        } 
    }
    public function status($item_id){
        $item = $this->item->find($item_id);
        $status = $item['status'];
        $item['status'] = !$status;
        $item->update();
    }
}