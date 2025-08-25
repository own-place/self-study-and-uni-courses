import CanvasRenderer from '../CanvasRenderer.js';
import ScoreItem from './ScoreItem.js';

export default class Flower extends ScoreItem{
  private timeToNextChange: number = 0;

  public constructor(maxX: number, maxY: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('assets/flower_0.png');
    this.score = -1;
    this.posX = maxX * Math.random();
    this.posY = maxY * Math.random();
  }

  public update(elapsed: number): void {
    this.timeToNextChange += elapsed;
    if (this.timeToNextChange >= 10 * 1000) {
      this.image = CanvasRenderer.loadNewImage('assets/flower_1.png');
      this.score = -3;
    } else if (this.timeToNextChange >= 10 * 1000 * 2) {
      this.image = CanvasRenderer.loadNewImage('assets/flower_2.png');
      this.score = -5;
    } else if (this.timeToNextChange >= 10 * 1000 * 3) {
      this.image = CanvasRenderer.loadNewImage('assets/flower_3.png');
      this.score = -7;
    }
  }
}
