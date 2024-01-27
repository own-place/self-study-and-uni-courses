import LightItem from './LightItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Monster extends LightItem {
  private maxX: number;

  private maxY: number;

  public constructor(maxX: number, maxY: number) {
    super();

    this.maxX = maxX;
    this.maxY = maxY;

    if (Math.random() <= 0.5) {
      this.image = CanvasRenderer.loadNewImage('assets/monster1.png');
      this.lightForce = -10 * 1000;
    } else if (Math.random() <= 0.8) {
      this.image = CanvasRenderer.loadNewImage('assets/monster2.png');
      this.lightForce = -20 * 1000;
    } else if (Math.random() < 1) {
      this.image = CanvasRenderer.loadNewImage('assets/monster3.png');
      this.lightForce = -30 * 1000;
    }

    this.speed = Math.random() * 0.2 + 0.2;

    this.posX = maxX * Math.random();

    this.posY = maxY * 0.9;

  }

/**
 * Update positions of the Monster
 *
 * @param elapsed milliseconds since last update
 */
  public override update(elapsed: number): void {
    this.posY -= elapsed * this.speed;

    if (this.posY < 300 && Math.random() < 0.006) {
      this.posX = Math.random() * this.maxX;
      this.posY = Math.random() * this.maxY + 300;
    }
  }
}
