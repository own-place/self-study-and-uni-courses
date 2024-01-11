import CanvasRenderer from './CanvasRenderer.js';
import ScoreItem from './ScoreItem.js';

export default class Shield extends ScoreItem {
  public constructor(maxX: number, maxY: number) {
    super();

    if (Math.random() <= 0.5) {
      this.image = CanvasRenderer.loadNewImage('assets/shield_battery.png');
    } else {
      this.image = CanvasRenderer.loadNewImage('assets/shield_bolt.png');
    }

    this.score = 3 * 1000;
    this.speed = 0.1;

    this.posX = maxX * 0.9;
    this.posY = maxY * Math.random();
  }

  public override update(elapsed: number): void {
    this.posX -= elapsed * this.speed;
  }
}
