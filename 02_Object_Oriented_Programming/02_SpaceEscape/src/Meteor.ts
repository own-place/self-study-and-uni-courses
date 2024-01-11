import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Meteor extends ScoreItem {
  private accelerator: number = 0.005;

  public constructor(maxX: number, maxY: number) {
    super();

    if (Math.random() <= 0.1) {
      this.score = -5 * 1000;
      this.speed = 0.1;
      if (Math.random() <= 0.5) {
        this.image = CanvasRenderer.loadNewImage('assets/meteor_brown_big.png');
      } else {
        this.image = CanvasRenderer.loadNewImage('assets/meteor_grey_big.png');
      }
    } else {
      this.score = -1 * 1000;
      this.speed = 0.15;
      if (Math.random() <= 0.5) {
        this.image = CanvasRenderer.loadNewImage('assets/meteor_brown_small.png');
      } else {
        this.image = CanvasRenderer.loadNewImage('assets/meteor_grey_small.png');
      }
    }

    this.posX = maxX * 0.9;
    this.posY = maxY * Math.random();
  }

  public override update(elapsed: number): void {
    this.speed += this.accelerator;
    this.posX -= elapsed * this.speed;
  }
}
