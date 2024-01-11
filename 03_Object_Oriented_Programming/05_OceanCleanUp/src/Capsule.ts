import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Capsule extends ScoreItem {
  public constructor(maxX: number, maxY: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('assets/capsule.png');

    this.posX = maxX * 0.02;
    this.posY = Math.random() * maxY * 0.9;

    this.speed = 0.3;
    this.score = 0;
  }

  /**
   * update the position of Capsule
   * @param elapsed elapsed
   */
  public override update(elapsed: number): void {
    this.posX += elapsed * this.speed;
    this.posY -= elapsed * 0.03;
  }
}

