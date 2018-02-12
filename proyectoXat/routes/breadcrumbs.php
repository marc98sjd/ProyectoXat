<?php

// Inicio
Breadcrumbs::register('inicio', function ($breadcrumbs) {
    $breadcrumbs->push('Inicio', route('root'));
});

// Inicio > Registro
Breadcrumbs::register('register', function ($breadcrumbs) {
    $breadcrumbs->parent('inicio');
    $breadcrumbs->push('Registro', route('register'));
});

// Inicio > Login
Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('inicio');
    $breadcrumbs->push('Login', route('login'));
});

// Menú
Breadcrumbs::register('main', function ($breadcrumbs) {
    $breadcrumbs->push('Menú', route('home'));
});

// Menú > Xat
Breadcrumbs::register('xat', function ($breadcrumbs) {
    $breadcrumbs->parent('main');
    $breadcrumbs->push('Chat', route('xat'));
});

// Menú > Denuncias
Breadcrumbs::register('denuncias', function ($breadcrumbs) {
    $breadcrumbs->parent('main');
    $breadcrumbs->push('Denuncias', route('denuncias'));
});

// Menú > Debates
Breadcrumbs::register('debates', function ($breadcrumbs) {
    $breadcrumbs->parent('main');
    $breadcrumbs->push('Debates', route('debates'));
});

// Menú > Notícias
Breadcrumbs::register('noticias', function ($breadcrumbs) {
    $breadcrumbs->parent('main');
    $breadcrumbs->push('Notícias', route('noticias'));
});

/* Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
}); */