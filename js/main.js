//Boton calificar vista docente
function obtenerCalificacionYComentario() {
    let calificacion = prompt("Ingrese una calificación:");
    let comentario = prompt("Ingrese un comentario:");
  
    const resultadoDiv = document.getElementById("resultado-calificacion");
  resultadoDiv.innerHTML = "Calificación: " + calificacion + "<br>Comentario: " + comentario;
  
    // Mostrar los datos ingresados
    alert("Calificación: " + calificacion + "\nComentario: " + comentario);
  
    // Redirigir a la página deseada una vez que la da al ultimo aceptar 
    //window.location.href = "tabprofe.html";
  
    // Almacenar los valores aceptados en el LocalStorage
  localStorage.setItem("calificacion", calificacion);
  localStorage.setItem("comentario", comentario);
  
}
   
function redirigir() {
  // Utiliza la función window.location.href para redirigir a la página deseada
  window.location.href = "Vistabaalumno.html";
}

//boton enviar archivo vista alumno
let archivoCargado = null;

function cargarArchivo() {
  const input = document.getElementById("archivo");
  const file = input.files[0];
  const resultado = document.getElementById("resultado");

  if (file) {
    const reader = new FileReader();

    reader.onload = function(e) {
      if (file.type.includes("pdf")) {
        resultado.innerHTML = "<embed src='" + e.target.result + "' width='500' height='600' type='application/pdf'>";
      } else {
        resultado.innerHTML = "<img src='" + e.target.result + "' alt='Imagen'>";
      }
      archivoCargado = file;
    };

    reader.readAsDataURL(file);
  }
}

function eliminarArchivo() {
  const input = document.getElementById("archivo");
  input.value = ""; // Limpiar el valor del input
  const resultado = document.getElementById("resultado");
  resultado.innerHTML = ""; // Limpiar la visualización del archivo
  archivoCargado = null; // Restablecer la variable del archivo cargado
}

//--- funcionalidad para pasar el valor del titulo a distintas paginas del alumno
// Obtener el valor de la variable desde el LocalStorage
const valorRecibido = localStorage.getItem('miVariable');
// Mostrar el valor en la página
document.getElementById("tarea1").innerText += valorRecibido;

//funcionalidades de vista tablero alumno; especificacmente para poder mover los elementos con drag-and-drop 
const listA= document.getElementById('asig')
const listP= document.getElementById('prog')
//const listC= document.getElementById('comp')

Sortable.create(listA, {
    group: 'shared', // set both lists to same group
    animation: 150,
    onEnd:()=>{
        console.log('Se inserto un elemento')
    },
    group: 'lista-personas',
    store:{
        // Guardamos el orden de la lista
        set:(sortable)=>{
            const orden=sortable.toArray();
            localStorage.setItem(sortable.options.group.name, orden.join('--'));
        },
        // Obtenemos el orden de la lista
        get:(sortable)=>{
            orden=localStorage.getItem(sortable.options.group.name);
            return orden ? orden.split('--'): [];
        }
    }
});

Sortable.create(listP, {
    group: 'nested',
    animation: 150,
    onEnd:()=>{
        console.log('Se inserto un elemento')
    },
    group: 'lista-personas',
    store:{
        // Obtenemos el orden de la lista
        get:(sortable)=>{
            const orden1=localStorage.getItem(sortable.options.group.name);
            return orden1? orden1.split('--'): [];
        },
        // Guardamos el orden de la lista
        set:(sortable)=>{
            orden22=sortable.toArray();
            localStorage.setItem(sortable.options.group.name, orden22.join('--'));
        }
      
    }
});

//funcion para dirigir a pag tablero docente y alumno
function redirectToPage(url) {
  window.location.href = url;
}