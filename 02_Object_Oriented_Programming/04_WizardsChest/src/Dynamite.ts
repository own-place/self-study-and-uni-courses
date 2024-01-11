import GameItem from './GameItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Dynamite extends GameItem {
  public constructor (posX: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('assets/dynamite.png');
    this.posX = posX;
    this.posY = 5;
    this.speed = 0.1;
  }

  public override update(elapsed: number): void {
    this.speed += 0.005;
    this.posY += elapsed * this.speed;
  }
}
