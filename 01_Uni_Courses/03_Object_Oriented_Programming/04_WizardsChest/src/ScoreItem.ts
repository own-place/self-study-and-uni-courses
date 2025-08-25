import CanvasRenderer from './CanvasRenderer.js';
import GameItem from './GameItem.js';

export default class ScoreItem extends GameItem {
  public constructor (posX: number) {
    super();
    
    if (Math.random() <= 0.2) {
      if (Math.random() <= 0.2) {
        this.image = CanvasRenderer.loadNewImage('assets/skullRed.png');
        this.score = -100;
      } else if (Math.random() <= 0.4) {
        this.image = CanvasRenderer.loadNewImage('assets/skullGreen.png');
        this.score = -50;
      } else if (Math.random() < 1) {
        this.image = CanvasRenderer.loadNewImage('assets/skullBlue.png');
        this.score = -5;
      }
    } else if (Math.random() < 1) {
      if (Math.random() <= 0.2) {
        this.image = CanvasRenderer.loadNewImage('assets/gemRed.png');
        this.score = 100;
      } else if (Math.random() <= 0.4) {
        this.image = CanvasRenderer.loadNewImage('assets/gemGreen.png');
        this.score = 50;
      } else if (Math.random() < 1) {
        this.image = CanvasRenderer.loadNewImage('assets/gemBlue.png');
        this.score = 5;
      }
    }

    this.posX = posX;
    this.posY = 5;
    this.speed = 0.2;
  }
}
