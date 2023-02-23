@extends('dashboard.admin.layouts.master')
@section('content')
<div class="col-md-6">
    
      {{-- SHOW MODAL --}}
      <div class="lightbox-blanket d-none" id="edit">
        <div class="pop-up-container">
          <div class="pop-up-container-vertical">
            <div class="pop-up-wrapper">
              <div class="go-back close" data-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-left"></i>
              </div>
              <div class="product-details">
                <div class="product-left">
                  <div class="product-info">
                    <div class="product-manufacturer">NOOK
                    </div>
                    <div class="product-title">
                      LOUNGE CHAIR
                    </div>
                    <div class="product-price" price-data="320.03">
                      $320<span class="product-price-cents">03</span>
                    </div>
                  </div>
                  <div class="product-image">
                    <img id="img-product" alt="your image"  style="max-width: 100%;"/>
                  </div>
                </div>
                <div class="product-right">
                  <div class="product-description">
                    Designer Karim Rashid continues to put his signature spin on all genres of design through various collaborations with top-notch companies. Another one to add to the win column is his work with Italian manufacturer Chateau d’Ax.
                  </div>
                  <ul class="list-group mt-3">
                    <ul class="list-group mt-3">
                      <li class="list-group-item active text-center">Information Product</li>
                      <li class="list-group-item d-flex">name:&ensp;<p class="nameValue"></p></li>
                      <li class="list-group-item d-flex">stock:&ensp;<p class="stockValue"></p></li>
                      <li class="list-group-item d-flex">expired at:&ensp;<p class="expired_atValue"></p></li>
                      <li class="list-group-item d-flex">sku:&ensp;<p class="skuValue"></p></li>
                      <li class="list-group-item d-flex">Category id:&ensp;<p class="category_idValue"></p></li>
                    </ul>
                  </ul>
                  <div class="product-available">
                    In stock. <span class="product-extended"><a href="#">Buy Extended Warranty</a></span>
                  </div>
                  <div class="product-rating">
                    <i class="fa fa-star rating" star-data="1"></i>
                    <i class="fa fa-star rating" star-data="2"></i>
                    <i class="fa fa-star rating" star-data="3"></i>
                    <i class="fa fa-star" star-data="4"></i>
                    <i class="fa fa-star" star-data="5"></i>
                    <div class="product-rating-details">(3.1 - <span class="rating-count">1203</span> reviews)
                    </div>
    
                  </div>
                  <div class="product-quantity">
                    <label for="product-quantity-input" class="product-quantity-label">Quantity</label>
                    <div class="product-quantity-subtract">
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <div>
                      <input type="text" id="product-quantity-input" placeholder="0" value="0" />
                    </div>
                    <div class="product-quantity-add">
                      <i class="fa fa-chevron-right"></i>
                    </div>
                  </div>
                </div>
                <div class="product-bottom">
                  <div class="product-checkout">
                    Total Price
                    <div class="product-checkout-total">
                      <i class="fa fa-usd"></i>
                      <div class="product-checkout-total-amount">
                        0.00
                      </div>
                    </div>
                  </div>
                  <div class="product-checkout-actions">
                    <a class="add-to-cart" href="#" onclick="AddToCart(event);">Add to Cart</a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Product</h3>
        </div>  
    
    
    <form action="{{ route('admin.product.update', $product->id) }}" method='post'  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
         @endforeach --}}
            <div class="card-body pt-3 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $product->name }}">
                </div>
                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock*</label>
                    <input type="text" class="form-control" id="stock" placeholder="Enter stock" name="stock" value="{{ $product->stock }}">
                </div>
                <span class="text-danger">@error('stock'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Expired at</label>
                    <input type="date" class="form-control" id="expired_at" placeholder="Enter expired at" name="expired_at" value="{{ $product->expired_at->format('Y-m-d')}}">
                </div>
                <span class="text-danger">@error('expired_at'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sku*</label>
                    <input type="text" class="form-control" id="sku" placeholder="Enter sku" name="sku" value="{{ $product->sku }}">
                </div>
                <span class="text-danger">@error('sku'){{ $message }} @enderror</span>
            </div>
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category id*</label>
                    <input type="text" class="form-control" id="category_id" placeholder="Enter category id" name="category_id" value="{{ $product->category_id }}">
                </div>
                <span class="text-danger">@error('category_id'){{ $message }} @enderror</span>
            </div> 
            <div class="card-body pt-0 ps-2 pe-2">
                <div class="form-group"> 
                        <label for="exampleInputEmail1">Avatar*</label>
                        <button class="btn-warning" style="display: block">
                            <input accept="image/*" type='file' id="imgInp" name="file_upload"/>
                            <label for="file_upload" class="files"><i class="material-icons">add_photo_alternate</i>Choose a photo</label>
                        </button>
                        <span class="text-danger">@error('file_upload'){{ $message }} @enderror</span>
                </div>
                <img id="blah" src="{{ asset('uploads/product/'.$product->avatar) }}" alt="your image"  style="max-width: 100%;"/>
            </div>
        <div class="card-footer float-left">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <div class="card-footer float-left ml-3">
            <button type ="button" class="btn btn-info preview" data-toggle="modal" data-target="#edit">Preview</button>
        </div>
    </form>
@endsection
