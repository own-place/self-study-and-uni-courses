import LightItem from './LightItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Cloak extends LightItem {
  public constructor(maxX: number, maxY: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('assets/cloak.png');

    this.posX = maxX * Math.random();
    this.posY = maxY * 0.9;

    this.lightForce = 0;
    this.speed = Math.random() * 0.2 + 0.1;
  }

  /**
   * Update positions of the Cloak
   *
   * @param elapsed milliseconds since last update
   */
  public override update(elapsed: number): void {
    this.posY -= elapsed * this.speed;
    this.posX += elapsed * this.speed;
  }
}
