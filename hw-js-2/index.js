'use strict';

window.onload = init;

function init() {
  //
  // Get references to DOM elements
  //
  const game = new Game();

  window.place = value => {
    game.place(value);
  };

  window.restart = _ => {
    game.over();
  }
}

class Game {
  constructor() {
    this.isEnd = false;
    this.cells = new Array(9).fill(0);
    this.messageElement = document.getElementById('message');
  }

  setMessage(msg) {
    this.messageElement.innerHTML = msg;
  }

  setCross( cellNumber ) {
    let cell = document.getElementById("cell" + cellNumber.toString());
    cell.src = "images/x.png";
  }

  setZero( cellNumber ) {
    // console.log('zero on ' + cellNumber);
    const cell = document.getElementById("cell" + cellNumber.toString());
    cell.src = "images/circle.png";
  }

  place(value) {
    if( this.isEnd ) {
      return;
    }

    if ( this.cells[value] === 0 )
    {
      this.setCross(value);
      this.cells[value] = 1;
      if ( this.checkVictory() )
      {
        this.setMessage('You won!');
        // this.over();
        this.isEnd = true;
      }
      else
      {
        this.checkDraw();
        this.aiTurn();
        this.checkDraw();
      }
    }
    // console.log(this.cells);
  }

  over() {
    this.isEnd = false;
    this.cells.fill(0);
    const domCells = document.getElementsByClassName('cell');
    [].forEach.call(domCells, e => {
      e.src = 'images/transp.png';
    });
    this.setMessage('Game is started');
  }

  checkDraw() {
    let isDraw = true;
    this.cells.forEach(e => {
      if(e === 0) isDraw = false;
    });
    if (isDraw)
    {
      this.setMessage('Draw');
      // this.over();
      this.isEnd = true;
    }
  }


  checkVictory() {
    if (this.cells[0] === this.cells[1] && this.cells[1] === this.cells[2] && this.cells[2] > 0) return true;
    if (this.cells[3] === this.cells[4] && this.cells[4] === this.cells[5] && this.cells[5] > 0) return true;
    if (this.cells[6] === this.cells[7] && this.cells[7] === this.cells[8] && this.cells[8] > 0) return true;
    if (this.cells[6] === this.cells[3] && this.cells[3] === this.cells[0] && this.cells[0] > 0) return true;
    if (this.cells[7] === this.cells[4] && this.cells[4] === this.cells[1] && this.cells[1] > 0) return true;
    if (this.cells[8] === this.cells[5] && this.cells[5] === this.cells[2] && this.cells[2] > 0) return true;
    if (this.cells[6] === this.cells[4] && this.cells[4] === this.cells[2] && this.cells[2] > 0) return true;
    if (this.cells[0] === this.cells[4] && this.cells[4] === this.cells[8] && this.cells[8] > 0) return true;
  }

  aiTurn() {
    if( this.isEnd ) return;
    let i, putPosition;
    for (i = 0; i < 9; i++) if (this.cells[i] === 0) putPosition = i;

    for (i = 0; i < 3; i++) {
      if (this.cells[0] === this.cells[1] && this.cells[2] === 0 && this.cells[0] === i) putPosition = 2;
      if (this.cells[0] === this.cells[2] && this.cells[1] === 0 && this.cells[0] === i) putPosition = 1;
      if (this.cells[1] === this.cells[2] && this.cells[0] === 0 && this.cells[2] === i) putPosition = 0;
      if (this.cells[3] === this.cells[4] && this.cells[5] === 0 && this.cells[3] === i) putPosition = 5;
      if (this.cells[3] === this.cells[5] && this.cells[4] === 0 && this.cells[3] === i) putPosition = 4;
      if (this.cells[4] === this.cells[5] && this.cells[3] === 0 && this.cells[5] === i) putPosition = 3;
      if (this.cells[6] === this.cells[7] && this.cells[8] === 0 && this.cells[6] === i) putPosition = 8;
      if (this.cells[6] === this.cells[8] && this.cells[7] === 0 && this.cells[6] === i) putPosition = 7;
      if (this.cells[7] === this.cells[8] && this.cells[6] === 0 && this.cells[8] === i) putPosition = 6;

      if (this.cells[6] === this.cells[3] && this.cells[0] === 0 && this.cells[6] === i) putPosition = 0;
      if (this.cells[6] === this.cells[0] && this.cells[3] === 0 && this.cells[6] === i) putPosition = 3;
      if (this.cells[3] === this.cells[0] && this.cells[6] === 0 && this.cells[3] === i) putPosition = 6;
      if (this.cells[7] === this.cells[4] && this.cells[1] === 0 && this.cells[7] === i) putPosition = 1;
      if (this.cells[7] === this.cells[1] && this.cells[4] === 0 && this.cells[7] === i) putPosition = 4;
      if (this.cells[4] === this.cells[1] && this.cells[7] === 0 && this.cells[4] === i) putPosition = 7;
      if (this.cells[8] === this.cells[5] && this.cells[2] === 0 && this.cells[8] === i) putPosition = 2;
      if (this.cells[8] === this.cells[2] && this.cells[5] === 0 && this.cells[8] === i) putPosition = 5;
      if (this.cells[5] === this.cells[2] && this.cells[8] === 0 && this.cells[5] === i) putPosition = 8;

      if (this.cells[6] === this.cells[4] && this.cells[2] === 0 && this.cells[6] === i) putPosition = 2;
      if (this.cells[6] === this.cells[2] && this.cells[4] === 0 && this.cells[6] === i) putPosition = 4;
      if (this.cells[4] === this.cells[2] && this.cells[6] === 0 && this.cells[4] === i) putPosition = 6;
      if (this.cells[0] === this.cells[4] && this.cells[8] === 0 && this.cells[0] === i) putPosition = 8;
      if (this.cells[0] === this.cells[8] && this.cells[4] === 0 && this.cells[0] === i) putPosition = 4;
      if (this.cells[4] === this.cells[8] && this.cells[0] === 0 && this.cells[4] === i) putPosition = 0;
    }

    this.setZero(putPosition);
    this.cells[putPosition] = 2;
    if (this.checkVictory())
    {
      this.setMessage("JS won!");
      // this.over();
      this.isEnd = true;
    }

  }

}

