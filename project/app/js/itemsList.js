import { ajax, createElementFromHTML } from './functions';


let saveChanges = (tripId, listId) => {
  console.log(listId);
  console.log(document.getElementById(listId));
  let lis = document.getElementById(listId).getElementsByTagName("li");

  let resultJson = [];
  for( let i = 0; i < lis.length; i++ )
  {
    console.log('cont? ' + lis[i].classList.contains('done'));
    let p = lis[i].getElementsByTagName('p')[0];
    if (p) {
      resultJson.push({
        "text":p.innerText,
        "done":lis[i].classList.contains('done')?"true":"false",
        });
    }
  }
  // console.log(JSON.stringify(resultJson));

  let aj = `/action/update/trip.php?id=${tripId}&action=changeTasks&tasks=${JSON.stringify(resultJson)}`;
  // console.log(aj);
  ajax(aj, {
    success: (response) => {
      console.log('resp is: >' + response + '<');
    },
    method: 'GET'
  });
};

window.toogleDone = (event, listId, tripId) => {
  // console.log('t done');
  if( ! event.target.classList.contains('done') ) {
    event.target.className += ' done';
  }
  else {
    event.target.classList.remove('done');
  }
  saveChanges(tripId, listId);
};

window.remove = (event, listId, tripId) => {
  console.log('rm ' + tripId + ' li' + listId);
  event.target.parentElement.parentNode.removeChild(event.target.parentElement); //.style.display = 'none';
  saveChanges(tripId, listId);
};


window.add = (e, listId, inputId, tripId) => {
  let inp = document.getElementById(inputId);
  if(inp.value === '') return;
  addElement(inp.value, listId, tripId);
  inp.value = '';
}

function addElement ( text, listId, tripId ) {
  let list = document.getElementById(listId);
  let s = `
      <li onclick="toogleDone(event, '${listId}', '${tripId}')">
        <p>${text}</p>
        <i onclick="remove(event, '${listId}', '${tripId}')"class="fa fa-trash"></i>
      </li>
  `;
  list.appendChild(createElementFromHTML(s));
  saveChanges(tripId, listId);
}
