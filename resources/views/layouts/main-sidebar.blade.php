<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.comment')}} </li>
                    <!-- Grades-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main_trans.garde')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('Grades.index') }}">{{trans('main_trans.garde_list')}}</a></li>

                        </ul>
                    </li>

                    <!-- classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('Class_trans.class')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('classroom.index') }}">{{trans('Class_trans.classes')}}</a> </li>
                        </ul>
                    </li>

                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{trans('main_trans.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Section.index') }}">{{trans('Section_trans.section')}}</a> </li>

                        </ul>
                    </li>




                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-stamp"></i><span class="right-nav-text">
                                    {{trans('main_trans.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{route('Students.create')}}">{{trans('main_trans.Add_students')}}</a> </li>
                                    <li> <a href="{{route('Students.index')}}">{{trans('main_trans.list_students')}}</a> </li>
                                </ul>
                            </li>



                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main_trans.promotion_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{route('promotion.index')}}">{{trans('main_trans.promotion_students_add')}}</a> </li>
                                    <li> <a href="{{route('promotion.create')}}">{{trans('main_trans.Department_promotion_students')}}</a> </li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Gradutated_Students">{{trans('main_trans.Gradutated_Students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Gradutated_Students" class="collapse">
                                    <li> <a href="{{route('Graduated.create')}}">{{trans('main_trans.Gradutated_Students_add')}}</a> </li>
                                    <li> <a href="{{route('Graduated.index')}}">{{trans('main_trans.Gradutated_Students_list')}}</a> </li>

                                </ul>
                            </li>



                        </ul>
                    </li>

                    <!--teachers -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">
                                    {{trans('main_trans.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Teachers.index') }}">{{trans('main_trans.teachers')}}</a> </li>

                        </ul>
                    </li>
                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">
                                   {{trans('main_trans.Parents')}}  </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('add_Parent') }}">   {{trans('main_trans.list_Parents')}}  </a> </li>

                        </ul>
                    </li>
                    <!-- the accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">
                              {{trans('main_trans.accounts')}}       </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Fee.index') }}"> {{trans('main_trans.tuition_fees')}}</a> </li>
                            <li> <a href="{{ route('FeeInvoices.index') }}"> {{trans('main_trans.invoices_fees')}}</a> </li>
                            <li> <a href="{{ route('ReceiptStudents.index') }}"> {{trans('main_trans.ReceiptStudents')}}</a> </li>
                            <li> <a href="{{ route('ProcessingFee.index') }}"> {{trans('main_trans.ProcessingFee')}}</a> </li>
                            <li> <a href="{{ route('PaymentSudents.index') }}"> {{trans('main_trans.PaymentSudents')}}</a> </li>

                        </ul>
                    </li>
                    <!--Attendance الحضور والغياب-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.Attendance')}}   </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Attendance.index')}}">{{trans('main_trans.Attendance')}}</a> </li>

                        </ul>
                    </li>
    <!--subject المواد الرسيه -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.subject')}}   </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subject" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Subject.index')}}">{{trans('main_trans.subject')}}</a> </li>

                        </ul>
                    </li>

    <!--Exam الاختبارات  -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#exam">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.Exams')}}   </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="exam" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Quizzs.index')}}">{{trans('main_trans.muen_Exams')}}</a> </li>
                            <li> <a href="{{route('questions.index')}}">{{trans('main_trans.add_question')}}</a> </li>

                        </ul>
                    </li>

                    <!--libraye ألمكتبة   -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.library')}}   </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('library.index')}}">{{trans('main_trans.mune_library')}}</a> </li>
                        </ul>
                    </li>
                    <!--zoom حصص اولاين  -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#zoom">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.zoomintrgation')}}   </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="zoom" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('online_Classes.index')}}">{{trans('main_trans.inzoomintrgation')}}</a> </li>
                        </ul>
                    </li>
                    <!--Settings الاعدادات   -->
                    <li> <a href="{{route('Setting.index')}}"><i class="fa fa-cogs"></i><span class="right-nav-text"> {{trans('main_trans.Settings')}}</span></a> </li>
                     <!--Users  المستخدمين  -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text"> {{trans('main_trans.Users')}}   </span></div>
                            <div class="pull-right"><i class="fa fa-user"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="#">{{trans('main_trans.Users')}}</a> </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
