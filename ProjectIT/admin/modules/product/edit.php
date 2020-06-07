
<?php 
require_once __DIR__."/../../autoload/autoload.php";
$category = $db->fetchAll("category");
$id = intval(getInput('id'));
$editproduct = $db->fetchID("product",$id);
if(empty($editproduct))
{
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("product");
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $data = 
    [
         "name" => postInput('name'),
        "slug" => postInput('slug'),
        "price" => postInput('price'),
        "sale" => postInput('sale'),
        "thunbar"  => postInput('thumbar'),
        "category_id" => postInput('category_id'),
        "content" => postInput('content'),
        "head" => postInput('head'),
        "view" => postInput('view'),
        "hot" => postInput('hot'),
    ];
    $error =  [];

    if(empty($error))
    {
        $id_update = $db->update("product",$data,array("id"=>$id));
        if($id_update > 0 )
        {
            $_SESSION['success'] = "Cập nhật thành công";

            redirectAdmin("product");

        }
        else
        {
             $_SESSION['error'] = "Cập nhật thất bại";
              redirectAdmin("product");
        }

    }

}

 ?>
<?php 
require_once __DIR__."/../../layouts/header.php"
 ?>
          <main>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Thêm Mới Sản Phẩm
                            </div>
                            <div class="col-md-12">
                                <form action="" method="POST">
    <div class="form-group">
        <div class="col-sm-12">
            <label for="exampleInputEmail1">Category_ID</label>
            <select name="category_id" class="form-control">
                <option value="">--Mời bạn chọn danh mục sản phẩm--</option>
                <?php foreach ($category as $items):  ?>
                    <option value="<?php echo $items['id'] ?> "><?php  echo $items['name'];?></option>
                <?php endforeach ?>
            </select>
            
        </div>

        
        
        
        <label for="exampleInputEmail1">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['name'] ?>">
        <label for="exampleInputEmail1">Slug</label>
        <input type="text" class="form-control" name="slug" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['slug'] ?>">
        <label for="exampleInputEmail1">Price</label>
        <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['price'] ?>">
        <div class="col-sm-3">
            <label for="exampleInputEmail1">Sale</label>
            <input type="number" class="form-control" name="sale" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="0" value="<?php echo $editproduct['sale'] ?>">
            <label for="exampleInputEmail1">Hình ảnh</label>
             <input type="file" class="form-control" name="thumbar" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['thunbar'] ?>">
        </div>
        
        <label for="exampleInputEmail1">Content</label>
        <input type="text" class="form-control" name="content" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['content'] ?>">
        <label for="exampleInputEmail1">Head</label>
        <input type="text" class="form-control" name="head" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['head'] ?>">
        <label for="exampleInputEmail1">View</label>
        <input type="text" class="form-control" name="View" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['view'] ?>">
        <label for="exampleInputEmail1">Hot</label>
        <input type="text" class="form-control" name="hot" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $editproduct['hot'] ?>">
         
        <?php if(isset($error['name'])):?>
            <p class="text-danger"> <?php echo $error['name'] ?></p>
        <?php endif ?>


         
        
        
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

                    </div>
                </main>

 <?php
 require_once __DIR__."/../../layouts/footer.php";
  ?>