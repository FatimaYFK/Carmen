/** 
* Calls the reservieren api to return all reservieren from the database
*/
function getreservieren() {

    const ul = document.getElementById('reservieren');
    ul.innerHTML = '';

    fetch('http://localhost:8080/carmen/reservieren/public/api/reservieren')
    .then((resp) => resp.json())
    .then((data) => {
    let reservieren = data;
    return reservieren.map(function(reservation) {

        outputreservation(reservation.id, reservation.kundenname, reservation.telefonnummer, reservation.datum);
        const t2 = new TimelineMax();
        t2.fromTo("#reservieren", 1, {opacity: 0}, {opacity: 1}, "0")
       
    })
    })
    .catch(function(error) {
    console.log(error);
    });  
    
}

/** 
* Function to output a reservation and edit form
*/
function outputreservation(id, kundenname, telefonnummer, datum){
    const ul = document.getElementById('reservieren');
    const li = document.createElement('li');

    li.innerHTML = 
    `<div onclick="editreservation(this.parentElement)">
    <h3>${kundenname}</h3>
    <p><strong>telefonnummer:</strong> ${telefonnummer}</p>
    <p><strong>datum:</strong> ${datum}</p>
    </div>
    <a class="button edit" href="#" onclick="editreservation(this.parentElement)"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png"></a> <a class="button delete" href="#" onclick="deletereservation(this.parentElement,${id})"><img src="https://img.icons8.com/ios-glyphs/30/000000/delete-sign.png"></a>
    
    `;

    li.innerHTML += 
    `<form class="editForm" style="display:none;"><input type="text" placeholder="kundenname" name="kundenname" value="${kundenname}" />
        <input type="text" placeholder="telefonnummer" name="telefonnummer" value="${telefonnummer}" />
        <input type="text" placeholder="Datum" name="datum" value="${datum}" />
        <input type="hidden" name="id" value="${id}" />
        <button onclick="return updatereservation(this.closest('form'))">Save</button> <button onclick="return editreservation(this.closest('li'))">Cancel</button>
    </form>
    `;    
    
    ul.appendChild(li);
}

/**
 * edit the data of an existing reservation
 */
function editreservation(li) {
    const form = li.querySelector("form");
   
    if (form.style.display === "none") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    return false;
    
}

/**
 * update the data of an existing reservation in the database by calling api
 */
function updatereservation(form) {

        const editForm = form;
        const id = editForm.querySelector('input[name="id"]').value;
        const kundenname = editForm.querySelector('input[name="kundenname"]').value;
        const telefonnummer = editForm.querySelector('input[name="telefonnummer"]').value;
        const datum = editForm.querySelector('input[name="datum"]').value;


        fetch('http://localhost:8080/carmen/reservieren/public/api/reservation/update/'+id, {
            method: 'PUT', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({id: id, kundenname:kundenname, telefonnummer:telefonnummer, datum:datum}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            editForm.style.display = "none";
        
            getreservieren();
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        
        return false;

        
}

/**
 * delete a reservation from the database
 */
function deletereservation(li, id) {
    const really = confirm("Sind Sie sicher?");
    if (really == true) {
       li.remove();
 
       fetch('http://localhost:8080/carmen/reservieren/public/api/reservation/delete/' + id, {
            method: 'DELETE',
            })
            .then(res => res.text()) // or res.json()
            .then(res => console.log(res))
    }   
}

/**
 * Shows form to add a reservation if form not visible
 * 
 * Adds a reservation to the database if submitted
 */
function addreservation(submitted = false) {
   
    if(submitted){

        const addForm = document.getElementById("addForm");
        const kundenname = addForm.querySelector('input[name="kundenname"]').value;
        const telefonnummer = addForm.querySelector('input[name="telefonnummer"]').value;
        const datum = addForm.querySelector('input[name="datum"]').value;


        fetch('http://localhost:8080/carmen/reservieren/public/api/reservation/add', {
            method: 'POST', // or 'PUT'
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({kundenname:kundenname, telefonnummer:telefonnummer, datum:datum}),
          })
          .then((resp) => resp.json())
          .then((data) => {
            console.log('Success:', data);
            const lastid  = data.notice.id;
            addForm.closest('li').remove();
        
            outputreservation(lastid, kundenname, telefonnummer, datum);
            
                    
          })
          .catch((error) =>  {
              console.log(error); 
            }); 
        

        
        return false;
        
    }
    else{

    
        const ul = document.getElementById('reservieren');
        let li = document.createElement('li');
        li.innerHTML = 
            `<form id="addForm"><input type="text" placeholder="kundenname" name="kundenname" value="" required />
            <input type="text" placeholder="telefonnummer" name="telefonnummer" value="" required />
            <input type="text" placeholder="Datum" name="datum" value="" required />
            <button onclick="return addreservation(true)">Add</button> <button onclick="return closeAdd(this.closest('li'))">Cancel</button>
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
function resetreservieren() {

    fetch('http://localhost:8080/carmen/reservieren/public/api/reservieren/reset', {})
            .then(res => res.text()) // or res.json()
            .then(res => getreservieren())

}

/**
 * IIFI to start off the app and keep scope
 */ 
(function() {

    const t1 = new TimelineMax();
        //t1.fromTo("#reservieren", 2, { opacity: 0, x: 30 }, {opacity: 1, x: 0}, "0")
    t1.fromTo("main", 2, {y: -1000}, {y: 0}, "-=1");

    const t2 = new TimelineMax();
    t2.fromTo(".sidebar", 1, {opacity: 0, x:3000}, {opacity: 1, x:0}, "0")
    .fromTo(".cta", 2, {opacity: 0}, {opacity: 1}, "1.0"); 

    
    getreservieren();  

    document.getElementById("addreservation").addEventListener("click", function(){
        addreservation(false);
    }, false);

 
    document.getElementById("reset").addEventListener("click", resetreservieren);

})();


  
