import Tetra from './Tetra.js';

const game: Tetra = new Tetra(document.getElementById('game') as HTMLCanvasElement);

window.addEventListener('load', () => {
  game.start();
});
