@extends('admin.layout')
@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
           <section id="main-content">
                <div class="row justify-content-around" >
                    <div class="panel-body" >
                        <div class="col-md-12 w3ls-graph ">
                            <!--agileinfo-grap-->
                                <div class="agileinfo-grap ">
                                    <div class="agileits-box">
                                        <header class="agileits-box-header clearfix">
                                            <br/>
                                            <h2>Welcome {{ Session::get('adTen')}}!!!</h2>
                                        </header>
                                        
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </section>
          

           


@endsection