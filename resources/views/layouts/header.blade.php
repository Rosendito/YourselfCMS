<header class="header">
    <style>
        .button-especial{
            display: inline-block;
            padding: 0 1rem;
            height: 40px;
            line-height: 40px;
            background: #2b3aab;
            border-radius: 3px;
            font-weight: 400;
            transition: all .15s ease-out;
            color: white;
        }

        .button-especial:hover{
            background: hsla(233, 60%, 37%, 1);
            color: white;
        }
    </style>

    <div class="container">
        <div class="header-complementary">
            <div class="header-logo">
                <img src="{{ asset('img/Logo.svg') }}">
            </div>
    
            <a href="" class="button-especial">Ingreso Intranet</a>

            <a class="header-menu-mobile button-menu has-icon">
                <span>Menú</span>
                <i class="icon">
                    <img src="{{ asset('iconos/menu.svg') }}" alt="">
                </i>
            </a>
        </div>
    
        <div class="header-menu">
            <nav class="header-menu-left">
                <a href="" class="header-menu-item">
                    <span>Inicio</span>
                </a>
                <a href="" class="header-menu-item">
                    <span>Oferta Académica</span>
                    <i class="icon">
                        <img src="{{ asset('iconos/keyboard_arrow.svg') }}" alt="">
                    </i>
                </a>
                <a href="" class="header-menu-item">
                    <span>Noticias</span>
                </a>
                <a href="" class="header-menu-item">
                    <span>Galería</span>
                </a>
                <a href="" class="header-menu-item">
                    <span>Nosotros</span>
                </a>
            </nav>

            <nav class="header-menu-right">
                <a href="" class="header-menu-item">
                    <span>Inscripción</span>
                </a>
                <a href="" class="header-menu-item">
                    <span>Contacto</span>
                </a>
                <a href="" class="header-menu-item">
                    <span>Soporte</span>
                </a>
                <a href="" class="button-menu">
                    <i class="icon">
                        <img src="{{ asset('iconos/search.svg') }}" alt="">
                    </i>
                </a>
            </nav>
        </div>
    </div>
</header>