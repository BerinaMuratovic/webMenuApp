export function getDrinksByType(type) {
    return $.get('assets/js/drinks.json', (data) => {
        const filteredDrinks = data.filter(item => item.type === type)
        let output = ''
        filteredDrinks.forEach(drink => {
            output += `<div class="tm-list-item">
                    <img src="${drink.image}" alt="Image" class="tm-list-item-img">
                        <div class="tm-black-bg tm-list-item-text">
                            <h3 class="tm-list-item-name">${drink.name}<span class="tm-list-item-price">${drink.price}</span></h3>
                            <p class="tm-list-item-description">${drink.description}</p>
                        </div>
                </div>`
        });

        document.getElementById('list-of-drinks').innerHTML = output;
    }).catch(err => console.error('Error fetching drinks:', err));
}

window.getSpecialItems = function() {
    return $.get('assets/js/special-items.json', (data) => {
        let output = ''
        data.forEach(item => {
            output += `<div class="tm-black-bg tm-special-item" onclick="getSpecialItem('${item.id}')">
            <img src="${item.image}" alt="Image">
            <div class="tm-special-item-description">
                <h2 class="tm-text-primary tm-special-item-title">${item.name}</h2>
                <p class="tm-special-item-text">${item.description}</p>
            </div>
        </div>`
        });
        document.getElementById('special-items').innerHTML = output;
    }).catch(err => console.error('Error fetching special items:', err));
}


window.getSpecialItem = function(id) {
    return $.get('assets/js/special-items.json', (data) => {
        const item = data.find(item => item.id.toString() === id);
        const output = `
        <div class="tm-black-bg tm-single-item">
            <img src="${item.image}" alt="Image">
            <div class="tm-special-item-description">
                <h2 class="tm-text-primary tm-special-item-title">${item.name}</h2>
                <p class="tm-special-item-text">${item.description}</p>
            </div>
            <button onclick="getSpecialItems()">Back to Special Items</button>
        </div>
        `
        document.getElementById('special-items').innerHTML = output;
    });
};