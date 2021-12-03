<x-layout title="{{ __('Dashboard') }}">
    <div class="row stat-cards">
        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="database" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info text-center">
                    <p class="stat-cards-info__num">The number of database created</p>
                    <p class="stat-cards-info__title">{{ $number_database }}</p>
                </div>
            </article>
        </div>


        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="users" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info text-center">
                    <p class="stat-cards-info__num">The number of Users created</p>
                    <p class="stat-cards-info__title">0</p>
                </div>
            </article>
        </div>
    </div>

    </x-lauout>
