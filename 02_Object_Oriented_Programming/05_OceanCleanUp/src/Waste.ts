import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Waste extends ScoreItem {
  // private willSludge: boolean = false;

  public constructor (maxX: number, maxY: number) {
    super();

    if (Math.random() <= 0.5) {
      this.image = CanvasRenderer.loadNewImage('assets/waste1.png');
      this.score = 10;
    } else if (Math.random() <= 0.8) {
      this.image = CanvasRenderer.loadNewImage('assets/waste2.png');
      this.score = 20;
    } else if (Math.random() < 1) {
      this.image = CanvasRenderer.loadNewImage('assets/waste3.png');
      this.score = 30;
    }

    this.posX = maxX * 0.02;
    this.posY = Math.random() * maxY * 0.9;

    this.speed = 0.3;
  }

  /**
   * update the position of Waste
   * @param elapsed elapsed
   */
  public override update(elapsed: number): void {
    this.posX += elapsed * this.speed;
    if (this.posX >= 400 && this.posX <= 450) {
      if (Math.random() <= 0.1) {
        this.image = CanvasRenderer.loadNewImage('assets/toxic.png');
        this.score = 100;
        this.speed = 0.35;
      }
    }
  }
}
