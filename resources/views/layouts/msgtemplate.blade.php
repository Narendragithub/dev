@if(Session::has('error'))
                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3 alert alert-danger text-center" style="margin-top: 10px;">
                                            {{Session::get('error')}}
                                        </div>
                                </div>
                                @endif
                                @if(Session::has('message'))
                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3 alert alert-success text-center" style="margin-top: 10px;">
                                            {{Session::get('message')}}
                                        </div>
                                </div>
                                @endif