import { ajax } from './functions';


function upvote_trip(id, el) {
  ajax(`/action/update/trip.php?id=${id}&action=upvote`, {
    success: (response) => {
      // console.log(response);
      let json = JSON.parse(JSON.parse(response));
      // console.log(json);
      if ( json ) {
        el.textContent = json.length + ' | upvoted';
        el.classList.remove('special');
        el.onclick = (e) => window.downvote(e, 'trips', id);
      }
    },
    method: 'GET'
  });
}

function downvote_trip(id, el) {
  ajax(`/action/update/trip.php?id=${id}&action=downvote`, {
    success: (response) => {
      let json = JSON.parse(JSON.parse(response));
      if ( json ) {
        el.textContent = json.length + ' | upvote';
        el.classList.add('special');
        el.onclick = (e) => window.upvote(e, 'trips', id);
      }
    },
    method: 'GET'
  });
}
window.upvote = function (e, collection, id) {
  upvote_trip(id, e.target);
}

window.downvote = function (e, collection, id) {
  downvote_trip(id, e.target);
}
