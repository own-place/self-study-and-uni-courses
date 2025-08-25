import CanvasItem from './CanvasItem.js';
import CanvasRenderer from './CanvasRenderer.js';
import ScoreItem from './ScoreItem.js';

export default class Player extends CanvasItem {
  private movingUp: boolean = false;

  private movingDown: boolean = false;

  private maxY: number;

  public constructor(maxX: number, maxY: number) {
    super();

    this.image = CanvasRenderer.loadNewImage('assets/player.png');
    this.posX = maxX * 0.93;
    this.posY = maxY / 2 - 50;

    this.maxY = maxY;
  }

  public moveUp(): void {
    this.movingUp = true;
  }

  public moveDown(): void {
    this.movingDown = true;
  }

  public isCollidingItem(item: ScoreItem): boolean {
    if ((item.getPosX() + item.getWidth() >= this.getPosX())
    && (item.getPosX() <= this.getPosX() + this.getWidth())
    && (item.getPosY() + item.getHeight() >= this.getPosY())
    && (item.getPosY() <= this.getPosY() + this.getHeight())) {
    return true;
  }
  return false;
  }

  public override update(elapsed: number): void {
    if (this.movingUp) {
      this.posY -= elapsed;
      this.movingUp = false;
    }
    if (this.movingDown) {
      this.posY += elapsed;
      this.movingDown = false;
    }

    // make the player always displaying on the screen
    if (this.posY < 0) {
      this.posY = 0;
    }
    if (this.posY + (this.image.height) > this.maxY) {
      this.posY = this.maxY - (this.image.height);
    }
  }
}
