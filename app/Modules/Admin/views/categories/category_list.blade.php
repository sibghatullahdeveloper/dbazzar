
@extends('Admin::layouts.backend')

@section('content')

{{--Category Data table list view--}}
    <div class="content">
        <div class="content-wrapper">

            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Datatables</span> - Basic</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none mb-3 mb-md-0">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt"></i><span>Statistics</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator"></i> <span>Invoices</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5"></i> <span>Schedule</span></a>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Basic datatable -->
                              <div class="card">
                                 <div class="card-header header-elements-inline">
                        <h5 class="card-title">Category  List</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                                  <table class="table datatable-basic">
                                      <thead>
                                      <tr>
                                          <th>Category Name</th>
                                          <th>Status</th>
                                          <th class="text-center">Actions</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($lists as $list)

                                      <tr>
                                          <td>{{$list->name}}</td>

                                          <td>
                                              <span class="badge badge-info">Pending</span>
                                          </td>
                                          <td class="text-center">
                                              <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i> Edit</a>
                                              <a href="#" class="dropdown-item"><i class="icon-file-excel"></i>Delete</a>

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
  @endsection
