import React, { useState, useEffect } from 'react';
import { Link, useParams } from "react-router-dom";
import Layout from "../components/Layout"
import Swal from 'sweetalert2'
import axios from 'axios';
  
function RecetaEdit() {
    const [id, setId] = useState(useParams().id)
    const [nombreReceta, setNombreReceta] = useState('');
    const [ingredientes, setIngredientes] = useState('');
    const [procedimientos, setProcedimientos] = useState('');
    const [autor, setAutor] = useState('');
    const [imagen, setImagen] = useState('');
    const [isSaving, setIsSaving] = useState(false)
  
      
    useEffect(() => {
        axios.get(`/api/receta/${id}`)
        .then(function (response) {
            let receta = response.data
            setNombreReceta(receta.nombreReceta);
            setIngredientes(receta.ingredientes);
            setProcedimientos(receta.procedimientos);
            setAutor(receta.autor);
            setImagen(receta.imagen)
        })
        .catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Un error ha ocurrido',
                showConfirmButton: false,
                timer: 1500
            })
        })
          
    }, [])
  
  
    const handleSave = () => {
        setIsSaving(true);
        axios.patch(`/api/receta/${id}`, {
            nombreReceta: nombreReceta,
            ingredientes: ingredientes,
            procedimientos: procedimientos,
            autor: autor,
            imagen: imagen
        })
        .then(function (response) {
            Swal.fire({
                icon: 'success',
                title: '¡Receta actualizada exitosamente!',
                showConfirmButton: false,
                timer: 1500
            })
            setIsSaving(false);
        })
        .catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Un error ha ocurrido',
                showConfirmButton: false,
                timer: 1500
            })
            setIsSaving(false)
        });
    }
  
  
    return (
        <Layout>
            <div className="container">
                <h2 className="text-center mt-5 mb-3">Editar Receta</h2>
                <div className="card">
                    <div className="card-header">
                        <Link 
                            className="btn btn-outline-info float-right"
                            to="/">Ver todas las recetas
                        </Link>
                    </div>
                    <div className="card-body">
                        <form>
                            <div className="form-group">
                                <label htmlFor="nombreReceta">Nombre</label>
                                <input 
                                    onChange={(event)=>{setNombreReceta(event.target.value)}}
                                    value={nombreReceta}
                                    type="text"
                                    className="form-control"
                                    id="nombreReceta"
                                    name="nombreReceta"/>
                            </div>
                            <div className="form-group">
                                <label htmlFor="ingredientes">Ingredientes</label>
                                <textarea 
                                    value={ingredientes}
                                    onChange={(event)=>{setIngredientes(event.target.value)}}
                                    className="form-control"
                                    id="ingredientes"
                                    rows="3"
                                    name="ingredientes">
                                </textarea>
                            </div>
                            <div className="form-group">
                                <label htmlFor="procedimientos">Procedimientos</label>
                                <textarea 
                                    value={procedimientos}
                                    onChange={(event)=>{setProcedimientos(event.target.value)}}
                                    className="form-control"
                                    id="procedimientos"
                                    rows="3"
                                    name="procedimientos">
                                </textarea>
                            </div>
                            <div className="form-group">
                                <label htmlFor="autor">Autor</label>
                                <textarea 
                                    value={autor}
                                    onChange={(event)=>{setAutor(event.target.value)}}
                                    className="form-control"
                                    id="autor"
                                    rows="3"
                                    name="autor">
                                </textarea>
                            </div>
                            <div className="form-group">
                                <label htmlFor="imagen">Imagen</label>
                                <textarea 
                                    value={imagen}
                                    onChange={(event)=>{setImagen(event.target.value)}}
                                    className="form-control"
                                    id="imagen"
                                    rows="3"
                                    name="imagen">
                                </textarea>
                            </div>    
                            <button 
                                disabled={isSaving}
                                onClick={handleSave} 
                                type="button"
                                className="btn btn-outline-success mt-3">
                                Actualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </Layout>
    );
}
  
export default RecetaEdit;