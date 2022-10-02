import React, {useState} from 'react';
import { Link } from "react-router-dom";
import Layout from "../components/Layout"
import Swal from 'sweetalert2'
import axios from 'axios';
  
function RecetaCreate() {
    const [nombreReceta, setNombreReceta] = useState('');
    const [ingredientes, setIngredientes] = useState('');
    const [procedimientos, setProcedimientos] = useState('');
    const [autor, setAutor] = useState('');
    const [imagen, setImagen] = useState('');
    
    // El archivo
    //const selectedFile = useRef();
    
    const [isSaving, setIsSaving] = useState(false)
  
    // const uploader = async () => {
    //     if (imagen)
        
    
    // } 

    const handleSave = () => {
        setIsSaving(true);
        let formData = new FormData()
        formData.append("nombreReceta", nombreReceta)
        formData.append("ingredientes", ingredientes)
        formData.append("procedimientos", procedimientos)
        formData.append("autor", autor)
        formData.append("imagen", imagen)

        axios.post('/api/receta', formData)
          .then(function (response) {
            Swal.fire({
                icon: 'success',
                title: '¡Receta guardada!',
                showConfirmButton: false,
                timer: 1500
            })
            setIsSaving(false);
            setNombreReceta('')
            setIngredientes('')
            setProcedimientos('')
            setAutor('')
            setImagen('')
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
                <h2 className="text-center mt-5 mb-3">Crea una nueva receta</h2>
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
                                <input 
                                    value={imagen}
                                    onChange={(event)=>{setImagen(event.target.value)}}
                                    className="form-control"
                                    type="file"
                                    id="imagen"
                                    rows="3"
                                    name="imagen">
                                </input>
                            </div>
                            <button 
                                disabled={isSaving}
                                onClick={handleSave} 
                                type="button"
                                className="btn btn-outline-primary mt-3">
                                Guardar Receta
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </Layout>
    );
}
  
export default RecetaCreate;