<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #065F2C; }

    .conten {
        position: fixed;
        top: 2em;
        width: 100%;
        text-align: center; }
    .conten__img {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center; }
        .conten__img img {
        width: 300px;
        display: block;
        -webkit-animation: animates 2s linear infinite alternate;
        animation: animates 2s linear infinite alternate; }
    .conten__number {
        position: absolute;
        font-size: 5.5rem;
        font-family: "Gill Sans", sans-serif;
        font-weight: 600;
        top: 20rem;
        color: rgba(255, 255, 255, 0.5);
        -webkit-animation: animatestext 2s linear infinite alternate;
        animation: animatestext 2s linear infinite alternate; }
    .conten__error {
        color: #ffffff;
        width: 50%;
        margin: 5em auto 2em auto;
        font-family: "Gill Sans", sans-serif; }
    .conten__button {
        background-color: #0077d8f4;
        color: #ffffff;
        font-weight: 600;
        font-family: "Gill Sans", sans-serif;
        padding: 0.8em 1em;
        border-radius: 50px;
        text-decoration: none; }

    @-webkit-keyframes animates {
    0% {
        -webkit-transform: translateX(5%);
        transform: translateX(5%); }
    100% {
        -webkit-transform: translateX(-5%);
        transform: translateX(-5%); } }

    @keyframes animates {
    0% {
        -webkit-transform: translateX(5%);
        transform: translateX(5%); }
    100% {
        -webkit-transform: translateX(-5%);
        transform: translateX(-5%); } }

    @-webkit-keyframes animatestext {
    0% {
        -webkit-transform: rotate(5deg);
        transform: rotate(5deg); }
    100% {
        -webkit-transform: rotate(-5deg);
        transform: rotate(-5deg); } }

    @keyframes animatestext {
    0% {
        -webkit-transform: rotate(5deg);
        transform: rotate(5deg); }
    100% {
        -webkit-transform: rotate(-5deg);
        transform: rotate(-5deg); } }
    
</style>
    
    <div class="conten">
        <div class="conten__img">
            <img src="<?php echo SERVERURL;?>view/img/logomaiz1.png" alt="">
            <p class="conten__number">
                404
            </p>
        </div>
        <div class="conten__Description">
            <p class="conten__error">
                UPSSSS!!!! Algo salio mal, pagina no encontrada.
            </p>
        <a href="<?php echo SERVERURL;?>home-agro/" class="conten__button">SACAME DE AQUI!.</a>
        </div>
    </div>
</body>
</html>