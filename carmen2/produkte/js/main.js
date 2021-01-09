/** 
* Calls the produkte api to return all produkte from the database
*/
function getprodukte() {

    const ul = document.getElementById('produkte');
    ul.innerHTML = '';

    fetch('http://localhost:8080/carmen/produkte/public/api/produkte')
    .then((resp) => resp.json())
    .then((data) => {
    let produkte = data;
    return produkte.map(function(produkt) {

        outputprodukt(produkt.id, produkt.kaffee, produkt.lagerbestand, produkt.preis);
        const t2 = new TimelineMax();
        t2.fromTo("#produkte", 1, {opacity: 0}, {opacity: 1}, "0")
       
    })
    })
    .catch(function(error) {
    console.log(error);
    });  
    
}

/** 
* Function to output a produkt and edit form
*/
function outputprodukt(id, kaffee, lagerbestand, preis){
    const ul = document.getElementById('produkte');
    const li = document.createElement('li');

    li.innerHTML = 
    `<div onclick="editprodukt(this.parentElement)">
    <h3>${kaffee}</h3>
    <p><strong>lagerbestand:</strong> ${lagerbestand}</p>
    <p><strong>preis:</strong> ${preis}</p>
    </div>
    <a class="button edit" href="#" onclick="editprodukt(this.parentElement)"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png"></a> <a class="button delete" href="#" onclick="deleteprodukt(this.parentElement,${id})"><img src="https://img.icons8.com/ios-glyphs/30/000000/delete-sign.png"></a>
    
    `;

    li.innerHTML += 
    `<form class="editForm" style="display:none;"><input type="text" placeholder="kaffee" name="kaffee" value="${kaffee}" />
        <input type="text" placeholder="lagerbestand" name="lagerbestand" value="${lagerbestand}" />
        <input type="text" placeholder="preis" name="preis" value="${preis}" />
        <input type="hidden" name="id" value="${id}" />
        <button onclick="return updateprodukt(this.closest('form'))">Save</button> <button onclick="return editprodukt(this.closest('li'))">Cancel</button>
    </form>
    `;    
    
    ul.appendChild(li);
}

/**
 * edit the data of an existing produkt
 */
function editprodukt(li) {
    const form = li.querySelector("form");
   
    if (form.style.display === "none") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    return false;
    
}

/**
 * update the data of an existing produkt in the database by calling api
 */
function updateprodukt(form) {

        const editForm = form;
        const id = editForm.querySelector('input[name="id"]').value;
        const kaffee = editForm.querySelector('input[name="kaffee"]').value;
        const lagerbestand = editForm.querySelector('input[name="lagerbestand"]').value;
        const preis = editForm.querySelector('input[name="preis"]').value;


        fetch('http://localhost:8080/carmen/produkte/public/api/produkt/update/'+id, {
            method: 'PUT', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({id: id, kaffee:kaffee, lagerbestand:lagerbestand, preis:preis}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            editForm.style.display = "none";
        
            getprodukte();
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        
        return false;

        
}

/**
 * delete a produkt from the database
 */
function deleteprodukt(li, id) {
    const really = confirm("Are you sure you want to delete this produkt?");
    if (really == true) {
       li.remove();
 
       fetch('http://localhost:8080/carmen/produkte/public/api/produkt/delete/' + id, {
            method: 'DELETE',
            })
            .then(res => res.text()) // or res.json()
            .then(res => console.log(res))
    }   
}

/**
 * Shows form to add a produkt if form not visible
 * 
 * Adds a produkt to the database if submitted
 */
function addprodukt(submitted = false) {
   
    if(submitted){

        const addForm = document.getElementById("addForm");
        const kaffee = addForm.querySelector('input[name="kaffee"]').value;
        const lagerbestand = addForm.querySelector('input[name="lagerbestand"]').value;
        const preis = addForm.querySelector('input[name="preis"]').value;


        fetch('http://localhost:8080/carmen/produkte/public/api/produkt/add', {
            method: 'POST', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({kaffee:kaffee, lagerbestand:lagerbestand, preis:preis}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            const lastid  = data.notice.id;
            addForm.closest('li').remove();
        
            outputprodukt(lastid, kaffee, lagerbestand, preis);
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        

        
        return false;
        
    }
    else{

    
        const ul = document.getElementById('produkte');
        let li = document.createElement('li');
        li.innerHTML = 
            `<form id="addForm"><input type="text" placeholder="kaffee" name="kaffee" value="" required />
            <input type="text" placeholder="lagerbestand" name="lagerbestand" value="" required />
            <input type="text" placeholder="preis" name="preis" value="" required />
            <button onclick="return addprodukt(true)">Add</button> <button onclick="return closeAdd(this.closest('li'))">Cancel</button>
            </form>
            `;
        ul.appendChild(li);
        
    }
}

/** 
* helper function to remove addForm
*/
function closeAdd(li){
    console.log(li);
    li.remove();
    return false;
}

/** 
* resets the database to default demo content
*/
function resetprodukte() {

    fetch('http://localhost:8080/carmen/produkte/public/api/produkte/reset', {})
            .then(res => res.text()) // or res.json()
            .then(res => getprodukte())

}

/**
 * IIFI to start off the app and keep scope
 */ 
(function() {

    const t1 = new TimelineMax();
        //t1.fromTo("#produkte", 2, { opacity: 0, x: 30 }, {opacity: 1, x: 0}, "0")
    t1.fromTo("main", 2, {y: -1000}, {y: 0}, "-=1");

    const t2 = new TimelineMax();
    t2.fromTo(".sidebar", 1, {opacity: 0, x:3000}, {opacity: 1, x:0}, "0")
    .fromTo(".cta", 2, {opacity: 0}, {opacity: 1}, "1.0"); 

    
    getprodukte();  

    document.getElementById("addprodukt").addEventListener("click", function(){
        addprodukt(false);
    }, false);

 
    document.getElementById("reset").addEventListener("click", resetprodukte);

})();


  
