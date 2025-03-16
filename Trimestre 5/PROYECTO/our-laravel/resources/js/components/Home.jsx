import React, { useEffect, useState } from "react";
import 'bootstrap/dist/css/bootstrap.min.css'
import '../../css/app.css'
import Iniciosesion from "./Iniciosesion";
import Nosotros from "./Nosotros";
import Privacidad from "./Privacidad";
import Recuperarpass from "./Recuperarpass";
import Registro from "./Registro";
import { Link, Route, Routes } from 'react-router-dom';
import logocdmi from "../../img/logocdmi.png";
import indigena1 from "../../img/indigena1.jpg";
import indigena2 from "../../img/indigena2.jpg";
import indigena3 from "../../img/indigena3.jpg";
import indigena4 from "../../img/indigena4.jpg";
import indigena5 from "../../img/indigena5.jpg";
import logocdmiN from "../../img/logocdmiN.png";

function Home (){
    return (
    <>
    <Routes>
      <Route>
      <Route path="/Home" Component={Home} />
      <Route path="/Iniciosesion" Component={Iniciosesion} />
      <Route path="/Nosotros" Component={Nosotros} />
      <Route path="/Recuperarpass" Component={Recuperarpass} />
      <Route path="/Registro" Component={Registro} />
      </Route>
    </Routes>
    <div>
        <Helmet>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>CDMI - Bienvenido</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet" />
        </Helmet>
    </div>
    <div>
    <nav className="navbar navbar-expand-lg navbar-dark">
    <div className="container-fluid">
      <Link className="navbar-brand" to="/Home">
      <img src={logocdmi} alt="Logo CDMI" />
      CDMI
      </Link>
      <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span className="navbar-toggler-icon"></span>
      </button>
    <div className="collapse navbar-collapse" id="navbarSupportedContent">
      <ul className="navbar-nav me-auto mb-2 mb-lg-0">
        <li className="nav-item">
        <Link className="nav-link " to="/Home">
        Home
        </Link>
        </li>
        <li className="nav-item">
        <Link className="nav-link " to="/Iniciosesion">
        Inicio de sesión
        </Link>
        </li>
        <li className="nav-item">
        <Link className="nav-link" to="/Registro">
        Registro
        </Link>
        </li>
        <li className="nav-item">
        <Link className="nav-link" to="/Nosotros">
        Nosotros
        </Link>
        </li>
      </ul>
    </div>
    </div>
    </nav>
    
    <div id="carouselExampleCaptions" className="carousel slide">
    <div className="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div className="carousel-inner">
    <div className="carousel-item active">
      <img src={indigena1} className="d-block w-100" alt="..." />
    <div className="carousel-caption d-none d-md-block">
      <h5>First slide label</h5>
      <p>Some representative placeholder content for the first slide.</p>
    </div>
    </div>
    <div className="carousel-item">
      <img src={indigena2} className="d-block w-100" alt="..." />
    <div className="carousel-caption d-none d-md-block">
      <h5>Second slide label</h5>
      <p>Some representative placeholder content for the second slide.</p>
    </div>
    </div>
    <div className="carousel-item">
      <img src={indigena3} className="d-block w-100" alt="..." />
    <div className="carousel-caption d-none d-md-block">
      <h5>Third slide label</h5>
      <p>Some representative placeholder content for the third slide.</p>
    </div>
    </div>
    </div>
      <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span className="carousel-control-prev-icon" aria-hidden="true"></span>
      <span className="visually-hidden">Previous</span>
      </button>
      <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span className="carousel-control-next-icon" aria-hidden="true"></span>
      <span className="visually-hidden">Next</span>
      </button>
    </div>

    <div className="hero-section">
      <h1>Hilamos saberes, tejemos resistencia</h1>
      <Link to="/Registro" className="btn btn-outline-light">¡Únete Ahora!</Link>
    </div>

    <div className="section bg-light">
      <h2>¿Quiénes Somos?</h2>
      <p>En CDMI, nos dedicamos a preservar y promover las tradiciones culturales a través de productos únicos y eventos
      comunitarios. Conoce más sobre nuestro impacto y cómo estamos cambiando vidas.</p>
      <img src={indigena4} alt="Sobre Nosotros" />
    </div>

    <div className="section">
      <h2>Eventos Destacados</h2>
      <p>Participa en nuestros eventos y celebra con nosotros la riqueza de nuestra cultura. Desde talleres hasta ferias,
      siempre hay algo emocionante que ocurre en CDMI.</p>
      <img src={indigena5} alt="Eventos" />
    </div>

    <div className="footer">
      <p>&copy; 2024 CDMI. Todos los derechos reservados.</p>
      <p>
      <Link to="/Contacto" className="text-white">Contáctanos
      </Link> | 
      <Link to="/Privacidad" className="text-white">Política de Privacidad
      </Link>
      </p>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous">
      </script>
    </div>
    </>
    );
}

export default Home;