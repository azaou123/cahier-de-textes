<!DOCTYPE html>
<html lang="en">
  <head>
  @include('../includes/head')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('../includes/sidebar');

      <div class="main-panel">
        <!-- Man Header -->
        @include('../includes/mainHeader');

        <div class="container">
          <div class="page-inner">
            <!-- Card -->
            <h3 class="fw-bold mb-3">Card</h3>
            <div class="row">
              <!-- Card for Cours -->
              <div class="col-sm-6 col-md-3">
                  <div class="card card-stats card-primary card-round">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-5">
                                  <div class="icon-big text-center">
                                      <i class="fas fa-book"></i>
                                  </div>
                              </div>
                              <div class="col-7 col-stats">
                                  <div class="numbers">
                                      <p class="card-category">Cours</p>
                                      <h4 class="card-title">{{ $totalCours }}</h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Card for Séances -->
              <div class="col-sm-6 col-md-3">
                  <div class="card card-stats card-info card-round">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-5">
                                  <div class="icon-big text-center">
                                      <i class="fas fa-calendar-alt"></i>
                                  </div>
                              </div>
                              <div class="col-7 col-stats">
                                  <div class="numbers">
                                      <p class="card-category">Séances</p>
                                      <h4 class="card-title">{{ $totalSeances }}</h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
        </div>

        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
