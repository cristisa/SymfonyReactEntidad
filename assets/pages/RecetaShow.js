import React, {useState, useEffect} from 'react';
import { Link, useParams } from "react-router-dom";
import Layout from "../components/Layout"
import axios from 'axios';
  
function RecetaShow() {
    const [id, setId] = useState(useParams().id)
    const [receta, setReceta] = useState({nombre:'', ingredientes:'', procedimientos:'', autor:'', imagen:''})

    useEffect(() => {
        axios.get(`/api/receta/${id}`)
        .then(function (response) {
          setReceta(response.data)
        })
        .catch(function (error) {
          console.log(error);
        })
    }, [])
  
    return (
        <Layout>
           <div className="container">
            <h2 className="text-center mt-5 mb-3">Mostrar Receta</h2>
                <div className="card">
                    <div className="card-header">
                        <Link 
                            className="btn btn-outline-info float-right"
                            to="/"> Todas las recetas
                        </Link>
                        <Link
                            className="btn btn-outline-success mx-1"
                            to={`/edit/${receta.id}`}>
                            Editar
                        </Link>

                    </div>
                    <div className="card-body">
                        <b className="text-muted">Nombre</b>
                        <p>{receta.nombreReceta}</p>
                        <b className="text-muted">Ingredientes</b>
                        <p>{receta.ingredientes}</p>
                        <b className="text-muted">Procedimientos</b>
                        <p>{receta.procedimientos}</p>
                        <b className="text-muted">Autor</b>
                        <p>{receta.autor}</p>
                        <b className="text-muted">Imagen</b>
                        <p>{receta.imagen}</p>
                    </div>
                </div>
            </div>
        </Layout>
    );
}
  
export default RecetaShow;