@extends('layout.app')
@section('title', 'Login Page Masbro')
@section('content')
<!-- contact area -->
<div class="section-full content-inner-2 shop-account">
   <!-- Product -->
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center">
            <h3 class="font-weight-700 m-t0 m-b20">Login Your Account</h3>
         </div>
      </div>
      <div>
         <div class="max-w500 m-auto m-b30">
            <div class="p-a30 border-1 seth">
               <div class="tab-content nav">
                  <form id="login" method="post" class="tab-pane active col-12 p-a0 ">
                     @csrf
                     <h4 class="font-weight-700">LOGIN</h4>
                     <p class="font-weight-600">If you have an account with us, please log in.</p>

                     @if ($errors->any())
                         <div class="alert alert-danger">
                             <ul>
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif
                     <div class="form-group">
                        <label class="font-weight-700">E-MAIL *</label>
                        <input name="email" required="" class="form-control" placeholder="Your Email Id" type="email">
                     </div>
                     <div class="form-group">
                        <label class="font-weight-700">PASSWORD *</label>
                        <input name="password" required="" class="form-control " placeholder="Type Password" type="password">
                     </div>
                     <div class="text-left">
                        <button class="site-button m-r5 button-lg">login</button>
                        <a data-toggle="tab" href="#forgot-password" class="m-l5"><i class="fa fa-unlock-alt"></i> Forgot Password</a> 
                     </div>
                  </form>
                  <form id="forgot-password" class="tab-pane fade  col-12 p-a0">
                     <h4 class="font-weight-700">FORGET PASSWORD ?</h4>
                     <p class="font-weight-600">We will send you an email to reset your password. </p>
                     <div class="form-group">
                        <label class="font-weight-700">E-MAIL *</label>
                        <input name="dzName" required="" class="form-control" placeholder="Your Email Id" type="email">
                     </div>
                     <div class="text-left"> 
                        <a class="site-button outline gray button-lg" data-toggle="tab" href="#login">Back</a>
                        <button class="site-button pull-right button-lg">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Product END -->
</div>
<!-- contact area  END -->
</div>
@endsection