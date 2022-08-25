const primeros = document.getElementById('primeros')
const segundos = document.getElementById('segundos')
const templateCardPrimeros = document.getElementById('template-card-primeros').content
const templateCardSegundos = document.getElementById('template-card-segundos').content
const fragment = document.createDocumentFragment()
const cards = document.getElementById('cards')
const items = document.getElementById('items')
const footer = document.getElementById('footer')
const templateFooter = document.getElementById('template-footer').content
const templateCarrito = document.getElementById('template-carrito').content
let carrito = {}

// Eventos
// El evento DOMContentLoaded es disparado cuando el documento HTML ha sido completamente cargado y parseado
document.addEventListener('DOMContentLoaded', () => {
    fetchDataPrimeros()
    fetchDataSegundos()
    if (localStorage.getItem('carrito')) {
        carrito = JSON.parse(localStorage.getItem('carrito'))
        pintarCarrito()
    }
})

primeros.addEventListener('click', e => {
    addCarrito(e)
})

segundos.addEventListener('click', e => {
    addCarrito(e)
})

items.addEventListener('click', e => {
    botonAccion(e)
})

// Traer primeros
const fetchDataPrimeros = async() => {
    try {
        const res = await fetch('json/primeros.json');
        const data = await res.json()
        pintarCardsPrimeros(data)
    } catch (error) {
        console.log(error)
    }
}

// Pintar primeros
const pintarCardsPrimeros = data => {
    data.forEach(producto => {
        templateCardPrimeros.querySelector('h5').textContent = producto.title
        templateCardPrimeros.querySelector('.precio').textContent = producto.precio
        templateCardPrimeros.querySelector('img').setAttribute("src", producto.thumbnailUrl)
        templateCardPrimeros.querySelector('.kcal').textContent = producto.calorias
        templateCardPrimeros.querySelector('.mediterraneo').textContent = producto.mediterraneo
        templateCardPrimeros.querySelector('.vegano').textContent = producto.vegano
        templateCardPrimeros.querySelector('.celiaco').textContent = producto.celiaco
        templateCardPrimeros.querySelector('.vegetariano').textContent = producto.vegetariano
        templateCardPrimeros.querySelector('.btn-dark').dataset.id = producto.id
        const clone = templateCardPrimeros.cloneNode(true)
        fragment.appendChild(clone)
    })
    primeros.appendChild(fragment)
}

// Traer segundos
const fetchDataSegundos = async() => {
    try {
        const res = await fetch('json/segundos.json');
        const data = await res.json()
        pintarCardsSegundos(data)
    } catch (error) {
        console.log(error)
    }
}

// Pintar segundos
const pintarCardsSegundos = data => {
    data.forEach(producto => {
        templateCardSegundos.querySelector('h5').textContent = producto.title
        templateCardSegundos.querySelector('span').textContent = producto.precio
        templateCardSegundos.querySelector('img').setAttribute("src", producto.thumbnailUrl)
        templateCardSegundos.querySelector('.kcal').textContent = producto.calorias
        templateCardSegundos.querySelector('.mediterraneo').textContent = producto.mediterraneo
        templateCardSegundos.querySelector('.vegano').textContent = producto.vegano
        templateCardSegundos.querySelector('.celiaco').textContent = producto.celiaco
        templateCardSegundos.querySelector('.vegetariano').textContent = producto.vegetariano
        templateCardSegundos.querySelector('.btn-dark').dataset.id = producto.id
        const clone = templateCardSegundos.cloneNode(true)
        fragment.appendChild(clone)
    })
    segundos.appendChild(fragment)
}

// Add carrito
const addCarrito = e => {
    if (e.target.classList.contains('btn-dark')) {
        setCarrito(e.target.parentElement)
    }
    e.stopPropagation()
}

const setCarrito = objeto => {
    const producto = {
        id: objeto.querySelector('.btn-dark').dataset.id,
        title: objeto.querySelector('h5').textContent,
        precio: objeto.querySelector('span').textContent,
        cantidad: 1
    }

    if (carrito.hasOwnProperty(producto.id)) {
        producto.cantidad = carrito[producto.id].cantidad + 1
    }

    carrito[producto.id] = {...producto }
    pintarCarrito()
}

// Pintar carrito
const pintarCarrito = () => {
    items.innerHTML = ''
    Object.values(carrito).forEach(producto => {
        templateCarrito.querySelector('th').textContent = producto.id
        templateCarrito.querySelectorAll('td')[0].textContent = producto.title
        templateCarrito.querySelectorAll('td')[1].textContent = producto.cantidad
        templateCarrito.querySelector('.btn-info').dataset.id = producto.id
        templateCarrito.querySelector('.btn-danger').dataset.id = producto.id
        templateCarrito.querySelector('span').textContent = producto.cantidad * producto.precio

        const clone = templateCarrito.cloneNode(true)
        fragment.appendChild(clone)
    })
    items.appendChild(fragment)

    pintarFooter()

    localStorage.setItem('carrito', JSON.stringify(carrito))
}

const pintarFooter = () => {
    footer.innerHTML = ''
    if (Object.keys(carrito).length === 0) {
        footer.innerHTML = `<th scope="row" colspan="5">Carrito vacío - comience a añadir platos!</th>`
        return
    }

    const nCantidad = Object.values(carrito).reduce((acumulador, { cantidad }) => acumulador + cantidad, 0)
    const nPrecio = Object.values(carrito).reduce((acumulador, { cantidad, precio }) => acumulador + cantidad * precio, 0)

    templateFooter.querySelectorAll('td')[0].textContent = nCantidad
    templateFooter.querySelector('span').textContent = nPrecio

    const clone = templateFooter.cloneNode(true)
    fragment.appendChild(clone)
    footer.appendChild(fragment)

    const botonVaciar = document.getElementById('vaciar-carrito')
    botonVaciar.addEventListener('click', () => {
        carrito = {}
        pintarCarrito()
    })
}

const botonAccion = e => {
    //Acción aumentar
    if (e.target.classList.contains('btn-info')) {
        const producto = carrito[e.target.dataset.id]
        producto.cantidad++
            carrito[e.target.dataset.id] = {...producto }
        pintarCarrito()
    }

    //Acción disminuir
    if (e.target.classList.contains('btn-danger')) {
        const producto = carrito[e.target.dataset.id]
        producto.cantidad--
            if (producto.cantidad === 0) {
                delete carrito[e.target.dataset.id]
            }
        pintarCarrito()
    }

    e.stopPropagation()
}