@include('backend.layouts.head')
 
<!-- Page Wrapper -->
<div id="wrapper">
 
  @include('backend.layouts.sidebar')
 
  <!-- Content Wrapper -->
  <div id="content-wrapper" CLASS="d-flex flex-column">
 
    <!-- Main Content -->
    <div id="content">
 
        @include('backend.layouts.navbar')
 
      <!-- Begin Page Content -->
      <div CLASS="container-fluid">
 
          @yield('main-content')
 
      </div>
      <!-- /.container-fluid -->
 
    </div>
    <!-- End of Main Content -->
 
    @include('backend.layouts.footer')
 
  </div>
  <!-- End of Content Wrapper -->
 
</div>
<!-- End of Page Wrapper -->
 
  @include('backend.layouts.js')