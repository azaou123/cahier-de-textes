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
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Liste des Cours</h4>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                          <div class="row">
                              <div class="col-sm-12 col-md-6">
                                  <div class="dataTables_length" id="basic-datatables_length">
                                      <label>Show 
                                          <select name="basic-datatables_length" aria-controls="basic-datatables" class="form-control form-control-sm">
                                              <option value="10">10</option>
                                              <option value="25">25</option>
                                              <option value="50">50</option>
                                              <option value="100">100</option>
                                          </select> entries
                                      </label>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                  <div id="basic-datatables_filter" class="dataTables_filter">
                                      <label>Search:
                                          <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatables">
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
                                      <thead>
                                          <tr role="row">
                                              <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Nom: activate to sort column ascending" style="width: 135.656px;">Nom du Cours</th>
                                              <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 213.922px;">Description</th>
                                              <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Filière: activate to sort column ascending" style="width: 100.906px;">Filière</th>
                                              <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 98.7188px;">Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($cours as $cour)
                                              <tr role="row" class="{{ $loop->even ? 'even' : 'odd' }}">
                                                  <td>{{ $cour->Nom_Cours }}</td>
                                                  <td>{{ $cour->Description_Cours }}</td>
                                                  <td>{{ $cour->filiere->Nom_Filiere }}</td>
                                                  <td>
                                                    <!-- View Button with Icon -->
                                                    <a href="{{ route('professeur.courseResources', $cour->ID_Cours) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-eye"></i> <!-- Font Awesome Eye Icon -->
                                                    </a>

                                                   
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
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
