window.onload = async function() {
    const productosRes = await fetch('fetch_products.php');
    const productos = await productosRes.json();
    const productosTable = document.getElementById('productos');
    const productoSelect = document.getElementById('productoSelect');

    productos.forEach(producto => {
        const row = `<tr>
            <td>${producto.nombre}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.precio}</td>
            <td>
                <button class="btn">Seleccionar</button>
            </td>
        </tr>`;
        productosTable.innerHTML += row;

        const option = `<option value="${producto.id}">${producto.nombre}</option>`;
        productoSelect.innerHTML += option;
    });
};
