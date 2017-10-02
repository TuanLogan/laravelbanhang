@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')

<div class="box-body table-responsive no-padding">
  	<div class="col-lg-3 col-md-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$countProduct}}</h3>
          <p>Products</p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
        <a href="{{route('product.list')}}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-xs-6">
          <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$countSlide}}</h3>

          <p>Slides</p>
        </div>
        <div class="icon">
          <i class="fa fa-file-word-o"></i>
        </div>
        <a href="{{route('slide.list')}}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-xs-6">
          <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$countCustomer}}</h3>

            <p>Customers</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('customer.list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$countProductSel}}</h3>

            <p>Selled Products</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
        </div>
      </div>
</div>
<div class="box-body table-responsive no-padding">
  <div class="col-lg-3 col-md-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{$countContact}}</h3>

        <p>Contact Support</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{route('contact.list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-md-4 col-xs-6">
          <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$countRevenue}} $</h3>

          <p>Revenue</p>
        </div>
        <div class="icon">
          <i class="fa fa-file-word-o"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-4 col-xs-6">
          <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$countUser}}</h3>

            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('user.list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
@endsection