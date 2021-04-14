@extends('admin.layout')
@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
           <section id="main-content">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-12 w3ls-graph">
                            <!--agileinfo-grap-->
                                <div class="agileinfo-grap">
                                    <div class="agileits-box">
                                        <header class="agileits-box-header clearfix">
                                            <h3>Welcome {{ Session::get('adTaikhoan')}}  !!!</h3>
                                            
                                        </header>
                                        
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </section>
          

           


@endsection