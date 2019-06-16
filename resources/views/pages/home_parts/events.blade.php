<section class="section events">

    <div class="container">

        <div class="section-heading">

            <h3 class="heading">Próximos eventos</h3>

            <div class="button-fixed">
                <a class="button-to is-text-first">
                    <span>Más eventos</span>
                    <i class="icon is-right">
                        <img src="{{ asset('icons/arrow.svg') }}" alt="">
                    </i>
                </a>
            </div>

        </div>

        <div class="events-container">

            @foreach ($events as $event)

                <div class="events-column">
                    <div class="card is-horizontal">
                        <div 
                            class="card-image">
                            <div 
                                class="image is-4by5"
                                style="background-image: url('{{ asset($event->image) }}')"
                            ></div>
                    
                        </div>
                        <div class="card-content">
                            <h3 class="title">{{ $event->title }}</h3>
                            <span class="date">{{ $event->day }}</span>
                        </div>
                    </div>
                </div>
                
            @endforeach

        </div>

        <div class="button-fixed is-hidden is-show-mobile">
            <a class="button-to">
                <i class="icon is-right">
                    <img src="{{ asset('icons/arrow.svg') }}" alt="">
                </i>
                <span>Más eventos</span>
            </a>
        </div>

    </div>

</section>