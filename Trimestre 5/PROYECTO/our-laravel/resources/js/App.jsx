import React, { useEffect, useState } from "react";
import 'bootstrap/dist/css/bootstrap.min.css'
import '../css/app.css'
import Iniciosesion from "../js/components/Iniciosesion";
import Home from "../js/components/Home";
import Nosotros from "../js/components/Nosotros";
import Privacidad from "../js/components/Privacidad";
import Recuperarpass from "../js/components/Recuperarpass";
import Registro from "../js/components/Registro";
/*import { Link, Route, Routes } from 'react-router-dom';*/
import logocdmi from "../img/logocdmi.png";
import indigena1 from "../img/indigena1.jpg";
import indigena2 from "../img/indigena2.jpg";
import indigena3 from "../img/indigena3.jpg";
import indigena4 from "../img/indigena4.jpg";
import indigena5 from "../img/indigena5.jpg";
import logocdmiN from "../img/logocdmiN.png";


const App = () => {
    return (
        <><Routes>
            <Route>
                <Route path="/Home" Component={Home} />
                <Route path="/Iniciosesion" Component={Iniciosesion} />
                <Route path="/Nosotros" Component={Nosotros} />
                <Route path="/Privacidad" Component={Privacidad} />
                <Route path="/Recuperarpass" Component={Recuperarpass} />
                <Route path="/Registro" Component={Registro} />
            </Route>
        </Routes><div>
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
                                    <Link className="nav-link " to="/Home">Home
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div className="container">
                    <div className="section-header">
                        <h1 className="text-dark">Bienvenido a CDMI</h1>
                        <p>Descubre nuestras iniciativas y proyectos para apoyar a las comunidades indígenas</p>
                    </div>

                    <div className="section-content row">
                        <div className="col-md-6 img-container">
                            <img src={logocdmiN} className="img-fluid" alt="Imagen representativa" />
                        </div>
                        <div className="col-md-6">
                            <h2>Conoce más sobre nuestros proyectos</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae velit faucibus, a congue
                                eros posuere. Sed bibendum ex at libero vehicula, non dapibus nisi auctor. Fusce feugiat, metus eu elementum
                                hendrerit, leo arcu egestas dolor, sit amet commodo eros libero sed lectus. Donec vitae velit nunc. Vestibulum
                                auctor dolor a nunc facilisis, sit amet commodo enim ullamcorper. Curabitur suscipit eros a orci tincidunt, id
                                fringilla lectus consequat.</p>
                            <p>Nam condimentum, orci et tincidunt dictum, odio velit condimentum justo, a vehicula sem lorem et nunc.
                                Aliquam erat volutpat. Curabitur nec purus ligula. Nulla facilisi. Sed gravida quam sed cursus cursus.
                                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                        </div>
                    </div>

                    <div className="section-content row mt-5">
                        <div className="col-md-6">
                            <h2>Más información</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae velit faucibus, a congue
                                eros posuere. Sed bibendum ex at libero vehicula, non dapibus nisi auctor. Fusce feugiat, metus eu elementum
                                hendrerit, leo arcu egestas dolor, sit amet commodo eros libero sed lectus. Donec vitae velit nunc. Vestibulum
                                auctor dolor a nunc facilisis, sit amet commodo enim ullamcorper. Curabitur suscipit eros a orci tincidunt, id
                                fringilla lectus consequat.</p>
                        </div>
                        <div className="col-md-6 img-container">
                            <img src={indigena4} className="img-fluid" alt="Imagen representativa" />
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                    crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
                    crossorigin="anonymous">
                </script>
            </div><div>App umjum</div></>
    )
}

export default App

if (document.getElementById('root')) {
    const Index = ReactDOM.createRoot(document.getElementById("root"));

    Index.render(
        <React.StrictMode>
            <App/>
        </React.StrictMode>
    )
}