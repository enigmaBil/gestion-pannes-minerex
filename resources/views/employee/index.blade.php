@extends('layouts.employee')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-6">

        <div class="container ">
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) signalé (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('panne.create')}}" class="small-box-footer">
                                    Signaler une panne <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) en cours de resolution</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Consulter les panne en cours de resolution <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-green">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Panne (s) resolue (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('panne.index')}}" class="small-box-footer">
                                    Consulter la liste des pannes <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Guide pour signaler une panne</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            Pour signaler une panne veillez suivre les etapes sivantes:<br>
                            <ol>
                                <li>Cliquez sur l'onglet Service</li>
                                <li>Cliquez sur signaler une panne</li>
                                <li>Remplir le formulaire de signalisation des pannes</li>
                            </ol>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card bg-gradient-success mt-3" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendrier
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">September 2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="09/01/2024" class="day weekend">1</td><td data-action="selectDay" data-day="09/02/2024" class="day">2</td><td data-action="selectDay" data-day="09/03/2024" class="day">3</td><td data-action="selectDay" data-day="09/04/2024" class="day">4</td><td data-action="selectDay" data-day="09/05/2024" class="day">5</td><td data-action="selectDay" data-day="09/06/2024" class="day">6</td><td data-action="selectDay" data-day="09/07/2024" class="day weekend">7</td></tr><tr><td data-action="selectDay" data-day="09/08/2024" class="day weekend">8</td><td data-action="selectDay" data-day="09/09/2024" class="day">9</td><td data-action="selectDay" data-day="09/10/2024" class="day">10</td><td data-action="selectDay" data-day="09/11/2024" class="day">11</td><td data-action="selectDay" data-day="09/12/2024" class="day">12</td><td data-action="selectDay" data-day="09/13/2024" class="day active today">13</td><td data-action="selectDay" data-day="09/14/2024" class="day weekend">14</td></tr><tr><td data-action="selectDay" data-day="09/15/2024" class="day weekend">15</td><td data-action="selectDay" data-day="09/16/2024" class="day">16</td><td data-action="selectDay" data-day="09/17/2024" class="day">17</td><td data-action="selectDay" data-day="09/18/2024" class="day">18</td><td data-action="selectDay" data-day="09/19/2024" class="day">19</td><td data-action="selectDay" data-day="09/20/2024" class="day">20</td><td data-action="selectDay" data-day="09/21/2024" class="day weekend">21</td></tr><tr><td data-action="selectDay" data-day="09/22/2024" class="day weekend">22</td><td data-action="selectDay" data-day="09/23/2024" class="day">23</td><td data-action="selectDay" data-day="09/24/2024" class="day">24</td><td data-action="selectDay" data-day="09/25/2024" class="day">25</td><td data-action="selectDay" data-day="09/26/2024" class="day">26</td><td data-action="selectDay" data-day="09/27/2024" class="day">27</td><td data-action="selectDay" data-day="09/28/2024" class="day weekend">28</td></tr><tr><td data-action="selectDay" data-day="09/29/2024" class="day weekend">29</td><td data-action="selectDay" data-day="09/30/2024" class="day">30</td><td data-action="selectDay" data-day="10/01/2024" class="day new">1</td><td data-action="selectDay" data-day="10/02/2024" class="day new">2</td><td data-action="selectDay" data-day="10/03/2024" class="day new">3</td><td data-action="selectDay" data-day="10/04/2024" class="day new">4</td><td data-action="selectDay" data-day="10/05/2024" class="day new weekend">5</td></tr><tr><td data-action="selectDay" data-day="10/06/2024" class="day new weekend">6</td><td data-action="selectDay" data-day="10/07/2024" class="day new">7</td><td data-action="selectDay" data-day="10/08/2024" class="day new">8</td><td data-action="selectDay" data-day="10/09/2024" class="day new">9</td><td data-action="selectDay" data-day="10/10/2024" class="day new">10</td><td data-action="selectDay" data-day="10/11/2024" class="day new">11</td><td data-action="selectDay" data-day="10/12/2024" class="day new weekend">12</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month active">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year active">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
