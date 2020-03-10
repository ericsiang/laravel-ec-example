@include('manager.inc.head')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>  Gallery <small></small> </h3>
        </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2><small> </small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>-->
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="row">
                @php
                    //dd($ProductMultipleImgs);
                @endphp  
                @foreach ($ProductMultipleImgs as $tinymceImgs)
                    <div class="col-md-55">
                    <div class="thumbnail">
                        <a href="#"><i class="fa fa-times"></i></a>
                        <div class="image view view-first" style="width: 200px;height:275px;">
                        <img style="width: 100%;height: 100%; display: block;" src="{{ asset('storage/'.$tinymceImgs->img) }}" alt="image" />
                        <div class="mask" style="width: 100%;height: 100%">
                            <p></p>
                            <!--<div class="tools tools-bottom" style="margin:128px 0 0;">
                            <a href="#"><i class="fa fa-link"></i></a>
                            <a href="#"><i class="fa fa-pencil"></i></a>
                            
                            </div>-->
                        </div>
                        
                        </div>
                        <div class="caption">
                           
                        <p>Snow and Ice Incoming for the South</p>
                        </div>
                    </div>
                    </div>
                @endforeach
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
