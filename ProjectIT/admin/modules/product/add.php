
<?php 
require_once __DIR__."/../../autoload/autoload.php";

$category = $db->fetchAll("category");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $data = 
    [
        "name" => postInput('name'),
        "slug" => postInput('slug'),
        "price" => postInput('price'),
        "sale" => postInput('sale'),
        "category_id" => postInput('category_id'),
        "content" => postInput('content'),
        "head" => postInput('head'),
        "view" => postInput('view'),
        "hot" => postInput('hot'),
    ];
    $error =  [];

    // if(postInput('name') == '')
    // {
    //     $error['name'] = "Mời bạn nhập tên sản phẩm";
    // }
    // if(postInput('slug') == '')
    // {
    //     $error['slug'] = "Mời bạn nhập slug";
    // }
    // if(postInput('price') == '')
    // {
    //     $error['price'] = "Mời bạn nhập giá tiền";
    // }
    if(! isset($_FIlES['thumbar']))
    {
        $error['thumbar'] = "Mời bạn chọn hình ảnh";
    }
    // if(postInput('category_id') == '')
    // {
    //     $error['category_id'] = "Vui lòng chọn danh mục sản phẩm";

    // }
    if(empty($error))
    {
        if(isset($_FIlES['thumbar']))
        {
            $file_name = $_FIlES['thumbar']['name'];
            $file_tmp = $_FIlES['thumbar']['tmp_name'];
            $file_type = $_FIlES['thumbar']['type'];
            $file_erro = $_FIlES['thumbar']['error'];
            if($file_erro == 0)
            {
                $part = ROOT."product/";
                $data['thunbar'] = $file_name;
            }
        }
        
        $id_insert = $db->insert("product",$data);
       if($id_insert > 0)
        {
            $_SESSION['success'] = "Thêm thành công";

            redirectAdmin("product");
        }
        else
        {
             $_SESSION['error'] = "Thêm thất bại";
              
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
                            <div class="clear-fix">
                                <?php if(isset($_SESSION['success'])) :?>
                             <div class="alert alert-success">
                      <?php echo$_SESSION['success'];unset($_SESSION['success'])?>
                 </div>

                    <?php endif; ?>
                        <?php if(isset($_SESSION['error'])) :?>
                            <div class="alert alert-danger">
                                <?php echo$_SESSION['error'];unset($_SESSION['error'])?>
                     </div>

                  <?php endif; ?>
                            </div>
                            <div class="col-md-12">
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-sm-12">
            <label for="exampleInputEmail1">Category_ID</label>
            <select name="category_id" class="form-control">
                <option value="">--Mời bạn chọn danh mục sản phẩm--</option>
                <?php foreach ($category as $items):  ?>
                    <option value="<?php echo $items['id'] ?> "><?php  echo $items['name'];?></option>
                <?php endforeach ?>
                

            </select>
             <?php if(isset($error['category_id'])):?>
            <p class="text-danger"> <?php echo $error['category_id'] ?></p>
        <?php endif ?>
            
        </div>

        <label for="exampleInputEmail1">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
         <?php if(isset($error['name'])):?>
            <p class="text-danger"> <?php echo $error['name'] ?></p>
        <?php endif ?>

        <label for="exampleInputEmail1">Slug</label>
        <input type="text" class="form-control" name="slug" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
         <?php if(isset($error['slug'])):?>
            <p class="text-danger"> <?php echo $error['slug'] ?></p>
        <?php endif ?>

        <label for="exampleInputEmail1">Price</label>
        <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
         <?php if(isset($error['price'])):?>
            <p class="text-danger"> <?php echo $error['price'] ?></p>
        <?php endif ?>

        <div class="col-sm-12">
            <label for="exampleInputEmail1">Sale</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" name="sale" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="0">
            </div>
             <div class="col-sm-3">
                <label for="exampleInputEmail1">Hình ảnh</label>
                <input type="file" class="form-control" name="thumbar" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" >
             
            </div>
            
              <?php if(isset($error['thumbar'])):?>
            <p class="text-danger"> <?php echo $error['thumbar'] ?></p>
        <?php endif; ?>

        </div>
        
        <label for="exampleInputEmail1">Content</label>
        <input type="text" class="form-control" name="content" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
        <label for="exampleInputEmail1">Head</label>
        <input type="text" class="form-control" name="head" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
        <label for="exampleInputEmail1">View</label>
        <input type="text" class="form-control" name="View" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
        <label for="exampleInputEmail1">Hot</label>
        <input type="text" class="form-control" name="hot" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
 
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>

       
    </main>

 <?php
 require_once __DIR__."/../../layouts/footer.php";
  ?>