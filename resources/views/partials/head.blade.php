<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- SEO básico -->
<title>SomosDevs - Soluções Tecnológicas Sob Medida</title>
<meta name="description"
    content="A SomosDevs desenvolve soluções digitais inovadoras para empresas: sistemas web, mobile e desktop moldados ao seu negócio.">
<meta name="keywords"
    content="somosdevs, tecnologia, sistemas web, sistemas mobile, ERP, CRM, desenvolvimento sob medida">
<meta name="author" content="SomosDevs">

<!-- Open Graph (para WhatsApp, Facebook, LinkedIn) -->
<meta property="og:title" content="SomosDevs - Tecnologia Moldada ao Seu Negócio">
<meta property="og:description"
    content="Transformamos ideias em soluções digitais escaláveis, seguras e inovadoras para sua empresa.">
<meta property="og:image" content="{{ asset('somosdevs/LOGO/Logo-Horizontal-Azul.png') }}">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:type" content="website">

<!-- Twitter Cards (caso compartilhem no Twitter/X) -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="SomosDevs - Tecnologia Moldada ao Seu Negócio">
<meta name="twitter:description" content="Soluções sob medida para o crescimento do seu negócio.">
<meta name="twitter:image" content="{{ asset('somosdevs/LOGO/Logo-Horizontal-Azul.png') }}">


<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<script src="https://kit.fontawesome.com/f544d27515.js" crossorigin="anonymous"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
