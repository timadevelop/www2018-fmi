function toogleVisibility(id)
{
  let el = document.getElementById(id);
  let appDiv = document.getElementById('app');
  if( el.style.visibility === 'hidden' ) {
    el.style.visibility = 'visible';
    el.style.zIndex = 1;
    appDiv.style.filter = 'blur(5px)';
  }
  else {
    el.style.visibility = 'hidden';
    appDiv.style.filter = '';
  }
}

window.toogleVisibility = toogleVisibility;
window.hide = function(e) {
  e.target.style.display = 'none';
}
