!function(){!async function(){try{const a="/api/tareas?id="+r(),n=await fetch(a),o=await n.json();e=o.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector(".listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),e.length<1){const e=document.querySelector(".listado-tareas"),t=document.createElement("LI");return t.textContent="Aún no hay tareas agregadas",t.classList.add("no-tareas"),void e.appendChild(t)}const o={0:"Pendiente",1:"Completa"};e.forEach(c=>{const s=document.createElement("LI");s.dataset.tareaId=c.id,s.classList.add("tarea");const d=document.createElement("P");d.textContent=c.nombre,d.ondblclick=function(){a(!0,{...c})};const i=document.createElement("DIV");i.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+o[c.estado].toLowerCase()),l.textContent=o[c.estado],l.dataset.estadoTarea=c.estado,l.ondblclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,n(e)}({...c})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=c.id,m.textContent="Eliminar",m.onclick=function(){!function(a){Swal.fire({title:"¿Eliminar Tarea?",showCancelButton:!0,confirmButtonText:"Si",cancelButtonText:"No"}).then(n=>{n.isConfirmed&&async function(a){const{estado:n,id:o,nombre:c}=a,s=new FormData;s.append("id",o),s.append("nombre",c),s.append("estado",n),s.append("proyectoId",r());try{const n="http://localhost:3000/api/tarea/eliminar",o=await fetch(n,{method:"POST",body:s}),r=await o.json();!0===r.resultado&&(Swal.fire("¡Eliminado!",r.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t())}catch(e){console.log(e)}}(a)})}({...c})},i.appendChild(l),i.appendChild(m),s.appendChild(d),s.appendChild(i);document.querySelector(".listado-tareas").appendChild(s)})}function a(a=!1,c={}){const s=document.createElement("DIV");s.classList.add("modal"),s.innerHTML=`\n            <form class="formulario nueva-tarea">\n                <legend>${a?"Edita el nombre de la tarea":"Añade una nueva tarea"}</legend>\n                <div class="campo">\n                    <label>Tarea</label>\n                    <input\n                        type="text"\n                        name="tarea"\n                        placeholder="${a?"Editar Tarea del":"Añadir Tarea al"} Proyecto Actual"\n                        id="tarea"\n                        value="${c.nombre?c.nombre:""}"\n                    />\n                </div>\n                <div class="opciones">\n                    <input\n                        type="submit"\n                        class="submit-nueva-tarea"\n                        value="${a?"Guardar cambios":"Añadir Tarea"}"\n                    />\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},200),s.addEventListener("click",(function(d){if(d.preventDefault(),d.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{s.remove()},600)}if(d.target.classList.contains("submit-nueva-tarea")){const s=document.querySelector("#tarea").value.trim();if(!s)return void o("El Nombre de la tarea es Obligatorio","error",document.querySelector(".formulario legend"));a?(c.nombre=s,n(c)):async function(a){const n=new FormData;n.append("nombre",a),n.append("proyectoId",r());try{const r="http://localhost:3000/api/tarea",c=await fetch(r,{method:"POST",body:n}),s=await c.json();if(o(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const n=document.querySelector(".modal");setTimeout(()=>{n.remove()},1500);const o={id:String(s.id),nombre:a,estado:"0",proyectoId:s.proyectoId};e=[...e,o],t()}}catch(e){console.log(e)}}(s)}})),document.querySelector(".dashboard").appendChild(s)}async function n(a){const{estado:n,id:o,nombre:c}=a,s=new FormData;s.append("id",o),s.append("nombre",c),s.append("estado",n),s.append("proyectoId",r());try{const a="http://localhost:3000/api/tarea/actualizar",r=await fetch(a,{method:"POST",body:s}),d=await r.json();"exito"===d.respuesta.tipo&&Swal.fire(d.respuesta.mensaje,d.respuesta.mensaje,"success");const i=document.querySelector(".modal");i&&i.remove(),e=e.map(e=>(e.id===o&&(e.estado=n,e.nombre=c),e)),t()}catch(e){console.log(e)}}function o(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},4500)}function r(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){a()}))}();