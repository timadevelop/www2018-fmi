// Ajax stuff
function ajax(url, settings) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (xhr.status == 200) {
      settings.success(xhr.responseText);
    } else {
      console.error(xhr.responseText);
    }
  };
  xhr.open(settings.method || 'GET', url, /* async */ true);
  xhr.send(settings.data || null);
}
//
// ajax callback
//
let callback = function(text) {
  let json = JSON.parse(text);
  if (json === null) {
    emailInput.required = true;
    emailInput.style.display = 'block';
  }
  else {
    loginInput.style.border = '1px solid #00b27f';
    emailInput.required = false;
    emailInput.style.display = 'none';
  }
};

function upvote_trip(id, el) {
  ajax(`/action/update/trip.php?id=${id}&action=upvote`, {
    success: (response) => {
      // console.log(response);
      let json = JSON.parse(JSON.parse(response));
      // console.log(json);
      if ( json ) {
        el.textContent = json.length + ' | upvoted';
        el.classList.remove('special');
        el.onclick = null;
      }
    },
    method: 'GET'
  });
}

window.upvote = function (e, collection, id) {
  upvote_trip(id, e.target);
}
