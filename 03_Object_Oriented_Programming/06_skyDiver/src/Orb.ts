import LightItem from './LightItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Orb extends LightItem {
  public constructor(maxX: number, maxY: number) {
    super();

    if (Math.random() <= 0.33) {
      this.image = CanvasRenderer.loadNewImage('assets/orb1.png');
      this.lightForce = 1 * 1000;
    } else if (Math.random() <= 0.66) {
      this.image = CanvasRenderer.loadNewImage('assets/orb2.png');
      this.lightForce = 3 * 1000;
    } else if (Math.random() < 1) {
      this.image = CanvasRenderer.loadNewImage('assets/orb3.png');
      this.lightForce = 5 * 1000;
    }

    this.speed = 0.2;

    this.posX = maxX * Math.random();
    this.posY = maxY * 0.9;
  }

  /**
   * Update positions of the Orb
   *
   * @param elapsed milliseconds since last update
   */
  public override update(elapsed: number): void {
    this.posY -= elapsed * this.speed;
  }
}
