import CanvasRenderer from '../CanvasRenderer.js';
import ScoreItem from './ScoreItem.js';

export default class Kudzu extends ScoreItem{
  private maxX: number;

  private maxY: number;

  private speedX: number;

  private speedY: number;

  public constructor(maxX: number, maxY: number) {
    super();

    this.maxX = maxX;
    this.maxY = maxY;

    this.image = CanvasRenderer.loadNewImage('assets/kudzu.png');
    this.posX = maxX * Math.random();
    this.posY = maxY * Math.random();
    this.score = 5;

    if (Math.random() <= 0.5) {
      this.speedX = 0.1;
      this.speedY = 0.1;
    } else {
      this.speedX = -0.1;
      this.speedY = -0.1;
    }
  }

  public update(elapsed: number): void {
    this.posX += this.speedX * elapsed;
    if (this.posX < 0) {
      this.posX = this.maxX;
    }
    if (this.posX > this.maxX) {
      this.posX = 0;
    }

    this.posY += this.speedY * elapsed;
    if (this.posY < 0) {
      this.posY = this.maxY;
    }
    if (this.posY > this.maxY) {
      this.posY = 0;
    }
  }
}
