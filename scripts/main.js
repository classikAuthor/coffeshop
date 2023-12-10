let added_products = [];
let totalCost = 0;

document.getElementById('sumaInput').addEventListener('input', function(){calculateRest();});
document.getElementById('sumaInput').addEventListener('change', function(event) {
    const restInput = document.getElementById('restInput');
    if (event.target.value.trim() === '') {
        restInput.value = '';
    }
});


function toggleFullScreen() {
    const doc = window.document;
    const docEl = doc.documentElement;

    const requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen ||
                             docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
    const cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen ||
                                 doc.webkitExitFullscreen || doc.msExitFullscreen;
    if (!doc.fullscreenElement && !doc.mozFullScreenElement && 
        !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
        requestFullScreen.call(docEl);
    } else {
        cancelFullScreen.call(doc);
    }
}

function renderProducts(products) {
    const forCalcul = [];
    const upElement = document.querySelector('.up');
    upElement.innerHTML = '';

    const uniqueProducts = {};

    products.forEach(product => {
        if (!uniqueProducts[product.name]) {
            uniqueProducts[product.name] = {
                details: product,
                count: 0
            };
        }
        uniqueProducts[product.name].count++;
    });

    Object.values(uniqueProducts).forEach(uniqueProduct => {
        const addedProductDiv = document.createElement('div');
        addedProductDiv.classList.add('added_products');

        const productName = document.createTextNode(uniqueProduct.details.name + 
            ' (x' + uniqueProduct.count + ') - ' + 
            (uniqueProduct.count * uniqueProduct.details.price) + ' lei');
        addedProductDiv.appendChild(productName);

        const btnDiv = document.createElement('div');
        btnDiv.classList.add('added_products_btn');

        const decreaseBtn = document.createElement('button');
        decreaseBtn.textContent = '-';
        decreaseBtn.addEventListener('click', () => decreaseProduct(uniqueProduct.details));
        btnDiv.appendChild(decreaseBtn);

        const increaseBtn = document.createElement('button');
        increaseBtn.textContent = '+';
        increaseBtn.addEventListener('click', () => increaseProduct(uniqueProduct.details));
        btnDiv.appendChild(increaseBtn);

        addedProductDiv.appendChild(btnDiv);
        upElement.appendChild(addedProductDiv);
        forCalcul.push(uniqueProduct);
    });
    totalCost = calculTotalCost(forCalcul);
    addTotalCost(totalCost);
}

function addProduct(name, price) {
    const product = {
        name: name,
        price: price
    };
    added_products.push(product);
    renderProducts(added_products);
    calculateRest();
}

function increaseProduct(product) {
    added_products.push(product);
    renderProducts(added_products);
    calculateRest();
}

function decreaseProduct(product) {
    const index = added_products.findIndex(p => p === product);
    if (index > -1) {
        added_products.splice(index, 1);
    }
    renderProducts(added_products);
    calculateRest();
}

function addTotalCost(total) {
    const upElement = document.querySelector('.up');
    if (added_products.length === 0) {
        upElement.innerHTML = '';
    } else {
        const lineDiv = document.createElement('div');
        lineDiv.classList.add('_line');

        const addedProductsDiv = document.createElement('div');
        addedProductsDiv.classList.add('added_products');

        const totalCostText = document.createTextNode('Total cost: ');
        addedProductsDiv.appendChild(totalCostText);

        const strongElement = document.createElement('strong');
        strongElement.textContent = total + ' lei';
        addedProductsDiv.appendChild(strongElement);
        
        upElement.appendChild(lineDiv);
        upElement.appendChild(addedProductsDiv);

        const formElement = document.createElement('form');
        formElement.action = 'handlers/send_sales.php';
        formElement.method = 'POST';

        added_products.forEach(product => {
            const hiddenNameField = document.createElement('input');
            hiddenNameField.type = 'hidden';
            hiddenNameField.name = 'name[]';
            hiddenNameField.value = product.name;
            formElement.appendChild(hiddenNameField);
        });

        const finishPaymentBtn = document.createElement('button');
        finishPaymentBtn.classList.add('finish_payment_btn');
        finishPaymentBtn.textContent = 'Finish Payment';
        formElement.appendChild(finishPaymentBtn);
        upElement.appendChild(formElement);
    }
}

function calculTotalCost(uniqueProducts) {
    let sum = 0;
    uniqueProducts.forEach(product => {
        sum += product.count * product.details.price;
    });
    return sum;
}


function calculateRest() {
    const sumaInput = document.getElementById('sumaInput');
    const restInput = document.getElementById('restInput');
    const sumaValue = parseFloat(sumaInput.value);
    if (!isNaN(sumaValue)) {
        restInput.value = sumaValue - totalCost;
    } else {
        restInput.value = '';
    }
}

let acc = document.getElementsByClassName("accordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
}
