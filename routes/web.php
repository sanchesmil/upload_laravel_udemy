<?php

Route::get('/', 'PostControlador@index');   // mostra todos os posts e suas imagens

Route::post('/', 'PostControlador@store');  // armazena um novo post na base e sua imagem no storage
Route::delete('/{id}','PostControlador@destroy');  // apaga um post e sua imagem

Route::get('/download/{id}','PostControlador@download'); // realiza o download da imagem de um post


