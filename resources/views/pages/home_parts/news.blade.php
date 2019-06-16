<section class="section news">

    <div class="container">

        <div class="section-heading">

            <h3 class="heading">Últimas Noticias</h3>

            <div class="button-fixed">
                <a class="button-to is-text-first">
                    <span>Más noticias</span>
                    <i class="icon is-right">
                        <img src="{{ asset('iconos/arrow.svg') }}" alt="">
                    </i>
                </a>
            </div>

        </div>
        
        <div class="news-container">

            @foreach ($articles as $article)

                <div class="news-column">
    
                    <div class="card">
                        <div  class="card-image">
                            <div 
                                class="image is-3by2"
                                style="background-image: url('{{ asset($article->image) }}')"
                            ></div>
                        </div>
        
                        <div class="card-content">
                            <h3 class="title">{{ $article->title }}</h3>
                            <p>{{ $article->description }}</p>
                        </div>
        
                    </div>
        
                </div>
                
            @endforeach

        </div>

        <div class="button-fixed is-hidden is-show-mobile">
            <a class="button-to is-text-first">
                <span>Más noticias</span>
                <i class="icon is-right">
                    <img src="{{ asset('iconos/arrow.svg') }}" alt="">
                </i>
            </a>
        </div>
    </div>

</section>