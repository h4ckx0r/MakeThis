<?php

test('home page renders the wireframe layout', function () {
    $response = $this->get(route('home'));

    $response
        ->assertSuccessful()
        ->assertSee('MakeThis')
        ->assertSee('Animación')
        ->assertSee('Servicios')
        ->assertSee('Noticia Blog')
        ->assertSee('Producto')
        ->assertSee('Contacto');
});
