@extends('layouts/main')
@section('content')
<section id="main" data-layout="layout-1">
            <!-- Sidebar section hidden for later use -->
            <aside id="sidebar" class="sidebar c-overflow hidden-md hidden-sm hidden-lg">
               <ul class="main-menu">
                  <li class="active ent">
                     <a href="index-2.html"><i class="zmdi zmdi-home"></i> Entertainment</a>
                  </li>
                  <li class="">
                     <span class="span1 green_p"> <img src="img/index.png" /></span>
                     <a href="#"> Apartments</a>
                  </li>
                  <li class="">
                     <span class="span1 red_p"><img src="img/index02.png" /></span>
                     <a href="#"> Duplex</a>
                  </li>
               </ul>
               <ul class="bottom-menu main-menu">
                  <li> Account</li>
                  <li> Redeem</li>
                  <li> Buy Gift Cart</li>
                  <li> My wishlist</li>
                  <li> My play activity</li>
                  <li> Parent Guide</li>
               </ul>
            </aside>
            <!-- Sidebar section END -->
            <!-- Main Content  -->
            <section id="">
               <!-- Video Section Start-->
               <div class="container-fluid">
                    <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                     <div class="card-body">
                        <div class="v-cap">
                           <h1>Interactive Architectural Visualization  </h1>
                           <p>Augmented Reality | Virtual Reality | </p>
                           <p>Real Time Rendering | Unique Visualization Experience </p>
                        </div>
                        <div class="video-div">
                            <video  autoplay="true">
    <source src="https://youtu.be/ulee0eOR1Ak" type="video/mp4" />
</video>
                           <!--<video autoplay="true" loop="" class="" data-wow-delay="0.5s" poster="https://s3-us-west-2.amazonaws.com/coverr/poster/Traffic-blurred2.jpg" id="video-background" style="visibility: visible; -webkit-animation: fadeIn 0.5s;">
                              <source src="media/mp4_video.mp4" type="video/mp4">
                              Your browser does not support the video tag. I suggest you upgrade your browser.
                           </video>-->
                        </div>
                     </div>
                  </div>

                   </div>

                    </div>
                  <!-- Video Section END -->
                  <!-- Content Section Start-->
                 
                   <div class="clearfix"></div>
                   <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body card-padding text-center">
                           <h2> UNIVERSAL DIGITAL APP</h2>
                           <p>
                              Digital marketing tools with digital brochure integration can be used anywhere and anytime. Available for both Apple and Android.
                           </p>
                        </div>
                     </div>
                  </div>
                       </div>
                  <!-- Content Section End -->
              </div>
            </section>
            <!-- Main Section Ends -->
         </section>
@stop