<div role="tabpanel" class="tab-pane  animated fadeInRight" id="transfer">
    <div class="tab-header">
        <h2>Transfer Ownership</h2>
    </div>

    <div class="clearfix"></div>
    <?php if(count($transfer_project)==0){ ?>
    <form class="form-horizontal store"  name="transfer_project" id="transfer_project" method="POST" action="{{url('project/transfer_project')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input class="form-control input-sm" id="pidmenu1" type="hidden" value="{{$project->id}}" name="pid">
        <div class="card-body card-padding">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input class="form-control" type="text" name="email" id="email"  placeholder="Email Address to transfer">                     
                    </div>
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-info pull-right">Save<i class="fa fa-chevron-right"></i></button>
        <br />
    </form> <?php } else{ ?>
     <div class="card-body card-padding">
        <h4> Your transfer project request is pending</h4>
    </div>
   
    <?php }?>
</div>