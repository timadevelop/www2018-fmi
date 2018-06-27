function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.innerHTML = htmlString.trim();

  // Change this to div.childNodes to support multiple top-level nodes
  return div.firstChild;
}

window.toogleDone = (event) => {
  if( ! event.target.classList.contains('done') ) {
    event.target.className += ' done';
  }
  else {
    event.target.classList.remove('done');
  }
};

window.remove = (id, event) => {
  console.log('rm '+ id);
  event.target.parentElement.style.display = 'none';
};


window.add = (e, listId, inputId) => {
  let inp = document.getElementById(inputId);
  if(inp.value === '') return;
  addElement(inp.value, listId);
  inp.value = '';
}

function addElement ( text, listId ) {
  let list = document.getElementById(listId);
  let s = `
      <li onclick="toogleDone(event)">
        <p>${text}</p>
        <i onclick="remove(1, event)"class="fa fa-trash"></i>
      </li>
  `;
  list.appendChild(createElementFromHTML(s));
}
