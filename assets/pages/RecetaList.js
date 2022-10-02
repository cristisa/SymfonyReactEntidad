import React,{ useState, useEffect} from 'react';
import { Link } from "react-router-dom";
import Layout from "../components/Layout"
import Swal from 'sweetalert2'
import axios from 'axios';
import '../styles/app.scss';
 
function RecetaList() {
    const  [recetaList, setRecetaList] = useState([])
  
    useEffect(() => {
        fetchRecetaList()
    }, [])
  
    const fetchRecetaList = () => {
        axios.get('/api/receta')
        .then(function (response) {
          setRecetaList(response.data);
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  
    const handleDelete = (id) => {
        Swal.fire({
            title: '¿Estás seguro de querer eliminarlo?',
            text: "¡No podrás revertirlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, borrar!'
          }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/receta/${id}`)
                .then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Receta borrada exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    fetchRecetaList()
                })
                .catch(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha ocurrido un error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            }
          })
    }
  
    return (
        <Layout>
           <div className="container">
            <h2 className="text-center mt-5 mb-3">Recetario</h2>
                <div className="card">
                    <div className="card-header">
                        <Link 
                            className="btn btn-outline-primary"
                            to="/create">Agregar una nueva receta
                        </Link>
                    </div>
                    <div className="card-body">
              
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th width="300px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {recetaList.map((receta, key)=>{
                                    return (
                                        <tr key={key}>
                                            <td>{receta.nombreReceta}</td>
                                            <td>{receta.imagen}</td>
                                            <td>
                                                <Link
                                                    to={`/show/${receta.id}`}
                                                    className="btn btn-outline-info mx-1">
                                                    Mostrar
                                                </Link>
                                                <button 
                                                    onClick={()=>handleDelete(receta.id)}
                                                    className="btn btn-outline-danger mx-1">
                                                    Borrar
                                                </button>
                                            </td>
                                        </tr>
                                    )
                                })}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </Layout>
    );
}
  
export default RecetaList;