import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Fish extends ScoreItem {
  public constructor(maxX: number, maxY: number) {
    super();

    if (Math.random() <= 0.33) {
      this.image = CanvasRenderer.loadNewImage('assets/fish1.png');
      this.score = -5;
    } else if (Math.random() <= 0.66) {
      this.image = CanvasRenderer.loadNewImage('assets/fish2.png');
      this.score = -10;
    } else if (Math.random() < 1) {
      this.image = CanvasRenderer.loadNewImage('assets/fish3.png');
      this.score = -15;
    }

    this.posX = maxX * 0.02;
    this.posY = Math.random() * maxY * 0.9;

    this.speed = 0.2;
  }

  /**
   * update the position of Fish
   * @param elapsed elapsed
   */
  public override update(elapsed: number): void {
    this.posX += elapsed * this.speed;
  }
}
