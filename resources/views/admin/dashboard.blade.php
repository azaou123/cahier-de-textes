<!DOCTYPE html>
<html lang="en">
  <head>
    @include('../includes/head')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('../includes/sidebar')

      <div class="main-panel">
        <!-- Man Header -->
        @include('../includes/mainHeader');

        <div class="container">
          <div class="page-inner">
            
          </div>
        </div>

        <!-- Include footer  -->
        @include('../includes/footer');
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts');
  </body>
</html>
