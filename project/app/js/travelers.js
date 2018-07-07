import {
  ajax,
  createElementFromHTML
} from './functions';


window.addTraveler = (event, inputId, tripId) => {
  console.log("add user");
  let inp = document.getElementById(inputId);
  if (inp.value === '') return;
  let userLogin = inp.value;

  let aj = `/action/update/trip.php?id=${tripId}&action=addTraveler&login=${userLogin}`;

  ajax(aj, {
    success: (response) => {
      console.log('resp is: >' + response + '<');
      if(response == "\"Ok\"") location.reload();
    },
    method: 'GET'
  });
  inp.value = '';
}

window.rmTraveler = (event, userId, tripId) => {
  let aj = `/action/update/trip.php?id=${tripId}&action=rmTraveler&userId=${userId}`;

  console.log(aj);
  ajax(aj, {
    success: (response) => {
      console.log('resp is: >' + response + '<');
      if(response == "\"Ok\"") location.reload();
    },
    method: 'GET'
  });
}
