<x-user-layout>



        <!-- Masthead-->
        <header class="masthead" id="Main">
            <div class="container">
                <div class="masthead-subheading">Welcome To Super DB</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="{{ route('users.login') }}">{{ __('Log In') }}</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">Here are the main services of SuperDB.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Database Management</h4>
                        <p class="text-muted">You can create and update connections, databases, and tables easily and effeciently. SuperDB also alows you to save snapshots for your databases.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Users Manegement</h4>
                        <p class="text-muted">You can create multiple users accounts, update them. And also assign specific roles to specific users.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Roles and Permissions Management</h4>
                        <p class="text-muted">SuperDB makes it easy for you to assign permissions for each user role. You can add multiple permissions for a specific role, edit, and delete them effeciently.</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Great teamwork is the only way we create the breakthroughs that define our careers.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('/user-layout-assets/assets/img/team/1.jpg') }}" alt="..." />
                            <h4>Mohammed Dweikat</h4>
                            <p class="text-muted">Full Stack<br>Flutter Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('/user-layout-assets/assets/img/team/2.jpg') }}" alt="..." />
                            <h4>Serin Ahmad</h4>
                            <p class="text-muted">Full Stack Developer<br>Data Scientist</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{ asset('/user-layout-assets/assets/img/team/3.jpg') }}" alt="..." />
                            <h4>Hamza Alkharouf</h4>
                            <p class="text-muted">Full Stack<br>Flutter Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

</x-user-layout>