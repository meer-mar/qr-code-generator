@extends('dashboard.admin.layouts.app')
@section('page_title', 'Dashboard')

@section('admin-content')
    <div class="main-content">
        {{-- Show Credentials Setup Alert --}}
        <div class="alert alert-danger alert-has-icon alert-dismissible d-none" id="missingCrentialsAlert">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title"></div>
                <button class="close" id="missingCrentialsAlertClose" data-dismiss="alert">
                    <span><i class="fas fa-times"></i></span>
                </button>
                <b><a class="btn btn-sm btn-outline-warning" href="">{{ __('Update') }}</a></b>
            </div>
        </div>

        <section class="section">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Order</h4>
                                </div>
                                <div class="card-body">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pending Order</h4>
                                </div>
                                <div class="card-body">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Courses</h4>
                                </div>
                                <div class="card-body">
                                    73
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pending Courses</h4>
                                </div>
                                <div class="card-body">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Earnings</h4>
                                </div>
                                <div class="card-body">
                                    $326.10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>This Years Earnings</h4>
                                </div>
                                <div class="card-body">
                                    $0.00
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>This Month Earnings</h4>
                                </div>
                                <div class="card-body">
                                    $0.00
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Todays Earnings</h4>
                                </div>
                                <div class="card-body">
                                    $0.00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Area Chart -->
                    <div class="col">
                        <div class="mb-4 shadow card">
                            <!-- Card Header - Dropdown -->
                            <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"> Sales In
                                    March, 2025
                                </h6>
                                <div class="form-inline">
                                    <form method="get" onchange="$(this).trigger(&#39;submit&#39;);">
                                        <select name="year" id="year" class="form-control">
                                            <option value="2024">
                                                2024</option>
                                        </select>
                                        <select name="month" id="month" class="form-control">
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03" selected="">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"
                                        style="display: block; box-sizing: border-box; height: 270px; width: 1159px;"
                                        width="1449" height="337"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h5>Recent Courses</h5>
                                <div class="card-description">(3)
                                    Courses are pending</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a href="http://rashidchachu.test/admin/courses/73/edit" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Explicabo Voluptate</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Jason Thorne</div>
                                            <div class="bullet"></div>
                                            <div>pending</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">1 month ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/courses/72/edit" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>asdasdsad</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Jason Thorne</div>
                                            <div class="bullet"></div>
                                            <div>pending</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">1 month ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/courses/71/edit" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>asdsadsadasdsad</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Mark Davenport</div>
                                            <div class="bullet"></div>
                                            <div>pending</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">1 month ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/courses/70/edit" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Artificial Intelligence in Business</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Mark Davenport</div>
                                            <div class="bullet"></div>
                                            <div>approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/courses/69/edit" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Remote Work Productivity: Tips and Tools</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Jason Thorne</div>
                                            <div class="bullet"></div>
                                            <div>approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/courses" class="ticket-item ticket-more">
                                        View All <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-blog"></i>
                                </div>
                                <h5>Recent Blogs</h5>
                                <div class="card-description">(0)
                                    Blogs are pending</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a href="http://rashidchachu.test/admin/blogs/9/edit?code=en" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Top Classroom Resources for Teachers</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>rashid Hussain</div>
                                            <div class="bullet"></div>
                                            <div>Approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/blogs/8/edit?code=en" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Latest Research in Educational Technology</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>rashid Hussain</div>
                                            <div class="bullet"></div>
                                            <div>Approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/blogs/7/edit?code=en" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Promoting Health and Wellbeing in Schools</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>rashid Hussain</div>
                                            <div class="bullet"></div>
                                            <div>Approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/blogs/6/edit?code=en" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Effective Evaluation Techniques for Teachers</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>rashid Hussain</div>
                                            <div class="bullet"></div>
                                            <div>Approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/blogs/5/edit?code=en" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Parental Involvement: Building Strong Home</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>rashid Hussain</div>
                                            <div class="bullet"></div>
                                            <div>Approved</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago</div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/blogs" class="ticket-item ticket-more">
                                        View All <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Recent Contacts</h5>
                                <div class="card-description">Here is your recent contacts messages</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a href="http://rashidchachu.test/admin/contact-message/6" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Unleash the Power of Tech with Us!</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Vincent Watkins</div>
                                            <div class="bullet"></div>
                                            <div>tyquwafe@mailinator.com</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago
                                            </div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/contact-message/5" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Breaking Tech News: Dive In Now</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Adele Kirby</div>
                                            <div class="bullet"></div>
                                            <div>vyfeq@mailinator.com</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago
                                            </div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/contact-message/4" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Your Tech Digest: Stay Informed</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Cecilia Medina</div>
                                            <div class="bullet"></div>
                                            <div>bedaf@mailinator.com</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago
                                            </div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/contact-message/3" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Exclusive Tech Insights Just for You!</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Sade Carpenter</div>
                                            <div class="bullet"></div>
                                            <div>repany@mailinator.com</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago
                                            </div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/contact-message/2" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Exclusive Tech Insights Just for You!</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>Edward Crawford</div>
                                            <div class="bullet"></div>
                                            <div>cumywojy@mailinator.com</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">8 months ago
                                            </div>
                                        </div>
                                    </a>
                                    <a href="http://rashidchachu.test/admin/contact-messages"
                                        class="ticket-item ticket-more">
                                        View All <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
