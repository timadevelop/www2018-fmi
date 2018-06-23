'use strict';
import f from './module';

const glob = "global string";

console.log(f(1,2));

window.subscribe = (e) => {
  if ( e.target.previousSibling.previousSibling.value.length > 3 )
    e.target.parentElement.innerHTML = '<p>Thank you for subscription!</p>';
};
