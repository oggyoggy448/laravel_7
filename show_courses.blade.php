@if($featured_courses->count())
        <div class="home-section-wrap home-featured-courses-wrapper py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">
                                {{__t('featured_courses')}}

                                <a href="{{route('featured_courses')}}" class="btn btn-link float-right"><i class="la la-bookmark"></i> {{__t('all_featured_courses')}}</a>
                            </h3>

                            <p class="section-subtitle">{{__t('featured_courses_desc')}}</p>
                        </div>
                    </div>
                </div>
                <div class="popular-courses-cards-wrap mt-3">
                    <div class="row">
                        @foreach($featured_courses as $course)
                            {!! course_card($course, 'col-md-3') !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
