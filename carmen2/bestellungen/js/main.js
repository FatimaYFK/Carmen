/** 
* Calls the bestellungen api to return all bestellungen from the database
*/
function getbestellungen() {

    const ul = document.getElementById('bestellungen');
    ul.innerHTML = '';

    fetch('http://localhost:8080/carmen/bestellungen/public/api/bestellungen')
    .then((resp) => resp.json())
    .then((data) => {
    let bestellungen = data;
    return bestellungen.map(function(bestellung) {

        outputbestellung(bestellung.id, bestellung.kundenname, bestellung.menge, bestellung.kundenadresse);
        const t2 = new TimelineMax();
        t2.fromTo("#bestellungen", 1, {opacity: 0}, {opacity: 1}, "0")
       
    })
    })
    .catch(function(error) {
    console.log(error);
    });  
    
}

/** 
* Function to output a bestellung and edit form
*/
function outputbestellung(id, kundenname, menge, kundenadresse){
    const ul = document.getElementById('bestellungen');
    const li = document.createElement('li');

    li.innerHTML = 
    `<div onclick="editbestellung(this.parentElement)">
    <h3>${kundenname}</h3>
    <p><strong>menge:</strong> ${menge}</p>
    <p><strong>kundenadresse:</strong> ${kundenadresse}</p>
    </div>
    <a class="button edit" href="#" onclick="editbestellung(this.parentElement)"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png"></a> <a class="button delete" href="#" onclick="deletebestellung(this.parentElement,${id})"><img src="https://img.icons8.com/ios-glyphs/30/000000/delete-sign.png"></a>
    
    `;

    li.innerHTML += 
    `<form class="editForm" style="display:none;"><input type="text" placeholder="kundenname" name="kundenname" value="${kundenname}" />
        <input type="text" placeholder="menge" name="menge" value="${menge}" />
        <input type="text" placeholder="kundenadresse" name="kundenadresse" value="${kundenadresse}" />
        <input type="hidden" name="id" value="${id}" />
        <button onclick="return updatebestellung(this.closest('form'))">Save</button> <button onclick="return editbestellung(this.closest('li'))">Cancel</button>
    </form>
    `;    
    
    ul.appendChild(li);
}

/**
 * edit the data of an existing bestellung
 */
function editbestellung(li) {
    const form = li.querySelector("form");
   
    if (form.style.display === "none") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    return false;
    
}

/**
 * update the data of an existing bestellung in the database by calling api
 */
function updatebestellung(form) {

        const editForm = form;
        const id = editForm.querySelector('input[name="id"]').value;
        const kundenname = editForm.querySelector('input[name="kundenname"]').value;
        const menge = editForm.querySelector('input[name="menge"]').value;
        const kundenadresse = editForm.querySelector('input[name="kundenadresse"]').value;


        fetch('http://localhost:8080/carmen/bestellungen/public/api/bestellung/update/'+id, {
            method: 'PUT', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({id: id, kundenname:kundenname, menge:menge, kundenadresse:kundenadresse}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            editForm.style.display = "none";
        
            getbestellungen();
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        
        return false;

        
}

/**
 * delete a bestellung from the database
 */
function deletebestellung(li, id) {
    const really = confirm("Are you sure you want to delete this bestellung?");
    if (really == true) {
       li.remove();
 
       fetch('http://localhost:8080/carmen/bestellungen/public/api/bestellung/delete/' + id, {
            method: 'DELETE',
            })
            .then(res => res.text()) // or res.json()
            .then(res => console.log(res))
    }   
}

/**
 * Shows form to add a bestellung if form not visible
 * 
 * Adds a bestellung to the database if submitted
 */
function addbestellung(submitted = false) {
   
    if(submitted){

        const addForm = document.getElementById("addForm");
        const kundenname = addForm.querySelector('input[name="kundenname"]').value;
        const menge = addForm.querySelector('input[name="menge"]').value;
        const kundenadresse = addForm.querySelector('input[name="kundenadresse"]').value;


        fetch('http://localhost:8080/carmen/bestellungen/public/api/bestellung/add', {
            method: 'POST', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({kundenname:kundenname, menge:menge, kundenadresse:kundenadresse}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            const lastid  = data.notice.id;
            addForm.closest('li').remove();
        
            outputbestellung(lastid, kundenname, menge, kundenadresse);
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        

        
        return false;
        
    }
    else{

    
        const ul = document.getElementById('bestellungen');
        let li = document.createElement('li');
        li.innerHTML = 
            `<form id="addForm"><input type="text" placeholder="kundenname" name="kundenname" value="" required />
            <input type="text" placeholder="menge" name="menge" value="" required />
            <input type="text" placeholder="kundenadresse" name="kundenadresse" value="" required />
            <button onclick="return addbestellung(true)">Add</button> <button onclick="return closeAdd(this.closest('li'))">Cancel</button>
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
function resetbestellungen() {

    fetch('http://localhost:8080/carmen/bestellungen/public/api/bestellungen/reset', {})
            .then(res => res.text()) // or res.json()
            .then(res => getbestellungen())

}

/**
 * IIFI to start off the app and keep scope
 */ 
(function() {

    const t1 = new TimelineMax();
        //t1.fromTo("#bestellungen", 2, { opacity: 0, x: 30 }, {opacity: 1, x: 0}, "0")
    t1.fromTo("main", 2, {y: -1000}, {y: 0}, "-=1");

    const t2 = new TimelineMax();
    t2.fromTo(".sidebar", 1, {opacity: 0, x:3000}, {opacity: 1, x:0}, "0")
    .fromTo(".cta", 2, {opacity: 0}, {opacity: 1}, "1.0"); 

    
    getbestellungen();  

    document.getElementById("addbestellung").addEventListener("click", function(){
        addbestellung(false);
    }, false);

 
    document.getElementById("reset").addEventListener("click", resetbestellungen);

})();


  
